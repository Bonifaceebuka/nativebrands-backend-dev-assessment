@extends('admin.layouts.app')
@section('title')
Video Plans
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
                <h4 class="card-title">Video Plan</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <a href="{{route('admin.plans.create')}}" class="btn btn-success">New Plan</a>
                </div>
            </div>
            <div class="card-body collapse in">
                <div class="card-block card-dashboard">
                        @if(count($plans)>0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Duration</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 1;
                                @endphp
                                    @foreach($plans as $plan)
                                    <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{$plan->name}}</td>
                                    <td>{{number_format($plan->price)}}</td>
                                    <td>{{$plan->duration}}</td>
                                    <td>
                                    <a href="{{route('admin.plans.edit',$plan->id)}}" class="action btn text-white bg-success"><i class="icon-pencil"></i> Edit</a>
                                        <a href="#" class="action btn text-white bg-danger" 
                                        onclick="remove_plan({{$plan->id}})"><i class="icon-trash"></i> Delete</a>
                                        <form action="{{route('admin.plans.destroy',$plan->id)}}" 
                                                method="POST" id="del_plan_{{$plan->id}}" 
                                                style="display:none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @else
                <div class="well">No Plans Found</div>
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