$(document).ready(function () {

    $.validator.addMethod(
        "regex",
        function(value, element, regexp) {
          var re = new RegExp(regexp);
          return this.optional(element) || re.test(value);
        },
        "Please check your input."
      );

    //publisher form
    $('#frm_publisher').validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
                regex:/^[a-zA-Z\s]+$/
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
                required: 'Please enter name',
                minlength: 'Your name must be at least 3 characters long',
                regex:"Please enter valid name"
            },
            street: {
                required: 'Please enter street address'
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


    //author form
    $('#frm_author').validate({
        rules: {
            firstName: {
                required: true,
                minlength: 2,
                regex:/^[a-zA-Z]+$/
            },
            lastName: {
                required: true,
                minlength: 2,
                regex:/^[a-zA-Z]+$/
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
            firstName: {
                required: 'Please enter first name',
                minlength: 'first Name must be at least 2 characters long',
                regex:"Please enter valid first name"
            },
            lastName: {
                required: 'Please enter your last name',
                minlength: 'Last Name must be at least 2 characters long',
                regex:"Please enter valid first name"
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