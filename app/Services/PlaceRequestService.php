<?php

namespace App\Services;

use App\Models\PlaceRequest;
use Carbon\Carbon;

class PlaceRequestService {
    
    public function pendingRequest($company=null)
    {
        $placeRequests = PlaceRequest::whereDate('created_at', Carbon::today())
        ->when($company, function ($query) use($company) {
            return $query->whereHas('route', function($q)use($company){
                return $q->where('company_id', $company);
            });
        })
        ->when(!$company, fn($q)=> $q->whereNull('route_id'))
        ->where('status', 'pending')
        ->latest()->get();
        return $placeRequests;
    }
    public function numberOfPoolRequest()
    {
        $request = $this->pendingRequest();
        return count($request);
    }   
    public function companyPendingRequest(int $company)
    {
        $request = $this->pendingRequest($company);
        return count($request);
    }   
}

?>