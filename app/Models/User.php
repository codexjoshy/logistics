<?php

namespace App\Models;

use App\Services\TransactionService;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Company()
    {
        return $this->hasOne(Company::class);
    }
    public function rider()
    {
        return $this->hasOne(Rider::class);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function balance()
    {
        $balance = (new TransactionService)->getBalance($this->id);
        return floatval($balance);
    }
    public function companyVerified()
    {
        return $this->Company && $this->Company->status === 'verified';
    }
    public function isOwing()
    {
       return $this->balance() <= 0;
    }
    public function getNoOfRiders()
    {
        return count($this->company->riders);
    }
}
