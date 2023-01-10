<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $fillable = [
    'file_name',
    'user_id',
    'upload_type_id',
    'upload_category_id'
    ];

    public function user(){
    	return $this->belongsTo(\App\User::class,'id','id');
    }
    public function upload_type(){
    	return $this->belongsTo(\App\User::class);
    }
    public function upload_category(){
    	return $this->belongsTo(\App\User::class);
    }
}
