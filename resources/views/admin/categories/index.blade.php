@extends('admin.layouts.app')
@section('title')
Video Categories
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
                <h4 class="card-title">Video category</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <a href="{{route('admin.categories.create')}}" class="btn btn-success">New Category</a>
                </div>
            </div>
            <div class="card-body collapse in">
                <div class="card-block card-dashboard">
                        @if(count($categories)>0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Banner</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 1;
                                @endphp
                                    @foreach($categories as $category)
                                    <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td><img src="{{$category->banner}}" class="img-responsive" alt=""/></td>
                                    <td>{{$category->name}}</td>
                                    <td>
                                    <a href="{{route('admin.categories.edit',$category->id)}}" class="action btn text-white bg-success"><i class="icon-pencil"></i> Edit</a>
                                        <a href="#" class="action btn text-white bg-danger" 
                                        onclick="remove_category({{$category->id}})"><i class="icon-trash"></i> Delete</a>
                                        <form action="{{route('admin.categories.destroy',$category->id)}}" 
                                                method="POST" id="del_category_{{$category->id}}" 
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
                <div class="well">No Categories Found</div>
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
        function remove_category(id){
            swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this category record!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $('#del_category_'+id).submit();
            } else {
            }
            });
        }
</script>
@endsection