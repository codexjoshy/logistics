<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaceRequest extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id', 'id');
    }

    public function order()
    {
        return $this->hasOne(Order::class, 'request_id', 'id');
    }
    public function rider()
    {
        return $this->belongsTo(Rider::class, 'rider_id', 'id');
    }
    public function getMinimumCompanyBalanceAttribute()
    {
        return 0.1 * $this->amount;
    }
    public function hasEnoughBalance($companyBalance=0)
    {
        
        $amount = $this->minimum__company_balance;
        return $companyBalance >= $amount;

    }
}
