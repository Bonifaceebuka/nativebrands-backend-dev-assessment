//////////////This file contains the reusable functions that interacts with Disqussion Local API
function check_username(username){
    /////Checks If a Username already exist
    if(username.length>=3){
        var msg ='';
        $.ajax(
            {
                url: 'api/v1/check_username/'+username,
                type: 'POST',
                dataType: "JSON",
                // data: formData,
                success: function(response)
                {
                  msg = response;
                },
                error:function(response){
                    msg = response;
                }
            });
            return msg;
    }
}