<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class ReferralLink extends Model
{
    protected $fillable = ['user_id', 'referral_program_id'];

    protected $appends = [ 'link' ];

    protected static function boot()
    {
      parent::boot();

      static::creating(function ($model) {
        $model->generateCode();
      });
    }

    private function generateCode()
    {
        $this->code = Uuid::uuid1()->toString();
    }

    public static function getReferral($user)
    { 
      return static::firstOrCreate([
        'user_id' => $user->id
      ]);
    }

    public function getLinkAttribute()
    {
        return url('/register') . '?ref=' . $this->code;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function relationships()
    {
        return $this->hasMany('App\ReferralRelationship');
    }
}
