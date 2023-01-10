<?php

namespace App\Http\Controllers\Admin;
use App\User;
use App\Models\Video;
use App\Models\Category;
use App\Models\Plan;
use App\Models\Comment;
use App\Models\Subscription;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $users = User::count();
        $Totalvideos = Video::count();
        $videos = Video::take(20)->get();
        $categories = Category::count();
        $subscriptions = Subscription::count();
        $plans = Plan::count();
        $comments = Comment::count();
        // return $videos;
    	return view('admin/index',compact('users','categories','Totalvideos','videos','plans','comments','subscriptions'));
    }
}
