@extends('admin.layouts.app')
@section('title')
Video Subscriptions
@endsection
@section('extra-styles')
<style>
    a.btn{
        padding: 0.5rem 1rem !important;
    }
    td .img-responsive {
    width: 50px;
    }
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Subscriptions</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
            </div>
            <div class="card-body collapse in">
                <div class="card-block card-dashboard">
                        @if(count($subscriptions)>0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Plan name</th>
                                    <th>Duration</th>
                                    <th>Price</th>
                                    <th>Payment method</th>
                                    <th>User</th>
                                    <th>Days remaining</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 1;
                                @endphp
                                    @foreach($subscriptions as $subscription)
                                    <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{$subscription->plan_name}}</td>
                                    <td>{{$subscription->plan_duration}} days</td>
                                    <td>${{number_format($subscription->plan_price)}}</td>
                                    <td>{{$subscription->pay_method_used}}</td>
                                    <td>{{$subscription->user_first_name.' '.$subscription->user_last_name}}</td>
                                    <td>
                                        @php
                                        $subscription_end = new \Carbon\Carbon($subscription->sub_end_date);
                                        $left = $subscription_end->diffForHumans();
                                        echo $left;
                                        @endphp
                                    </td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @else
                <div class="well">No Subscriptions Found</div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Basic Tables end -->
        </div>
      </div>
    </div>
@endsection
@section('extra-script')
<script src="{{asset('assets/vendors/js/sweetalert/sweetalert.min.js')}}"></script>
<script>
     @if(Session::has('success-message'))        
       swal({
          title: "Removed Entry",
          text: '{{ Session::get('success-message') }}',
          icon: 'success',
          closeOnClickOutside: false,
          value:'o',
        });
        @elseif(Session::has('error-message'))        
        swal({
            title: "Removed Entry",
            text: '{{ Session::get('error-message') }}',
            icon: 'error',
            closeOnClickOutside: false,
            value:'o',
            });
        @endif
        function remove_plan(id){
            swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this plan record!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $('#del_plan_'+id).submit();
            } else {
            }
            });
        }
</script>
@endsection