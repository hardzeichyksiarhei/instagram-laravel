<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferralRelationship extends Model
{
  protected $fillable = ['referral_link_id', 'user_id'];

  public function referralLink()
  {
      return $this->belongsTo('App\ReferralLink');
  }

  public function addReferralCredits($credit)
  {
    $this->referral_balans += $credit;
    $this->save();
  }
}
