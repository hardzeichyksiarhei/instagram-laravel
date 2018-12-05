<?php

namespace App;

use App\ReferralProgram;
use App\ReferralLink;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'phone', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function getReferral()
    {
      return ReferralLink::getReferral($this);
    }

    public function addCredits($credit)
    {
      $this->balans += $credit;
      $this->save();
    }

    public function minusCredits($credit)
    {
      $this->balans -= $credit;
      $this->save();
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function billings()
    {
      return $this->hasMany('App\Models\Billing');
    }

    public function orders()
    {
      return $this->hasMany('App\Models\Order');
    }
}
