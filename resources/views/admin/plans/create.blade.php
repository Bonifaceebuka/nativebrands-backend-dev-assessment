@extends('admin.layouts.app')
@section('title')
New Plan
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
					<h4 class="card-title" id="basic-layout-form-center">New Plan</h4>
					<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
					<div class="heading-elements">
                        <a href="{{route('admin.plans.index')}}" class="btn btn-success">Plans</a>
					</div>
				</div>
				<div class="card-body collapse in">
					<div class="card-block">
                        <form class="form" method="POST" action="{{route('admin.plans.store')}}" enctype="multipart/form-data">
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
                                                <label for="eventInput1">Duration</label>
                                                @if ($errors->has('duration'))
                                                <span class="helper-text" data-error="wrong" data-success="right">
                                                    <strong>{{ $errors->first('duration') }}</strong>
                                                </span>
                                                @endif
                                                <input type="text" id="eventInput1" class="form-control" placeholder="name" name="duration" value="{{ old('duration') }}">
                                            </div>
                                        <div class="form-group">
                                                <label for="eventInput1">Price</label>
                                                @if ($errors->has('price'))
                                                <span class="helper-text" data-error="wrong" data-success="right">
                                                    <strong>{{ $errors->first('price') }}</strong>
                                                </span>
                                                @endif
                                                <input type="text" id="eventInput1" class="form-control" placeholder="name" name="price" value="{{ old('price') }}">
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