<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id', 
        'body', 
        'parent', 
        'parent_id', 
        'approved', 
        'video_id', 
    ];

    public function videos()
    {
       return $this->belongsTo(Video::class);
    }

    public function users()
    {
        return $this->belongsTo(\App\User::class,'user_id');
    }

   
}
