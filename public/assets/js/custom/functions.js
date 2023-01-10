var _URL = window.URL || window.webkitURL;
var msg = '';
function validate_image_upload(selected_image) {
    var image_file = selected_image[0].files[0]
    var image_fileSize = selected_image[0].files[0].size; /// VALIDATING PROFILE IMAGE FIELD STARTS HERE
    var image_extension = selected_image.val().replace(/^.*\./, '');
    var image_fileName = selected_image[0].files[0].name;
    var file_Ext = "gif, jpg, jpeg, png";
    var image_allowedExt = new Array("gif", "jpg", "jpeg", "png", "GIF", "JPG", "JPEG", "PNG");
    var Confirm1 = true;
    //alert(fielSize)
    if (typeof (image_file) == "undefined") {
        msg = "Please Your Browser Does't Support HTML 5 Technology Which Was Used In This Site.";
        return msg;
    }
    if (image_allowedExt.indexOf(image_extension) < 0) {
        msg = "Only "+file_Ext + ' image file extension/type is allowed.';
        return msg;
    }
    else if (image_fileSize > 5242880) {
        msg = "Uploaded file is larger than 5mb";
        return msg;
    }

    else {
        // $('#media_up_ajax_feedback').fadeOut('fast').html('');
        // image_fileimg = new Image();
        // image_fileimg.src = _URL.createObjectURL(image_file);
        // //checkWidth();
        // changer(this)
        return true;
    }
}
function changer(input,image_height,image_width) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            image_fileimg.onload = function () {
                image_fileimgwidth = this.width;
                image_fileimgheight = this.height;
                if (image_fileimgwidth < image_width) {
                    $('#media_up_ajax_feedback').show('slow').html('<span class="btn btn-danger">The dimension of the uploaded track art file must be width: 400px & height: 300px !</span>');
                }
                else if(image_fileimgheight < image_height){

                }
                else {
                    $('#track_art_preview').attr('src', e.target.result).addClass('fade');
                    $('#media_up_ajax_feedback').fadeOut('fast').html('');
                    $('#media_up_ajax_feedback').show('slow').html('<span class="btn btn-danger">The dimension of the uploaded track art file must be width: 400px & height: 300px !</span>');
                    Confirm1 = false
                    return false;
                }

            }

        }
        reader.readAsDataURL(input.files[0]);

    }

}

function swal_alert(title,icon,message){
    swal({
        title: title,
        text: message,
        icon: icon,
        closeOnClickOutside: false,
        value:'o',
      });
}

function toaster_alert(title,icon,message,bg,pg){
    iziToast.show(
        { 
            maxWidth: "280px", class: "success-toast", 
            icon: icon, 
            title: title, 
            message: message, 
            titleColor: "#fff", 
            messageColor: "#fff", 
            iconColor: "#fff", 
            backgroundColor: bg, 
            progressBarColor: pg, 
            position: "bottomRight", 
            transitionIn: "fadeInUp", 
            close: !1, 
            timeout: 2500, 
            zindex: 99999 });
}
