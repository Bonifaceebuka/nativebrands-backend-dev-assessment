// $(function() {
  ///////Consuming the API using AJAX and JQuery
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    $("form[name='login']").validate({
      // Specify validation rules
      rules: {
        email: {
          required: true,
          email: true
        },
        password: {
          required: true,
          minlength: 5
        }
      },
      // Specify validation error messages
      messages: {
        password: {
          required: "Password is required",
        },
        email: {
            required: "Email is required",
            email:"A valid email address"
        }
      },
      submitHandler: function(form) {
      var formData = $('#login').serialize();
      var formAction = '/login';
      var msg = '';
      $('.msg').show('fast');
            $.ajax(
              {
                  url: formAction,
                  type: 'POST',
                  dataType: "JSON",
                  beforeSend: function() {
                    $('#login_btn').html('Please wait.....')
                    },
                  data: formData,
                  success: function(response)
                  {
                    $('#login_btn').html('Login now');
                    if(response.status_code == 200 || response.user_type == 'user') {
                        window.location = '/';
                    }
                   $('.msg').addClass('alert-danger');
                    $('.msg').html(msg)
                  },
                  error:function(response){
                    // console.log(response)
                    $('#login_btn').html('Login now');
                    $('.msg').addClass('alert-danger');
                    if($.parseJSON(response.responseText).errors){
                      var errors = $.parseJSON(response.responseText).errors;
                      ////Managing Laravel Error responses
                       $.each(errors, function (key, err) 
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
                        msg = 'Internal server error was encountered, please try again or write to us.'
                    }
                    console.log(msg)
                    $('.msg').html(msg)
                  }
              });
      }
    });
//   });