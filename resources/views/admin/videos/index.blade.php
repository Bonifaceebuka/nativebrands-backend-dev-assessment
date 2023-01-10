@extends('admin.layouts.app')
@section('title')
Videos
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
                <h4 class="card-title">Video video</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <a href="{{route('admin.videos.create')}}" class="btn btn-success">New Video</a>
                </div>
            </div>
            <div class="card-body collapse in">
                <div class="card-block card-dashboard">
                        @if(count($videos)>0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Poster</th>
                                    <th>Title</th>
                                    <th>Posted By</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 1;
                                @endphp
                                    @foreach($videos as $video)
                                    <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td><img src="{{$video->poster}}" class="img-responsive" alt=""/></td>
                                    <td>{{$video->title}}</td>
                                    <td>{{ucfirst($video->user->first_name)}}</td>
                                    <td>
                                    <a href="{{route('admin.videos.edit',$video->id)}}" class="action btn text-white bg-success"><i class="icon-pencil"></i> Edit</a>
                                        <a href="#" class="action btn text-white bg-danger" 
                                        onclick="remove_video({{$video->id}})"><i class="icon-trash"></i> Delete</a>
                                        <form action="{{route('admin.videos.destroy',$video->id)}}" 
                                                method="POST" id="del_video_{{$video->id}}" 
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
                <div class="well">No Videos Found</div>
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
        function remove_video(id){
            swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this video record!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $('#del_video_'+id).submit();
            } else {
            }
            });
        }
</script>
@endsection