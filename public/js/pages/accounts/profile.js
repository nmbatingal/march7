$(function () {
    
    //Advanced form with validation
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
                required: true
            },
            mobile_number : {
                required: true
            },
            position : {
                required: true
            },
            office : {
                required: true
            },
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