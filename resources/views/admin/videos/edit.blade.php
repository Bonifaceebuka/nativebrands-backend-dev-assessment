@extends('admin.layouts.app')
@section('title')
New Category
@endsection
@section('extra-styles')
<style>
    .poster-img,.video_file{
        opacity: 0;
    }
    a.btn{
        padding: 0.5rem 1rem !important;
    }
</style>
@endsection
@section('content')
<div class="content-body"><!-- Basic form layout section start -->
<section id="basic-form-layouts">
	<div class="row match-height">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-form-center">New Video</h4>
					<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
					<div class="heading-elements">
                        <a href="{{route('admin.videos.index')}}" class="btn btn-success">Videos</a>
					</div>
				</div>
				<div class="card-body collapse in">
					<div class="card-block">
                        <form class="form" method="POST" action="{{route('admin.videos.update',$video->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
							<div class="row">
								<div class="col-md-6 offset-md-3">
									<div class="form-body">
										<div class="form-group">
                                            <label for="eventInput1">Title</label>
                                            @if ($errors->has('title'))
                                            <span class="helper-text" data-error="wrong" data-success="right">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                            @endif
                                            <input type="text" id="eventInput1" class="form-control" placeholder="name" 
                                            name="title" value="{{ $video->title }}">
                                        </div>
                                        <div class="form-group">
                                                <label for="eventInput1">Category</label>
                                                @if ($errors->has('category'))
                                                <span class="helper-text" data-error="wrong" data-success="right">
                                                    <strong>{{ $errors->first('category') }}</strong>
                                                </span>
                                                @endif
                                                <select class="form-control" name="category_id">
                                                    @foreach($categories as $category)
                                                    <option @if($video->category_id == $category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                        <div class="form-group">
                                                <label for="eventInput1">Paid/Free</label>
                                                @if ($errors->has('is_paid'))
                                                <span class="helper-text" data-error="wrong" data-success="right">
                                                    <strong>{{ $errors->first('is_paid') }}</strong>
                                                </span>
                                                @endif
                                                <select class="form-control" name="is_paid">
                                                    <option @if($video->is_paid == 0) selected @endif value="0">Free</option>                                                    
                                                    <option @if($video->is_paid == 1) selected @endif value="1">Paid</option>                                                    
                                                </select>
                                        </div>
										<div class="form-group">
                                            <label for="eventInput2">Description</label>
                                            @if ($errors->has('description'))
                                            <span class="helper-text" data-error="wrong" data-success="right">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                            @endif
											<textarea class="form-control" placeholder="Description" name="description">{{ $video->description }}</textarea>
                                        </div>
                                        <div class="form-group">
                                                @if ($errors->has('poster'))
                                                <span class="helper-text" data-error="wrong" data-success="right">
                                                    <strong>{{ $errors->first('poster') }}</strong>
                                                </span><br/>
                                                @endif
                                                <img src="{{$video->poster}}" class="img-responsive" alt=""/> <br> <br>
                                            <button type="button" class="btn btn-warning mr-1" id="poster_picker">
                                                <i class="icon-image"></i> Choose a Poster Image
                                            </button>
                                        <input type="file" name="poster" class="poster-img" id="poster_file">
                                        </div>
                                        <div class="form-group">
                                                @if ($errors->has('video_file'))
                                                <span class="helper-text" data-error="wrong" data-success="right">
                                                    <strong>{{ $errors->first('video_file') }}</strong>
                                                </span><br/>
                                                @endif
                                            <video controls autoplay="off">
                                            <source src="{{$video->video_file}}" />
                                            </video> <br> <br>
                                            <button type="button" class="btn btn-warning mr-1" id="video_file_picker">
                                                <i class="icon-video"></i> Choose a Video File
                                            </button>
                                        <input type="file" name="video_file" class="video_file" id="video_file">
                                        </div>
									</div>
								</div>
							</div>
							<div class="form-actions center">
								<button type="submit" class="btn btn-primary">
									<i class="icon-check2"></i> Save changes
								</button>
							</div>
						</form>	

					</div>
				</div>
			</div>
		</div>
	</div>
</section>
{{--
<!-- // Basic form layout section end -->
        {{-- </div>
      </div>
    </div> --}}
@endsection
@section('extra-script')
    <script>
         $('#poster_picker').on('click', function(e){
        e.preventDefault();
        $('#poster_file').click();
         });
         $('#video_file_picker').on('click', function(e){
        e.preventDefault();
        $('#video_file').click();
         });
    </script>
    <script src="{{asset('assets/vendors/js/sweetalert/sweetalert.min.js')}}"></script>
    <script type="text/javascript">
        //$(document).ready(function() {
            @if(Session::has('success-message'))        
           swal({
              title: "New Entry",
              text: '{{ Session::get('success-message') }}',
              icon: 'success',
              closeOnClickOutside: false,
              value:'o',
            });
            @endif
            @if(Session::has('error-message'))        
           swal({
              title: "New Entry",
              text: '{{ Session::get('error-message') }}',
              icon: 'error',
              closeOnClickOutside: false,
              value:'o',
            });
            @endif
        //});
        </script>
    @endsection