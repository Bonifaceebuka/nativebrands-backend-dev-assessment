<?php

namespace App\Http\Controllers\Admin;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class SubscriptionController extends Controller
{

    public function index()
    {
        //Subscription::orderBy('name', 'ASC')->get();
        $Subscriptions = Subscription::join('payments', 'payments.id', '=', 'subscriptions.payment_id')
                ->join('users', 'users.id', '=', 'payments.user_id')
                ->join('plans', 'plans.id', '=', 'payments.plan_id')
                ->where('subscriptions.status','active')
                ->get(
                        [
                            'subscriptions.id as sub_id',
                            'subscriptions.end_date as sub_end_date',
                            // DATEDIFF('subscriptions.end_date', CURDATE()).' AS days_left',
                            'subscriptions.status as sub_status',
                            'payments.id as pay_id',
                            'payments.method_used as pay_method_used',
                            'payments.paypal_payment_id as pay_paypal_payment_id',
                            'payments.plan_id as pay_plan_id',
                            'plans.name as plan_name',
                            'plans.duration as plan_duration',
                            'plans.price as plan_price',
                            'payments.id as pay_id',
                            'users.id as user_id',
                            'users.first_name as user_first_name',
                            'users.last_name as user_last_name',
                            'users.email as user_email',
                        ]);
        // return $Subscriptions;
        return view('admin.subscriptions.index',['subscriptions'=>$Subscriptions]);
    }

    
}
