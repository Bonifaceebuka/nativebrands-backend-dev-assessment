<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
    	'title',
    	'description',
    	'category_id',
    	'admin_id',
    	'slug',
    	'poster',
    	'poster_public_id',
    	'video_file',
    	'video_public_id',
    	'is_paid'
    ];

    public function category(){
    	return $this->belongsTo(Category::class);
	}
	public function user(){
    	return $this->belongsTo(\App\User::class,'admin_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
