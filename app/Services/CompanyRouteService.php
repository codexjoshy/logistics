<?php

namespace App\Services;

use App\Models\PlaceRequest;
use App\Models\Route;
use Carbon\Carbon;

class CompanyRouteService {
    public function routeRequest(int $route)
    {
        return PlaceRequest::where(['route_id'=> $route, "status"=> 'pending'])->latest()->get();
    }
    public function dailyRoute(int $company, ?int $rider = null)
    {

        return Route::whereDate('created_at', Carbon::today())
        ->when($rider, fn($query)=>$query->where('rider_id', $rider))
        ->where(['company_id'=> $company])->latest()->get();
    }
    public function riderIsBooked(int $rider, int $company)
    {
        $dailyRoute = $this->dailyRoute($company);
        $riders = $dailyRoute->pluck('rider_id')->toArray();
        return in_array($rider, $riders);    
    }

}

?>