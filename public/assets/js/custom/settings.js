// $(function() {
  ///////Consuming the API using AJAX and JQuery
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('#username').on('keyup', function(){
    var username = $('#username').val();
    if(username.length >= 3){
        var isvalid_username = check_username(username);
        if(isvalid_username == true){
            $('#username-msg').show('fast');
            $('#username-msg').addClass('success');
            $('#username-msg').html('Available');
        }
        else if(isvalid_username == false){
            $('#username-msg').show('fast');
            $('#username-msg').addClass('error');
            $('#username-msg').html('Already taken');
        }
        else{
            $('#username-msg').show('fast');
            $('#username-msg').addClass('error');
            $('#username-msg').html('Internal Error!');
        }
    }
});

$('#personal-settings').validate({
    // Specify validation rules
    rules: {
      fname: {
        required: true
      },
      fname: {
        required: true
      },
      lname: {
        required: true
      },
      username: {
        required: true
      },
      birthdate: {
        required: true
      },
      
    },
    // Specify validation error messages
    messages: {
      fname: {
        required: "First name is required",
      },
      lname: {
        required: "Last name is required",
      },
      username: {
        required: "Username is required",
      },
      birthdate: {
        required: "Birth date is required",
      },
      
    },
    submitHandler: function(form) {
    var formData = $('#personal-settings').serialize();
    var formAction = '/settings/personal-settings';
    var msg = '';
    var message = icon = title = bg = pg = '';
    $('.msg').show('fast');
          $.ajax(
            {
                url: formAction,
                type: 'POST',
                dataType: "JSON",
                beforeSend: function() {
                  $('#submit-personal-settings').addClass("is-loading");
                  },
                data: formData,
                success: function(response)
                {
                    // console.log(response);
                  $('#submit-personal-settings').html('Save Changes');
                  if(response.status_code == 200) {
                    message = response.message;
                    icon = "mdi mdi-heart-broken";
                    title ='Profile update';
                    bg = "#28a745";
                    pg = "rgba(202, 255, 214, 0.5)";
                    toaster_alert(title,icon,message,bg,pg);
                    $('#submit-personal-settings').removeClass("is-loading");                  
                    $('#submit-personal-settings').html('Save Changes');
                    return
                  }
                  else if(response.validation_message){
                    ////Managing Laravel Error responses
                     $.each(response.validation_message, function (key, err) 
                      {
                        if($.isArray(err) == true){
                          $.each(err, function (key, err_message){
                            msg = err_message;
                          });
                        }
                        else{
                            msg = err;
                        }
                      });
                  }
                  else{
                      msg = response.message;
                      message = msg;
                      icon = "mdi mdi-heart-broken";
                      bg = '#dc3545';
                      pg = "rgba(244, 190, 195, 0.5)";
                      title ='Profile update';
                      toaster_alert(title,icon,message,bg,pg);
                  }
                  $('#submit-personal-settings').removeClass("is-loading");                  
                  $('#submit-personal-settings').html('Save Changes');
                },
                error:function(response){
                  $('#submit-personal-settings').removeClass("is-loading");                                      
                  $('#submit-personal-settings').html('Save Changes');
                    message = 'Internal server error was encountered, please try again or write to us.';
                    icon = "mdi mdi-heart-broken";
                    bg = '#dc3545';
                    title ='Profile update';
                    pg = "rgba(244, 190, 195, 0.5)";
                    toaster_alert(title,icon,message,bg,pg);
                }
            });
    }
  });
//   });
