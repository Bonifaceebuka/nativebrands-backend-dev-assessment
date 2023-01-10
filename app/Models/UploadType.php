<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadType extends Model
{
    protected $fillable = [
    'name',
    ];

    public function upload(){
    	return $this->hasMany(Upload::class);
    }
}
