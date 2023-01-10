<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table = 'subscriptions';
    protected $fillable = [
        'payment_id', 
        'end_date', 
        'status', 
    ];

    public function payment()
    {
       return $this->belongsTo(Payment::class);
    }

   
}
