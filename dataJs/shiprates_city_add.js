"use strict";

$(function () {
    $("#main-wrapper").AdminSettings({
        Theme: false, // this can be true or false ( true means dark and false means light ),
        Layout: 'vertical',
        LogoBg: 'skin6', // You can change the Value to be skin1/skin2/skin3/skin4/skin5/skin6 
        NavbarBg: 'skin1', // You can change the Value to be skin1/skin2/skin3/skin4/skin5/skin6
        SidebarType: 'mini-sidebar', // You can change it full / mini-sidebar / iconbar / overlay
        SidebarColor: 'skin6', // You can change the Value to be skin1/skin2/skin3/skin4/skin5/skin6
        SidebarPosition: true, // it can be true / false ( true means Fixed and false means absolute )
        HeaderPosition: true, // it can be true / false ( true means Fixed and false means absolute )
        BoxedLayout: false, // it can be true / false ( true means Boxed and false means Fluid ) 
    });
});

function cdp_loadPackagesItem(count) {

    $("#order_item_package" + count).html('<option value="">Seleccione</option>');
    $.ajax({
        type: "POST",
        url: 'ajax/select_packages_item.php',
        dataType: "json",
        success: function (data) {

            $.each(data, function (key, item) {
                $("#order_item_package" + count).append('<option value=' + item.id + '>' + item.name_pack + '</option>');
            });
        }
    });
}




$(function () {
    var count = 1;

    $(document).on('click', '#add_row', function () {
        count++;
        $('#total_item').val(count);


        var parent = $('#row_id_' + count);
        var html_code = '';
        cdp_loadPackagesItem(count);

        html_code += '<div  class= "card-hover" id="row_id_' + count + '">';

        html_code += '<hr>';

        html_code += '<div class="row"> ';

        html_code += '<div class="col-md-2">' +
            '<div class="form-group">' +
            '<label for="emailAddress1">Packaging Type</label>' +
            '<div class="input-group">' +
            '<select class="custom-select col-12 order_item_package1" id="order_item_package' + count + '" name="order_item_package[]" required>' +
            
            '</select>' +
            '</div>' +
            '</div>' +
            '</div>';




        html_code += '<div class="col-md-0">' +

            '<div class="form-group">' +
            '<label for="emailAddress1">Weights 0</label>' +
            '<div class="input-group">' +
            '<input type="text" name="order_0weight[]" id="order_0weight1' + count + '" class="form-control input-sm order_0weight is-valid short" data-toggle="tooltip" data-placement="bottom"  title="weight 0" value="0" required>' +
            '</div>' +
            '</div>' +
            '</div>';


        html_code += '<div class="col-md-0">' +

            '<div class="form-group">' +
            '<label for="emailAddress1">1</label>' +
            '<div class="input-group">' +
            '<input type="text" name="order_1weight[]" id="order_1weight1' + count + '" class="form-control input-sm order_1weight is-valid short" data-toggle="tooltip" data-placement="bottom"  title="weight 1" value="0" required>' +
            '</div>' +
            '</div>' +
            '</div>';


        html_code += '<div class="col-md-0">' +

            '<div class="form-group">' +
            '<label for="emailAddress1">2</label>' +
            '<div class="input-group">' +
            '<input type="text" name="order_2weight[]" id="order_2weight1' + count + '" class="form-control input-sm order_2weight is-valid short" data-toggle="tooltip" data-placement="bottom"  title="weight 2" value="0" required>' +
            '</div>' +
            '</div>' +
            '</div>';

         html_code += '<div class="col-md-0">' +
            '<div class="form-group">' +
            '<label for="emailAddress1">3</label>' +
            '<div class="input-group">' +
            '<input type="text" name="order_3weight[]" id="order_3weight1' + count + '" class="form-control input-sm order_3weight is-valid short" data-toggle="tooltip" data-placement="bottom"  title="weight 3" value="0" required>' +
            '</div>' +
            '</div>' +
            '</div>';

         html_code += '<div class="col-md-0">' +

            '<div class="form-group">' +
            '<label for="emailAddress1">4</label>' +
            '<div class="input-group">' +
            '<input type="text" name="order_4weight[]" id="order_4weight1' + count + '" class="form-control input-sm order_4weight is-valid short" data-toggle="tooltip" data-placement="bottom"  title="weight 4" value="0" required>' +
            '</div>' +
            '</div>' +
            '</div>';

         html_code += '<div class="col-md-0">' +

            '<div class="form-group">' +
            '<label for="emailAddress1">5</label>' +
            '<div class="input-group">' +
            '<input type="text" name="order_5weight[]" id="order_5weight1' + count + '" class="form-control input-sm order_5weight is-valid short" data-toggle="tooltip" data-placement="bottom"  title="weight 5" value="0" required>' +
            '</div>' +
            '</div>' +
            '</div>';

         html_code += '<div class="col-md-0">' +

            '<div class="form-group">' +
            '<label for="emailAddress1">6</label>' +
            '<div class="input-group">' +
            '<input type="text" name="order_6weight[]" id="order_6weight1' + count + '" class="form-control input-sm order_6weight is-valid short" data-toggle="tooltip" data-placement="bottom"  title="weight 6" value="0" required>' +
            '</div>' +
            '</div>' +
            '</div>';

         html_code += '<div class="col-md-0">' +

            '<div class="form-group">' +
            '<label for="emailAddress1">7</label>' +
            '<div class="input-group">' +
            '<input type="text" name="order_7weight[]" id="order_7weight1' + count + '" class="form-control input-sm order_7weight is-valid short" data-toggle="tooltip" data-placement="bottom"  title="weight 7" value="0" required>' +
            '</div>' +
            '</div>' +
            '</div>';

         html_code += '<div class="col-md-0">' +

            '<div class="form-group">' +
            '<label for="emailAddress1">8</label>' +
            '<div class="input-group">' +
            '<input type="text" name="order_8weight[]" id="order_8weight1' + count + '" class="form-control input-sm order_8weight is-valid short" data-toggle="tooltip" data-placement="bottom"  title="weight 8" value="0" required>' +
            '</div>' +
            '</div>' +
            '</div>';

         html_code += '<div class="col-md-0">' +

            '<div class="form-group">' +
            '<label for="emailAddress1">9</label>' +
            '<div class="input-group">' +
            '<input type="text" name="order_9weight[]" id="order_9weight1' + count + '" class="form-control input-sm order_9weight is-valid short" data-toggle="tooltip" data-placement="bottom"  title="weight 9" value="0" required>' +
            '</div>' +
            '</div>' +
            '</div>';

         html_code += '<div class="col-md-0">' +

            '<div class="form-group">' +
            '<label for="emailAddress1">10</label>' +
            '<div class="input-group">' +
            '<input type="text" name="order_10weight[]" id="order_10weight1' + count + '" class="form-control input-sm order_10weight is-valid short" data-toggle="tooltip" data-placement="bottom"  title="weight 10" value="0" required>' +
            '</div>' +
            '</div>' +
            '</div>';



            html_code += '<div class="col-md-0">' +

            '<div class="form-group">' +
            '<label for="emailAddress1">Weight price</label>' +
            '<div class="input-group">' +
            '<input type="text" name="order_weight_price[]" id="order_weight_price1' + count + '" class="form-control input-sm order_weight_price is-invalid short_price" data-toggle="tooltip" data-placement="bottom"  title="Weight price" value="0" required>' +
            '</div>' +
            '</div>' +
            '</div>';



        html_code += '<div class="col-md-1">' +
            '<div class="form-group  mt-4" align="right">' +
            '<button type="button" name="remove_row" id="' + count + '" class="btn btn-danger mt-2 remove_row"><i class="fa fa-trash"></i> </button>' +
            '</div>' +
            '</div>';

        html_code += '</div>';

        html_code += '<hr>';

        html_code += '</div>';




        $('#data_items').append(html_code);

        $('#row_id_' + count).animate({
            'backgroundColor': '#18BC9C'
        }, 400);


        $('#add_row').attr("disabled", true);


        setTimeout(function () {

            $('#row_id_' + count).css({ 'background-color': '' });
            $('#add_row').attr("disabled", false);

        }, 900);

    });






    $(document).on('click', '.remove_row', function () {

        var row_id = $(this).attr("id");
        var parent = $('#row_id_' + row_id);


        parent.animate({
            'backgroundColor': '#FFBFBF'
        }, 400);

        count--;
        parent.fadeOut(400, function () {
            // parent.remove();
            $('#row_id_' + row_id).remove();
            cdp_cal_final_total();
        });
        $('#total_item').val(count);

    });




    $('#create_shiprates').on('click', function () {

        if (cdp_validateZiseFiles() == true) {

            return false;
        }


        // data ship rates

        if ($.trim($('#order_service_options').val()) == 0) {
            alert("Please Select Service Options");
            return false;
        }

        if ($.trim($('#shipareas').val()) == 0) {
            alert("Please Select Shipping Area");
            return false;
        }

        if ($.trim($('#order_package').val()) == 0) {
            alert("Please Select package name");
            return false;
        }

        if ($.trim($('#order_deli_time').val()) == 0) {
            alert("Please Select delivery time");
            return false;
        }




        for (var no = 1; no <= count; no++) {
            if ($.trim($('#order_item_package' + no).val()).length == 0) {
                alert("Please Enter iem package");
                $('#order_item_package' + no).focus();
                return false;
            }


            if ($.trim($('#order_0weight' + no).val()).length == 0) {
                alert("Please Enter Weight 0");
                $('#order_0weight' + no).focus();
                return false;
            }

            if ($.trim($('#order_1weight' + no).val()).length == 0) {
                alert("Please Enter Weight 1");
                $('#order_1weight' + no).focus();
                return false;
            }


            if ($.trim($('#order_2weight' + no).val()).length == 0) {
                alert("Please Enter Weight 2");
                $('#order_2weight' + no).focus();
                return false;
            }

            if ($.trim($('#order_3weight' + no).val()).length == 0) {
                alert("Please Enter Weight 3");
                $('#order_3weight' + no).focus();
                return false;
            }

            if ($.trim($('#order_4weight' + no).val()).length == 0) {
                alert("Please Enter Weight 4");
                $('#order_4weight' + no).focus();
                return false;
            }

            if ($.trim($('#order_5weight' + no).val()).length == 0) {
                alert("Please enter weight 5");
                $('#order_5weight' + no).focus();
                return false;
            }

            if ($.trim($('#order_6weight' + no).val()).length == 0) {
                alert("Please enter weight 6");
                $('#order_6weight' + no).focus();
                return false;
            }

            if ($.trim($('#order_7weight' + no).val()).length == 0) {
                alert("Please enter weight 7");
                $('#order_7weight' + no).focus();
                return false;
            }

            if ($.trim($('#order_8weight' + no).val()).length == 0) {
                alert("Please enter weight 8");
                $('#order_8weight' + no).focus();
                return false;
            }

            if ($.trim($('#order_9weight' + no).val()).length == 0) {
                alert("Please enter weight 9");
                $('#order_9weight' + no).focus();
                return false;
            }

            if ($.trim($('#order_10weight' + no).val()).length == 0) {
                alert("Please enter weight 10");
                $('#order_10weight' + no).focus();
                return false;
            }

            if ($.trim($('#order_weight_price' + no).val()).length == 0) {
                alert("Please enter weight price");
                $('#order_weight_price' + no).focus();
                return false;
            }


        }

        $('#shiprates_form').submit();

    });



});




function cdp_soloNumeros(e) {

    var key = e.charCode;
    console.log(key)

    return key > 44 && key <= 57;
}



var input = document.getElementById("order_no");

input.addEventListener("keypress", function (event) {
    if (event.charCode < 48 || event.charCode > 57) {
        event.preventDefault();
    }
});





function cdp_convertStrPad(value, dbDigits) {
    var pad = value.padStart(dbDigits, "0");

    $('#order_no').val(pad);

}