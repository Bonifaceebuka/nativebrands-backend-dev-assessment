// $(function() {
  ///////Consuming the API using AJAX and JQuery
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    $("form[name='register']").validate({
      // Specify validation rules
      rules: {
        email: {
          required: true,
          email: true
        },
        password: {
          required: true,
          minlength: 5
        },
        cpassword: {
            required: true,
            minlength: 5,
            equalTo: "#password"
        },
        is_agreed: "required",
      },
      // Specify validation error messages
      messages: {
        password: {
          required: "Password is required",
          minlength: "Password must be at least 5 characters long"
        },
        cpassword: {
            required: "Confirm password is required",
            minlength: "Comfirm password must be at least 5 characters long",
            equalTo: "Confirm password must be the same as password"
        },
        email: {
            required: "Email is required",
            email:"A valid email address"
        },
        is_agreed: "You must agree to our terms & conditions",
      },
      submitHandler: function(form) {
      var formData = $('#register').serialize();
      var formAction = 'api/v1/auth/signup';
      var msg = '';
            $.ajax(
              {
                  url: formAction,
                  type: 'POST',
                  dataType: "JSON",
                  beforeSend: function() {
                    $('#register_btn').html('Please wait.....')
                    },
                  data: formData,
                  success: function(response)
                  {
                    $('#register_btn').html('Create an account');
                    $('.msg').show('fast');
                    if(response.status_code == 200 || response.status_code == 201) {
                       $('.msg').addClass('alert-success');
                        msg = response.message;
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
                    }
                   $('.msg').addClass('alert-danger');
                    $('.msg').html(msg)
                  },
                  error:function(response){
                    $('#register_btn').html('Create an account');
                    $('.msg').addClass('alert-danger');
                    msg = 'Internal server error was encountered, please try again or write to us.'
                    $('.msg').html(msg)
                  }
              });
      }
    });
//   });