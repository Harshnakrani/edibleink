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
                $('#sl_city').empty().trigger("change");

                $("#sl_city").append(new Option("Please Select Option", "", false, false));
                $("#sl_city").append(options).trigger("change");

            }
        });

    });



});

