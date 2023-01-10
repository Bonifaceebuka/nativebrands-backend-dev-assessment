@extends('admin.layouts.app')
@section('title')
New Category
@endsection
@section('extra-styles')
<style>
    .banner-img{
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
					<h4 class="card-title" id="basic-layout-form-center">New Category</h4>
					<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
					<div class="heading-elements">
                        <a href="{{route('admin.categories.index')}}" class="btn btn-success">Categories</a>
					</div>
				</div>
				<div class="card-body collapse in">
					<div class="card-block">
                        <form class="form" method="POST" action="{{route('admin.categories.store')}}" enctype="multipart/form-data">
                            @csrf
							<div class="row">
								<div class="col-md-6 offset-md-3">
									<div class="form-body">
										<div class="form-group">
                                            <label for="eventInput1">Name</label>
                                            @if ($errors->has('name'))
                                            <span class="helper-text" data-error="wrong" data-success="right">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
											<input type="text" id="eventInput1" class="form-control" placeholder="name" name="name" value="{{ old('name') }}">
										</div>
										<div class="form-group">
                                            <label for="eventInput2">Description</label>
                                            @if ($errors->has('description'))
                                            <span class="helper-text" data-error="wrong" data-success="right">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                            @endif
											<textarea class="form-control" placeholder="Description" name="description">{{ old('description') }}</textarea>
                                        </div>
                                        <div class="form-group">
                                                @if ($errors->has('banner'))
                                                <span class="helper-text" data-error="wrong" data-success="right">
                                                    <strong>{{ $errors->first('banner') }}</strong>
                                                </span><br/>
                                                @endif
                                        <button type="button" class="btn btn-warning mr-1" id="banner_picker">
                                                <i class="icon-image"></i> Choose a Banner Image
                                            </button>
                                        <input type="file" name="banner" class="banner-img" id="banner_file">
                                        </div>
									</div>
								</div>
							</div>
							<div class="form-actions center">
								<button type="submit" class="btn btn-primary">
									<i class="icon-check2"></i> Create
								</button>
							</div>
						</form>	

					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- // Basic form layout section end -->
        {{-- </div>
      </div>
    </div> --}}
@endsection
@section('extra-script')
    <script>
         $('#banner_picker').on('click', function(e){
        e.preventDefault();
        $('#banner_file').click();
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