$(document).ready(function () {


    //publisher add
    $('#frm_publisher').validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
            },
            street: {
                required: true
            },
            province: {
                required: true
            },
            city: {
                required: true
            },
            pin_code: {
                required: true,
                minlength: 6
            }
        },
        messages: {
            name: {
                required: 'Please enter your name',
                minlength: 'Your name must be at least 3 characters long',
            },
            street: {
                required: 'Please enter your street address'
            },
            province: {
                required: 'Please select province'
            },
            city: {
                required: 'Please select city'
            },
            pin_code: {
                required: 'Please enter a pin code',
                minlength: 'Please enter a valid pin code ex.ABCXYZ'
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
});