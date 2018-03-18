$(function () {
    
    // Profile Tab
    $('#form_profile').validate({
        rules: {
            firstname : "required",
            lastname  : "required",
            mobile_number : {
                required : true
            },
            sex : {
                required: true
            },
            birthday : {
                required: true
            },
            address : {
                required: true
            },
            email : {
                required: true,
                email: true
            },
            mobile_number : {
                required: true,
                minlength: 11
            },
            position : {
                required: true
            },
            office : {
                required: true
            },
        },
        messages: {
            mobile_number: {
                required: "Please specify your phone number",
                minlength: jQuery.validator.format("Your phone number must be at least {0} numbers!")
            },
            email: {
                required: "Your email address is required",
                email: "Your email address must be in the format of name@domain.com"
            }
        },
        onfocusout: function (element) {
            $(element).valid();
        },
        onkeyup: function (element) {
            $(element).valid();
        },
        highlight: function (element) {
            $(element).parent('.form-group').addClass('has-danger');
            $(element).addClass('form-control-danger');
        },
        errorElement: "div",
        errorClass: "form-control-feedback",
        errorPlacement: function(error, element) {

            if ( $(element).prop('type') == 'radio' ) {
                error.insertAfter( $(element).closest('.form-group').find('label').next() );
            } else {
                error.insertAfter(element);
            }
        },
        success: function ( label, element ) {
            $(element).parent('.form-group').removeClass('has-danger').addClass('has-success');
            $(element).removeClass('form-control-danger').addClass('form-control-success');
        }
    }); 

    // Settings Tab
    $('#form_settings').validate({
        rules: {
            username : {
                required : true,
                minlength: 6
            },
            password : {
                required : true,
                minlength: 8
            },
            confirm_password : {
                required : true,
                equalTo : "#password"
            }
        },
        messages: {
            username: { 
                required: "Please specify your username",
                minlength: jQuery.validator.format("Username should be at least {0} characters!")
            },
            password: {
                required: "Please specify your password",
                minlength: jQuery.validator.format("Password should be at least {0} characters!")
            },
            confirm_password: {
                required: "Please confirm your password",
                equalTo: "Password should be the same to confirm!"
            }
        },
        onfocusout: function (element) {
            $(element).valid();
        },
        onkeyup: function (element) {
            $(element).valid();
        },
        highlight: function (element) {
            $(element).parent('.form-group').addClass('has-danger');
            $(element).addClass('form-control-danger');
        },
        errorElement: "div",
        errorClass: "form-control-feedback",
        errorPlacement: function(error, element) {

            if ( $(element).prop('type') == 'radio' ) {
                error.insertAfter( $(element).closest('.form-group').find('label').next() );
            } else {
                error.insertAfter(element);
            }
        },
        success: function ( label, element ) {
            $(element).parent('.form-group').removeClass('has-danger').addClass('has-success');
            $(element).removeClass('form-control-danger').addClass('form-control-success');
        }
    });
});