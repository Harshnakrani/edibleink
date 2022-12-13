$(document).ready(function () {

    $.validator.addMethod(
        "regex",
        function (value, element, regexp) {
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
                regex: /^[a-zA-Z\s]+$/
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
                minlength: 6,
                regex: /^[a-zA-Z0-9]+$/
            }
        },
        messages: {
            name: {
                required: 'Please enter name',
                minlength: 'Your name must be at least 3 characters long',
                regex: "Please enter valid name"
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
                minlength: 'Please enter a valid pin code ex.ABCXYZ',
                regex: "invalid pincode"
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
                regex: /^[a-zA-Z]+$/
            },
            lastName: {
                required: true,
                minlength: 2,
                regex: /^[a-zA-Z]+$/
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
                minlength: 6,
                regex: /^[a-zA-Z0-9]+$/
            }
        },
        messages: {
            firstName: {
                required: 'Please enter first name',
                minlength: 'first Name must be at least 2 characters long',
                regex: "Please enter valid first name"
            },
            lastName: {
                required: 'Please enter last name',
                minlength: 'Last Name must be at least 2 characters long',
                regex: "Please enter valid first name"
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
                minlength: 'Please enter a valid pin code ex.ABCXYZ',
                regex: "invalid pincode"
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


    //customer form
    $('#frm_customer').validate({
        rules: {
            firstName: {
                required: true,
                minlength: 2,
                regex: /^[a-zA-Z]+$/
            },
            lastName: {
                required: true,
                minlength: 2,
                regex: /^[a-zA-Z]+$/
            },
            email: {
                required: true,
                email: true
            },
            mobile:
            {
                required: true,
                phoneUS: true,
                minlength: 10
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
                minlength: 6,
                regex: /^[a-zA-Z0-9]+$/
            }
        },
        messages: {
            firstName: {
                required: 'Please enter first name',
                minlength: 'first Name must be at least 2 characters long',
                regex: "Please enter valid first name"
            },
            lastName: {
                required: 'Please enter  last name',
                minlength: 'Last Name must be at least 2 characters long',
                regex: "Please enter valid first name"
            },
            email: {
                required: "Please enter email address",
                email: "Please enter valid email address",
            },
            mobile:
            {
                required: "Please enter mobile number",
                phoneUS: "Please enter valid mobile number ex.9876543210",
                minlength: "Please enter valid mobile number"
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
                minlength: 'Please enter a valid pin code ex.ABCXYZ',
                regex: "invalid pincode"
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


    $('#frm_product').validate({
        rules: {
            title: {
                required: true,
                minlength: 2,
            },
            yaerpublished: {
                required: true,
                regex: /^\d{4}$/,
                minlength: 4,
                number: true,
            },
            isbn: {
                required: true,
                regex: /^\d{10,13}$/,
                minlength: 10,
                number: true,
            },
            price: {
                required: true,
                regex: /^(\d+(\.\d{1,2})?)$/,
            },
            stock: {
                required: true,
                number:true,
                regex:/^[\d]+$/,
            },
            publisher: {
                required: true,
            },
            type: {
                required: true,
            },
            "author[]":{
                required: true,
            }
        },
        messages: {
            title: {
                required: 'Please enter product title',
                minlength: 'Title must be at least 2 characters long',
            },
            yaerpublished: {
                required: "Please enter yaer published",
                regex: 'Please enter valid year',
                minlength: "Please enter valid year"
            },
            isbn: {
                required: "Please enter ISBN",
                regex: "ISBN should be 10 character long and only numbers allowed",
                minlength: "please enter valid isbn"
            },
            price: {
                required: "Please enter a price",
                regex: "Please enter a valid number",
            },
            type: {
                required: "Please select product type",
            },
            stock: {
                required: "Please enter product stock",
                number:"Please enter valid stock amount",
                regex:"Please enter valid stock amount",
            },
            publisher: {
                required: "Please select publisher of the product",
            },
            "author[]":{
                required: "Please select author of the product",
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