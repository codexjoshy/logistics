<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        "created_at" => 'date'
    ];
    public function companyRequest()
    {
        return $this->belongsTo(PlaceRequest::class, 'request_id', 'id');
    }
    public function rider()
    {
        return $this->belongsTo(Rider::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
   
    public function getCodeAttribute()
    {
   
        return "{$this->company_id}c{$this->id}o{$this->rider->id}";
    }
}
