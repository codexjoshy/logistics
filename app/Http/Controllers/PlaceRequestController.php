<?php

namespace App\Http\Controllers;

use App\Exceptions\LowBalanceException;
use App\Models\Company;
use App\Models\Order;
use App\Models\PlaceRequest;
use App\Models\Rider;
use App\Models\Route;
use App\Models\User;
use App\Notifications\OrderRequestedNotification;
use App\Notifications\RequestAcceptedNotification;
use App\Services\CompanyRouteService;
use App\Services\LogisticMsgs;
use App\Services\OrderService;
use App\Services\PlaceRequestService;
use App\Services\TermiiService;
use App\Services\TransactionService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PlaceRequestController extends Controller
{
    protected PlaceRequestService $requestService;
    protected OrderService $orderService;
    protected CompanyRouteService $companyRouteService;
    public function __construct(PlaceRequestService $requestService, OrderService $orderService, CompanyRouteService $companyRouteService, TermiiService $termiiService) {
        $this->requestService = $requestService;
        $this->orderService = $orderService;
        $this->companyRouteService = $companyRouteService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $placeRequests = $this->requestService->pendingRequest();
        $company = auth()->user()->company;
        return view('company.routes.requestPool', compact('placeRequests', 'company'));
    }

    public function dailyRequest()
    {
        $company = auth()->user()->company;
        $companyId = $company->id;
        $placeRequests = $this->requestService->pendingRequest($companyId);
        return view('company.routes.dailyRequest', compact('placeRequests', 'company'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request, PlaceRequest $placeRequest)
    {
        $request->validate(['rider'=> 'required|integer']);

        try {
            $user = auth()->user();
            $balance = $user->balance();
            
            throw_if(!$placeRequest->hasEnoughBalance($balance), new LowBalanceException('Your Balance is too low to carry out operation, kindly credit your wallet to continue', 403));
           
            DB::beginTransaction();
            $placeRequest->update(['status' => 'accepted']);
            $requestAmount = $placeRequest->minimum_company_balance;
            $order = Order::create([
                "request_id" => $placeRequest->id,
                "rider_id"=> $request->rider,
                "company_id"=> $user->company->id,
                "status"=> 'accepted'
            ]);

            $customerOtp = $this->orderService->otpGenerator();
            $receiverOtp = $this->orderService->otpGenerator();
            $rider = Rider::findOrFail($request->rider);
            $order->update(['customer_otp'=> $customerOtp,'reciever_otp'=>$receiverOtp]);

            $riderPhone = $rider->user->phone;
            $company = $rider->company->name;
            $pickup = $placeRequest->pickup_address;
            $destination = $placeRequest->delievery_address;
 
            $sender = $placeRequest->customer;
            $amount = $placeRequest->amount;

            $senderInfo = ["name"=> $sender->name, "phone"=> displayPhone($sender->phone)];
            $recipient = ["name"=> $placeRequest->reciever_name, "phone"=> displayPhone($placeRequest->reciever_phone)];
            $riderInfo = ["name"=> $rider->riderNames()['firstName'], "phone"=> displayPhone($riderPhone)];
            $pickupInfo = [$pickup];
            if ($placeRequest->pickup_more_details) {
               $pickupInfo[] = $placeRequest->pickup_more_details;
            }
            $destinationInfo = [$destination];
            if($placeRequest->destination_more_details) {
                $destinationInfo[] = $placeRequest->destination_more_details;
            }
            
            $type = $placeRequest->type;


            $SendSms = new LogisticMsgs($senderInfo, $recipient, $riderInfo, $company);
            //to riders 
            $toRider = $SendSms->sendOTP('rider', '0', $amount, $pickupInfo, $destinationInfo, $order->code, $type);
            // if ($toRider['error']) {
            //     throw new Exception($toRider['error']);
            // }
            $toReci = $SendSms->sendOTP('receiver', $receiverOtp, $placeRequest->payment != 'sender' ? $amount : null, $pickupInfo, $destinationInfo,  $order->code, $type);
            // if ($toReci['error']) {
            //     throw new Exception($toReci['error']);
            // }
            
            $toSender = $SendSms->sendOTP('sender', $customerOtp, $placeRequest->payment == 'sender' ? $amount : null, $pickupInfo, $destinationInfo, $order->code, $type);
            // if ($toSender['error']) {
            //     throw new Exception($toSender['error']);
            // }           

            (new TransactionService)->debit($user->id, $requestAmount, "Debit for Order {$order->code}");
            DB::commit();
            //debit company for accepting
            $riderMsg = "Dear rider, you have been assigned to pick an order for delivery. Click the link below to view details";
            $rider->user->notify(new RequestAcceptedNotification($riderMsg, '/dashboard'));
            $senderMsg = "Dear Customer,  {$riderInfo['name']}({$riderInfo['phone']}) has been assigned to pick your item for delivery. You can use the order id  and otp to track your delivery request. Order ID : order-{$order->code} OTP code:$customerOtp. booklogistic.com/#track";
            $sender->notify(new RequestAcceptedNotification($senderMsg, '/#track'));
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', "Sorry we couldn't create order for this request, Kindly Contact Support with this message: ". $th->getMessage());
        }
        return back()->with('success', 'Order Created successfully');
       
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Route $route)
    {
        $request->validate([
            "pickup"=> 'required|string',
            "delievery" => 'required|string',
            "recieverName"=> 'required|string',
            "recieverPhone"=> 'required|numeric',
            "name"=> 'required|string',
            "email"=> 'required|email',
            "phone"=> 'required|numeric',
            "note"=> 'nullable|string',
            "payment" => 'required|string|in:sender,receiver',
            "distance"=> 'required|string',
            "amount"=> 'required|numeric',
            "moreDestination"=>'sometimes|string',
            "morePickup"=> 'sometimes|string',
        ]);

        [
            "pickup"=> $pickup, "delievery"=> $delievery,
            "recieverName"=> $recieverName, "recieverPhone"=> $recieverPhone, "name"=> $name,
            "email"=> $email, "phone"=> $phone, "note"=> $note, "payment"=>$payment, "amount"=>$amount,
            "distance"=>$distance, "type"=> $type,
        ] = $request->all();

        $user = User::updateOrCreate(['email' => $email], [
            "phone" => $phone, "name"=> $name, 
            "type"=> 'customer', "password"=>Hash::make('password')
        ]);
        $company = $route->rider->company;
        PlaceRequest::create([
            "user_id" => $user->id, "pickup_address"=> $pickup, "delievery_address"=> $delievery,
            "reciever_name"=> $recieverName, "reciever_phone"=> $recieverPhone, "route_id"=> $route->id, 
            "amount"=> $amount, "distance"=> $distance, "type"=> $type, "company_id"=> $company->id,
            "note"=> $note, "payment"=> $payment, "pickup_more_details"=>$request->morePickup, "destination_more_details"=>$request->moreDestination
        ]);

        $user = $company->user;
        $user->notify(new OrderRequestedNotification);
        return redirect()->route('success')->with('success', 'Your request was sent successfully. You will be notified shortly with the details you provided.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlaceRequest  $placeRequest
     * @return \Illuminate\Http\Response
     */
    public function sendRequest(Request $request)
    {
        $request->validate([
            "pickup"=> 'required|string',
            "delievery" => 'required|string',
            "recieverName"=> 'required|string',
            "recieverPhone"=> 'required|numeric',
            "name"=> 'required|string',
            "email"=> 'required|email',
            "phone"=> 'required|numeric',
            "note"=> 'nullable|string',
            "description"=> 'nullable|string',
            "companyId"=> 'sometimes|integer|exists:companies,id',
            "type"=> 'required|string|in:express,regular',
            "amount"=> 'required|numeric',
            "distance"=> 'required|string',
            "payment"=> 'required|string',
            "moreDestination"=>'nullable|string',
            "morePickup"=> 'nullable|string',
        ]);

        [
            "pickup"=> $pickup, "delievery"=> $delievery,
            "recieverName"=> $recieverName, "recieverPhone"=> $recieverPhone, "name"=> $name,
            "email"=> $email, "phone"=> $phone, "note"=> $note, "description"=> $description, 
            "amount"=>$amount, "distance"=>$distance, "type"=> $type,"payment"=>$payment
        ] = $request->all();
        try {
            DB::beginTransaction();
            $user = User::updateOrCreate(['email' => $email], [
                "phone" => $phone, "name"=> $name, 
                "type"=> 'customer', "password"=>Hash::make('password')
            ]);
            $placeRequest = PlaceRequest::create([
                "user_id" => $user->id, "pickup_address"=> $pickup, "delievery_address"=> $delievery,
                "reciever_name"=> $recieverName, "reciever_phone"=> $recieverPhone, "note"=> $note,
                "description"=> $description, "status"=> 'pending', "amount"=> $amount, "distance"=> $distance, "type"=> $type, 
                "payment"=> $payment, "pickup_more_details"=>$request->morePickup, "destination_more_details"=>$request->moreDestination
            ]);
            
            if ($request->companyId) {
                //TODO send mail
                // $order = Order::create([
                //     "request_id" => $placeRequest->id,
                //     "company_id"=> $request->companyId,
                //     "status"=> 'pending'
                // ]);
                $placeRequest->update(['company_id' => $request->companyId]);
                $company = Company::find($request->companyId);
                $user = $company->user;
                $user->notify(new OrderRequestedNotification);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', 'Sorry, something went wrong'.$th->getMessage());
        }
        
        return redirect()->route('success')->with('success', 'Your request was sent successfully. You will be notified shortly with the details you provided.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlaceRequest  $placeRequest
     * @return \Illuminate\Http\Response
     */
    public function show(PlaceRequest $placeRequest)
    {
        // dd($placeRequest);
        $company = optional($placeRequest->route)->company;
        $riders =  optional($placeRequest->route)->company->riders ?? auth()->user()->company->riders;
        $assignedRider = optional($placeRequest->route)->rider_id;
        $companyRouteService = $this->companyRouteService;
        return view('company.routes.pending', compact('placeRequest', 'riders', 'assignedRider', 'companyRouteService', 'company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlaceRequest  $placeRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(PlaceRequest $placeRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PlaceRequest  $placeRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlaceRequest $placeRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlaceRequest  $placeRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlaceRequest $placeRequest)
    {
        //
    }
}
