<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';
    protected $fillable = [
    'name',
	'isbn',
	'authors',
	'country',
	'number_of_pages',
	'publisher',
	'release_date',
    ];

}
