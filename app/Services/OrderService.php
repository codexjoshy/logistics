<?php

namespace App\Services;

use App\Helpers\UniqueNo;
use App\Models\Order;
use Carbon\Carbon;
use illuminate\Support\Str;

class OrderService {
    
    public function companyOrders(int $company, $status=null)
    {
        return Order::with('companyRequest')->whereDate('created_at', Carbon::today())
        ->when($status, fn($query)=>$query->where('status', $status))
        ->where(['company_id'=> $company])
            ->latest()->get();
    }
    public function otpGenerator()
    {
        //day-company-route-order
        // $generator = new UniqueNo();
        // $otp = $generator->generate();
        // $otp = $this->checkDB($otp);
        $otp = Str::random(4);
        return $otp;

    }
    public function checkDB($otp)
    {
        $found = Order::where('customer_otp', $otp)->orWhere('customer_otp', $otp)->first();
        while ($found) {
           ++$otp;
        }
        return $otp;
    }
   
}

?>