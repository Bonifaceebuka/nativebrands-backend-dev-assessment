<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Editing > "{{$book_detail->name}}"</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/styles.css')}}">
  <body>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Editing > "{{$book_detail->name}}" </h2>
					</div>
				<a class="btn btn-success pull-right" href="/">See More Books</a>
                </div>
            </div>
            <form class="book_update" method ='POST'>
            	@csrf
					<div class="modal-body">					
						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control"  name="name" required value="{{$book_detail->name}}">
						</div>
						<div class="form-group">
							<label>ISBN</label>
							<input type="text" class="form-control" name="isbn" required value="{{$book_detail->isbn}}">
						</div>
						<div class="form-group">
							<label>Authors</label>
							<input type="text" class="form-control" name="authors" required value="{{$book_detail->authors}}"/>
						</div>
						<div class="form-group">
							<label>Number of pages</label>
							<input type="number" class="form-control" name="number_of_pages" required value="{{$book_detail->number_of_pages}}">
						</div>	
						<div class="form-group">
							<label>Publisher</label>
							<input type="text" class="form-control" name="publisher" required value="{{$book_detail->publisher}}">
						</div>	
						<div class="form-group">
							<label>Country</label>
							<input type="text" class="form-control" name="country" required value="{{$book_detail->country}}">
						</div>
						<div class="form-group">
							<label>Release data</label>
							<input type="text" class="form-control" name="release_date" required value="{{$book_detail->release_date}}">
						</div>						
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-info" value="Save changes">
					</div>
			</form>

    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
	///////Consuming the API using AJAX and JQuery
	 $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
	 $(".book_update").on('submit',function(e){
	 	e.preventDefault();
	 	
        var formData = $(this).serialize();
        $.ajax(
        {
            url: "/api/v1/book/{{$book_detail->id}}",
            type: 'PATCH',
            dataType: "JSON",
            data: formData,
            success: function(response)
            {
            	alert(response.message)
            }
        });

        // console.log("It failed");
    });
</script>
</body>
</html>
