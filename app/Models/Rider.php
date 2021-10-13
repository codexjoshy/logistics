<?php

namespace App\Models;

use App\Services\CompanyRouteService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rider extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isBooked()
    {
        return (new CompanyRouteService)->riderIsBooked($this->id, $this->company_id);
    }

}