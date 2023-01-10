<?php

namespace App\Http\Controllers\Admin;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class PaymentController extends Controller
{

    public function index()
    {
        //Payment::orderBy('name', 'ASC')->get();
        $Payments = Payment::paginate(20);
        return view('admin.payments.index',['payments'=>$Payments]);
    }

    
}
