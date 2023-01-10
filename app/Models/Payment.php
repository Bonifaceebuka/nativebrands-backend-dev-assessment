<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id', 
        'method_used', 
        'plan_id', 
        'paypal_payment_id', 
        'screenshot', 
        'screen_shot_pubID'
    ];

    public function subscription()
    {
       return $this->hasOne(Subscription::class);
    }
    public function user()
    {
       return $this->belongsTo(\App\User::class);
    }
    public function plan()
    {
       return $this->belongsTo(Plan::class);
    }

   
}
