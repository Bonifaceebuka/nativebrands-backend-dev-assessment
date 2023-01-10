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
                <h4 class="card-title">Payments</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
            </div>
            <div class="card-body collapse in">
                <div class="card-block card-dashboard">
                        @if(count($payments)>0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Payment method</th>
                                    <th>User</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 1;
                                @endphp
                                    @foreach($payments as $subscription)
                                    <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{$subscription->method_used}}</td>
                                    <td>{{$subscription->user->first_name.' '.$subscription->user->last_name}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$payments->links()}}
                    </div>
                </div>
                @else
                <div class="well">No Payments Found</div>
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