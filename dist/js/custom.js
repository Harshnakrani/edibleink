$(document).ready(function () {


    $select = $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
    $(document).on("select2:open", () => {
        document.querySelector(".select2-container--open .select2-search__field").focus()
    })

    $select.on('change', function () {
        $(this).trigger('blur');
    });

    $("#dt_publisher").DataTable({

    });

    $("#sl_state").change(function () {

        $.ajax({
            url: base_url + "server.php?handle=get_city&id=" + this.value,
            method: 'GET',
            success: function (result) {
                result = JSON.parse(result);
                let options = [];
                for (i in result) {
                    options.push(new Option(result[i].name, result[i].id, false, false));
                }
                $("#sl_city").append(options).trigger("change");

            }
        });

    });

    $('#frm_add_publisher').validate({
        rules: {
            name: {
                required: true,
                minlength: 3
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
                minlength: 'Your name must be at least 3 characters long'
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

