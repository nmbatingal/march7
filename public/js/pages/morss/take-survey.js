$(function () {

    var form     = $('#form_take_survey').show();

    form.validate({
        onfocusout: function (element) {
            $(element).valid();
        },
        onkeyup: function (element) {
            $(element).valid();
        },
        highlight: function (element) {

            // $(element).closest('tr').addClass('table-danger');
            // $(element).closest('tr').children('td').addClass('text-danger');
        },
        errorElement: "div",
        errorClass: "badge badge-table",
        errorPlacement: function(error, element) {

            error.addClass('badge-danger');
            $(element).closest('tr').children('td:nth-child(2)').append(error);
        },
        success: function ( label, element ) {

            var success = '<i class="fa fa-check"></i>';
            $(element).closest('tr').children('td:nth-child(2)').find('.badge').removeClass('badge-danger').addClass('badge-success').html(success);
        },
        submitHandler: function(form) {

            var semester = $('input#semester_id');
            var user     = $('input#user_id');

            $(form).append(semester)
                   .append(user);

            form.submit();
        }
    });

});
