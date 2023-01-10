@extends('admin.layouts.app')
@section('title')
New Users
@endsection
@section('extra-styles')
<style>
    #avatar{
        opacity: 0;
    }
    a.btn{
        padding: 0.5rem 1rem !important;
    }
    .img-responsive {
    width: 200px;
    }
    .form-group.avatar-container {
    padding-left: 25%;
    padding-right: 20%;
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
					<h4 class="card-title" id="basic-layout-form-center">Update Profile</h4>
					<a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
					{{-- <div class="heading-elements">
                        <a href="{{route('admin.users.index')}}" class="btn btn-success">Users</a>
					</div> --}}
				</div>
				<div class="card-body collapse in">
					<div class="card-block">
                        <form class="form" method="POST" action="{{route('admin.users.update',$user->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
							<div class="row">
								<div class="col-md-6 offset-md-3">
									<div class="form-body">
                                        <div class="form-group avatar-container">
                                                @if ($errors->has('avatar'))
                                                <span class="helper-text" data-error="wrong" data-success="right">
                                                    <strong>{{ $errors->first('avatar') }}</strong>
                                                </span>
                                                @endif
                                                <img src="{{$user->avatar}}" class="img-responsive" alt=""/> <br> <br>
                                                <button type="button" class="btn btn-warning mr-1" id="avatar_picker">
                                                    <i class="icon-image"></i> Choose an Image
                                                </button>
                                                <input type="file" name="avatar" id="avatar">
                                            </div>
										<div class="form-group">
                                            <label for="eventInput1">First name</label>
                                            @if ($errors->has('first_name'))
                                            <span class="helper-text" data-error="wrong" data-success="right">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                            @endif
                                            <input type="text" id="eventInput1" class="form-control" placeholder="first name" 
                                            name="first_name" value="{{ $user->first_name }}">
                                        </div>
                                        <div class="form-group">
                                                <label for="eventInput1">Last name</label>
                                                @if ($errors->has('last_name'))
                                                <span class="helper-text" data-error="wrong" data-success="right">
                                                    <strong>{{ $errors->first('last_name') }}</strong>
                                                </span>
                                                @endif
                                                <input type="text" id="eventInput1" class="form-control" placeholder="first name" 
                                                name="last_name" value="{{ $user->last_name }}">
                                        </div>
                                        <div class="form-group">
                                                <label for="eventInput1">Gender</label>
                                                @if ($errors->has('gender'))
                                                <span class="helper-text" data-error="wrong" data-success="right">
                                                    <strong>{{ $errors->first('gender') }}</strong>
                                                </span>
                                                @endif
                                                <select class="form-control" name="gender">
                                                    <option @if($user->gender == 'female') selected @endif value="">Female</option>
                                                    <option @if($user->gender == 'male') selected @endif value="">Male</option>
                                                </select>
                                        </div>
                                        <div class="form-group">
                                                <label for="eventInput1">Phone</label>
                                                @if ($errors->has('phone'))
                                                <span class="helper-text" data-error="wrong" data-success="right">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                                @endif
                                                <input type="text" id="eventInput1" class="form-control" placeholder="first name" 
                                                name="phone" value="{{ $user->phone }}">
                                        </div>
									</div>
								</div>
							</div>
							<div class="form-actions center">
								<button type="submit" class="btn btn-primary">
									<i class="icon-check2"></i> Save Changes
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
         $('#avatar_picker').on('click', function(e){
        e.preventDefault();
        $('#avatar').click();
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