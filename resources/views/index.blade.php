<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>List of available books</title>
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
						<h2>List of available books</h2>
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>ISBN</th>
						<th>Authors</th>
                        <th>Number of pages</th>
                        <th>Publisher</th>
                        <th>Country</th>
                        <th>Release data</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="data_container">
                    
                </tbody>
            </table>
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
	 $.get("/api/v1/book",
                function(response)
                {
                    if(response.status_code == 200){
                    	if (response.data.length>0){
                    		var records = '';
                    	 for (var i = response.data.length - 1; i >= 0; i--){
	                      		records+='<tr>';
			                        records+='<td>'+response.data[i]['name']+'</td>';
			                        records+='<td>'+response.data[i]['isbn']+'</td>';
									records+='<td>'+response.data[i]['authors']+'</td>';
			                        records+='<td>'+response.data[i]['number_of_pages']+'</td>';
			                        records+='<td>'+response.data[i]['publisher']+'</td>';
			                        records+='<td>'+response.data[i]['country']+'</td>';
			                        records+='<td>'+response.data[i]['release_date']+'</td>';
			                        records+='<td>';
			                            records+='<a href="/edit/'+response.data[i]['id']+'" class="edit"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>';
			                            records+='<a href="#" id="deleteBook" class="delete" onclick="remove_book('+response.data[i]['id']+')"><i class="material-icons" title="Delete">&#xE872;</i></a>';
			                        	records+='<form action="api/v1/book/'+response.data[i]['id']+'" method="POST" id="del_book_'+response.data[i]['id']+'" style="display:none;">@csrf @method('DELETE')</form>';
			                        records+='</td>';
		                    	records+='</tr>';
                   		}
                   		$('#data_container').html(records);
                    }
                    else{
                        alert('NO RECORDS FOUND')
                    }
                }
            });
function remove_book(id){
	var choice = confirm('Are you sure that you want to remove this book');
	if (true) {
		$.ajax(
		        {
		            url: "/api/v1/book/"+id,
		            type: 'DELETE',
		            dataType: "JSON",
		            data: {
		                "id": id,
		                "_method": 'DELETE',
		            },
		            success: function (response)
		            {
		                alert(response.message);
		                window.location ='';
		            }
		        });
	}
}
</script>
</body>
</html>
