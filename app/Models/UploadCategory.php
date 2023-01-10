<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadCategory extends Model
{
    protected $fillable = [
    'name',
    ];

    public function upload(){
    	return $this->hasMany(Upload::class);
    }
}
