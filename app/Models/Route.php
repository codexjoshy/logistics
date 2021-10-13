<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function rider()
    {
        return $this->belongsTo(Rider::class);
    }
    public function directions()
    {
        return $this->hasMany(RouteDirection::class, 'route_id', 'id');
    }
    
}
