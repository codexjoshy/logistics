<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Price;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AjaxController extends Controller {


    public function checkOrder(Request $request)
    {
        $order = $request->order;
        try {
            $response = $this->validateOrder($order);
        } catch (\Throwable $th) {
            return respondWithError([], "ERROR WITH ORDER CODE: ".$th->getMessage(), 403);
        }
        
        if(!$response['status']){
            return respondWithError([], $response['message'], $response['code']);
        }
        return respondWithSuccess([], "Order Found");
    }

    public function checkOrderOtp(Request $request)
    {
        $otp = $request->otp;
        $order = $request->order;

        try {
            $response = $this->validateOrder($order);
        } catch (\Throwable $th) {
            return respondWithError([], "ERROR WITH ORDER CODE", 403);
        }
        if(!$response['status']){
            return respondWithError([], $response['message'], $response['code']);
        }
        $orderInfo = $response['message'];
     
        if (!$orderInfo) {
            return respondWithError([], "ORDER COULDN'T BE RETRIEVED");
        }
        $date = Carbon::parse($orderInfo->created_at)->format('D. M d,  Y. h:m:s a');
        $customerInfo = $orderInfo->companyRequest->customer;
        $details = ["orderDate"=>$date, "status"=> $orderInfo->status, "company"=>$orderInfo->company->company_name, "sender"=>$customerInfo->name, "recipient"=> $orderInfo->companyRequest->reciever_name];
        if(strtolower($orderInfo->customer_otp) == $otp){
            $details["name"] = $customerInfo->name;
            return respondWithSuccess($details);
        }elseif (strtolower($orderInfo->reciever_otp) == $otp) {
            $receiverInfo = $orderInfo->companyRequest;
            $details["name"] = $receiverInfo->receiver_name;
            return respondWithSuccess($details);
        }elseif (strtolower($orderInfo->rider_otp) == $otp) {
            $riderInfo = $orderInfo->rider;
            $details["name"] = $riderInfo->name;
            return respondWithSuccess($details);
        }else{
            return respondWithError([], "OTP OR ORDER CODE MISMATCH", 402);
        }
        return respondWithError([], "OTP OR ORDER CODE MISMATCH", 402);
    }

    private function validateOrder(string $order)
    {

        $orderId = explode("-", $order);
        if (count($orderId) <= 1) {
            $error = ["status"=>false, "message"=>"INVALID ORDER CODE SUPPLIED 1", "code"=>401];
            return $error;
        }
        if ($orderId[0] != 'order') {
            $error = ["status"=>false, "message"=>"INVALID ORDER CODE SUPPLIED", "code"=>401];
            return $error;
        }
        $orderId = end($orderId);
        $orderId = explode('c',$orderId);
        if (count($orderId) != 2) {
            $error = ["status"=>false, "message"=>"NO ORDER CODE FOUND 1", "code"=>403];
            return $error;
        }
        $orderId = end($orderId);
        $orderId = explode('o',$orderId);
        if (count($orderId) != 2) {
            $error = ["status"=>false, "message"=>"NO ORDER CODE FOUND 1", "code"=>403];
            return $error;
        }

        // $error = ["status"=>false, "message"=>$orderId, "code"=>403];
        // return $error;
       
        $orderId = $orderId[0];
        $orderInfo = Order::with('companyRequest')->whereKey($orderId)->first();
        if (!$orderInfo) {
            $error = ["status"=>false, "message"=>"COULDN'T FIND ORDER WITH", "code"=>403];
            return $error;
        }
        return ["status"=>true, "message"=> $orderInfo];
    }

    public function getPriceByDistance(Request $request)
    {
        $distance = $request->distance;
        $deliveryType = $request->type;
        $priceList = Price::find(1)->distance_price;
        
        $priceList = collect($priceList);
        $data = $priceList->filter(function ($price, $key)use($distance){
            return  $distance >= $price['from']  && $distance <= $price['to'];
        });
        $data = $data->values();
        if($data && count($data)){
            $data = $data[0][$deliveryType];
        }else{
            $data = 10000;
        }
        return respondWithSuccess($data, "Price generated", 200);

    }
}

