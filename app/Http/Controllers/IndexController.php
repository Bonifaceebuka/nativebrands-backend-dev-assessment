<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
class IndexController extends Controller
{
    public function index(){
    	return view('index');
    }
    public function edit($id){
    	 $book_detail = Book::findOrfail($id);
    	return view('edit',['book_detail'=>$book_detail]);
    }
}
