<?php

namespace App\Models;

use App\Services\CompanyRouteService;
use App\Services\PlaceRequestService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function riders()
    {
        return $this->hasMany(Rider::class);
    }
    public function getNoOfRidersAttribute()
    {
        return count($this->riders);
    }
    public function pendingRequest()
    {
        return (new PlaceRequestService)->pendingRequest($this->id);
    }
    public function dailyRoute()
    {
        return (new CompanyRouteService)->dailyRoute($this->id);
    }
    public function isVerified()
    {
        return ($this->status == 'verified')?? false;
    }
    public function isOwing()
    {
        return $this->user->isOwing();  
    }
}