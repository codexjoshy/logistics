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

    public function riderNames()
    {
        if($this->user->name){
            $name = explode(" ", $this->user->name);
            if($name > 1){ 
                $firstName = $name[0];
                unset($name[0]);
                $lastName = implode(" ", $name);
            }else{ 
                $firstName = $name[0];
                $lastName = $name[1] ?? '';
            }
            return [
                "firstName" => $firstName,
                "lastName" => $lastName
            ];
        }
    }
}