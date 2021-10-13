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
}
