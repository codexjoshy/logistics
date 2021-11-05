<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Rider;
use App\Services\TransactionService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = auth()->user()->company;
        $orders = [];
        if ($company) {
            $orders = Order::with('companyRequest')->whereDate('created_at', Carbon::today())
            ->where(['company_id'=> $company->id])
                ->latest()->get();
        }
        return view('company.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function previous(Request $request)
    {
        $orders = Order::with('companyRequest')
        ->where(['company_id'=> auth()->user()->company->id])
            ->latest()->get();
        return view('company.order.index', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $placeRequest = $order->companyRequest;
        $rider = $order->rider;
        return view('company.order.show', compact('order', 'placeRequest', 'rider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $request->validate(['status' => 'required|string|in:accepted,in-transit,delievered']);
        $order->update(['status' => $request->status]);
        return back()->with('success', 'Order Status Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
    public function riderOrder(Order $order)
    {
        return view('rider.order', compact('order'));
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $data = [];
        $error = false;
        if ($order->status == 'accepted') {
            $validate = ["otp"=> 'required|string|exists:orders,customer_otp'];
            $data = ["status"=> 'in-transit'];
            $error = $order->customer_otp != $request->otp;
        }
        if ($order->status == 'in-transit') {
            $validate = ["otp"=> 'required|string|exists:orders,reciever_otp'];
            $data = ["status"=> 'delievered'];
            $error = $order->reciever_otp != $request->otp;
        }
        $request->validate($validate);

        if(!count($data) || $error) {
            $errorMsg = $error ? 'OTP mismatch' : '';
            return back()->with('error', 'Sorry unable to update the order.'. $errorMsg);
        }
        if ($order->status == 'in-transit') {
            try {
                DB::beginTransaction();
                $company = $order->rider->company->user->id;
                $charges = $order->companyRequest()->minimum_company_balance;
                $deliveryFee = $order->companyRequest()->amount;
                $balance = $deliveryFee - $charges;
                (new TransactionService)->credit($company, $balance, "Wallet crediting for ".$order->code, auth()->id());
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                return back()->with('error','Sorry unable to update your wallet at this time');
            }
        }
        $order->update($data);

        // credit company account
        
        return back()->with('success', 'Status updated successfully');
    }
}
