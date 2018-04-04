$(function () {
    
    // Profile Tab
    $('#form_create_semester').validate({
        rules: {
            month_from : "required",
            month_to   : "required",
            year       : "required",
        },
        onfocusout: function (element) {
            $(element).valid();
        },
        onkeyup: function (element) {
            $(element).valid();
        },
        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-danger');
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
            $(element).closest('.form-group').removeClass('has-danger').addClass('has-success');
            $(element).removeClass('form-control-danger').addClass('form-control-success');
        }
    });
});