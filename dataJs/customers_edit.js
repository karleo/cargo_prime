
"use strict";

var errorMsg = document.querySelector("#error-msg");
var validMsg = document.querySelector("#valid-msg");

// here, the index maps to the error code returned from getValidationError - see readme
var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];


var input = document.querySelector("#phone_custom");
var iti = window.intlTelInput(input, {

    geoIpLookup: function (callback) {
        $.get("http://ipinfo.io", function () { }, "jsonp").always(function (resp) {
            var countryCode = (resp && resp.country) ? resp.country : "";
            callback(countryCode);
        });
    },
    initialCountry: "auto",
    nationalMode: true,
    separateDialCode: true,
    utilsScript: "assets/js/input-js/utils.js",
});




var reset = function () {
    input.classList.remove("error");
    errorMsg.innerHTML = "";
    errorMsg.classList.add("hide");
    validMsg.classList.add("hide");
};

// on blur: validate
input.addEventListener('blur', function () {
    reset();
    if (input.value.trim()) {

        if (iti.isValidNumber()) {

            $('#phone').val(iti.getNumber());

            validMsg.classList.remove("hide");

        } else {

            input.classList.add("error");
            var errorCode = iti.getValidationError();
            errorMsg.innerHTML = errorMap[errorCode];
            errorMsg.classList.remove("hide");

        }
    }
});

// on keyup / change flag: reset
input.addEventListener('change', reset);
input.addEventListener('keyup', reset);

$(function () {
    var count = $('#count_address').val();
    for (var no = 1; no <= count; no++) {
        cdp_load_countries(no);
        cdp_load_states(no);
        cdp_load_cities(no);
    }
});

function cdp_load_countries(count) {

    $("#country" + count).select2({
        ajax: {
            url: "ajax/select2_countries.php",
            dataType: 'json',

            delay: 250,
            data: function (params) {
                return {
                    q: params.term // search term
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        },
        placeholder: "Search country",
        allowClear: true
    }).on('change', function (e) {

        var country = $("#country" + count).val();

        $("#state" + count).attr("disabled", true);
        $("#state" + count).val(null);

        if (country != null) {
            $("#state" + count).attr("disabled", false);
        }

        cdp_load_states(count);
    });
}

function cdp_load_states(count) {
    var country = $("#country" + count).val();

    $("#state" + count).select2({
        ajax: {
            url: "ajax/select2_states.php?id=" + country,
            dataType: 'json',

            delay: 250,
            data: function (params) {
                return {
                    q: params.term // search term
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        },
        placeholder: "Search state",
        allowClear: true
    }).on('change', function (e) {

        var state = $("#state" + count).val();

        $("#city" + count).attr("disabled", true);
        $("#city" + count).val(null);

        if (state != null) {
            $("#city" + count).attr("disabled", false);
        }

        cdp_load_cities(count);
    });
}

function cdp_load_cities(count) {
    var state = $("#state" + count).val();

    $("#city" + count).select2({
        ajax: {
            url: "ajax/select2_cities.php?id=" + state,
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term // search term
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        },
        placeholder: "Search city",
        allowClear: true
    });
}

$(function () {

    var count = $('#count_address').val();

    $(document).on('click', '#add_row', function () {

        count++;
        var total = $('#total_address').val(count);
        var html_code = '';
        var parent = $('#div_parent_' + count);
        html_code += '<div id="div_parent_' + count + '">';
        html_code += '<hr>';
        html_code += '<h4>Address ' + count + '</h4>';
        html_code += '<div class="row">';
        html_code += '<div class="col-md-4 mb-3">' +
            '<div class="form-group" >' +
            '<label class="control-label col-form-label">Country</label>' +
            '<select  class="select2 form-control custom-select" name="country[]" id="country' + count + '">' +
            '</select>' +
            '</div >' +
            '</div > ';

        html_code += '<div class="col-md-4 mb-3">' +
            '<div class="form-group" >' +
            '<label class="control-label col-form-label">State</label>' +
            '<select  disabled class="select2 form-control custom-select" name="state[]" id="state' + count + '">' +
            '</select>' +
            '</div >' +
            '</div > ';


        html_code += '<div class="col-md-4 mb-3">' +
            '<div class="form-group" >' +
            '<label class="control-label col-form-label">City</label>' +
            '<select  disabled class="select2 form-control custom-select" name="city[]" id="city' + count + '">' +
            '</select>' +
            '</div >' +
            '</div > ';


        html_code += '<div class="col-md-4">' +
            '<div class="form-group">' +
            '<label for="phoneNumber1">Zip code</label>' +
            '<input type="text" class="form-control" name="postal[]" id="postal' + count + '" placeholder="Zip code">' +
            '</div>' +
            '</div>';

        html_code += '<div class="col-md-4">' +
            '<div class="form-group">' +
            '<label for="phoneNumber1">Address</label>' +
            '<input type="text" class="form-control" name="address[]" id="address' + count + '" placeholder="Address">' +
            '</div>' +
            '</div>';

        html_code += '<input type="hidden"  name="address_id[]" id="address_id' + count + '">';


        html_code += '<div align="center" class="col-md-4">';
        html_code += '   <label> &nbsp;</label>';
        html_code += '  <div class="form-group">';
        html_code += '      <button type="button" name="remove_row" id="' + count + '"  class="btn btn-danger remove_row">' +
            '<span class="fa fa-trash"></span> Delete address' +
            '</button >' +
            '</div >' +
            '</div >';


        html_code += '</div>'; //div parent

        $('#div_address_multiple').append(html_code);

        cdp_load_countries(count);
        cdp_load_states(count);
        cdp_load_cities(count);
    });


    $(document).on('click', '.remove_row', function () {

        var row_id = $(this).attr("id");
        var parent = $('#div_parent_' + row_id);

        var address_id = $('#address_id' + row_id).val();
        if (address_id) {

            new Messi('<p class="messi-warning"><i class="icon-warning-sign icon-3x pull-left"></i>Are you sure you want to delete this record?<br /><strong>This action cannot be undone!!!</strong></p>', {
                title: 'Delete address',
                titleClass: '',
                modal: true,
                closeButton: true,
                buttons: [{
                    id: 0,
                    label: 'Delete',
                    class: '',
                    val: 'Y'
                }],
                callback: function (val) {
                    if (val === 'Y') {
                        $.ajax({
                            type: 'post',
                            url: './ajax/customers/customers_delete_address_ajax.php',
                            dataType: 'json',
                            data: {
                                'id': address_id,
                            },
                            beforeSend: function () {
                                parent.animate({
                                    'backgroundColor': '#FFBFBF'
                                }, 400);

                                $('#resultados_ajax').html('')
                            },
                            success: function (data) {
                                $('html, body').animate({
                                    scrollTop: 0
                                }, 600);

                                if (data.success) {
                                    cdp_showSuccess(data.messages)

                                    count--;
                                    parent.fadeOut(400, function () {
                                        $('#div_parent_' + row_id).remove();
                                    });

                                    $('#total_address').val(count);

                                } else {
                                    cdp_showError(data.errors)
                                }
                            }
                        });
                    }
                }
            });
        } else {
            count--;
            parent.fadeOut(400, function () {
                $('#div_parent_' + row_id).remove();
            });
            $('#total_address').val(count);
        }

    });


});



$("#edit_user").on('submit', function (event) {

    var count = $('#total_address').val();

    for (var no = 1; no <= count; no++) {

        if ($.trim($('#address' + no).val()).length == 0) {
            alert("Please enter address");
            $('#address' + no).focus();

            return false;
        }


        if ($.trim($('#country' + no).val()).length == 0) {
            alert("Please enter country");
            $('#country' + no).focus();

            return false;
        }

        if ($.trim($('#state' + no).val()).length == 0) {
            alert("Please enter state");
            $('#state' + no).focus();

            return false;
        }

        if ($.trim($('#city' + no).val()).length == 0) {
            alert("Please enter city");
            $('#city' + no).focus();

            return false;
        }

        if ($.trim($('#postal' + no).val()).length == 0) {
            alert("Please enter zip code");
            $('#postal' + no).focus();

            return false;
        }

    }

    if (iti.isValidNumber()) {

        $('#save_data').attr("disabled", true);
        var parametros = $(this).serialize();

        var inputFileImage = document.getElementById("avatar");
        var username = $('#username').val();
        var email = $('#email').val();
        var document_type = $('#document_type').val();
        var document_number = $('#document_number').val();
        var fname = $('#fname').val();
        var lname = $('#lname').val();
        var notes = $('#notes').val();
        var phone = $('#phone').val();
        var gender = $('#gender').val();
        var locker = $('#locker').val();
        var password = $('#password').val();
        var notify = $('#notify:checked').val();
        var active = $('input:radio[name=active]:checked').val();
        var newsletter = $('input:radio[name=newsletter]:checked').val();
        var total_address = $('#total_address').val();

        var address = document.getElementsByName('address[]');
        var country = document.getElementsByName('country[]');
        var state = document.getElementsByName('state[]');
        var city = document.getElementsByName('city[]');
        var postal = document.getElementsByName('postal[]');
        var address_id = document.getElementsByName('address_id[]');
        var id = $('#id').val();

        var file = inputFileImage.files[0];
        var data = new FormData();

        data.append('avatar', file);
        data.append('locker', locker);
        data.append('username', username);
        data.append('password', password);
        data.append('document_number', document_number);
        data.append('document_type', document_type);
        data.append('fname', fname);
        data.append('lname', lname);
        data.append('email', email);
        data.append('phone', phone);
        data.append('gender', gender);
        data.append('active', active);
        data.append('newsletter', newsletter);
        data.append('notes', notes);
        data.append('notify', notify);
        data.append('total_address', total_address);
        data.append('id', id);

        for (var a of address) { data.append('address[]', a.value); }
        for (var c of country) { data.append('country[]', c.value); }
        for (var c of state) { data.append('state[]', c.value); }
        for (var ci of city) { data.append('city[]', ci.value); }
        for (var p of postal) { data.append('postal[]', p.value); }
        for (var ai of address_id) { data.append('address_id[]', ai.value); }

        $.ajax({

            type: "POST",
            url: "ajax/customers/customers_edit_ajax.php",
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function (objeto) {
                $("#resultados_ajax").html("Send...");
            },
            success: function (datos) {
                $("#resultados_ajax").html(datos);
                $('#save_data').attr("disabled", false);

                $('html, body').animate({
                    scrollTop: 0
                }, 600);
                setTimeout(function () { location.reload(); }, 4000);

            }
        });

    } else {

        input.classList.add("error");
        var errorCode = iti.getValidationError();
        errorMsg.innerHTML = errorMap[errorCode];
        errorMsg.classList.remove("hide");

    }
    event.preventDefault();

})


function cdp_showError(errors) {

    var html_code = '';

    html_code += '<div class="alert alert-danger" id="success-alert">' +
        '<p><span class="icon-minus-sign"></span><i class="close icon-remove-circle"></i>' +
        '<span>Error! </span> There was an error processing the request ' +
        '<ul class="error" > ';

    for (var error in errors) {
        html_code += '<li>';
        html_code += '<i class="icon-double-angle-right"></i>';
        html_code += errors[error];
        html_code += '</li>';
    }
    '    </ul > ' +
        ' </p > ' +
        ' </div > ';

    $('#resultados_ajax').append(html_code);

}

function cdp_showSuccess(messages) {

    var html_code = '';

    html_code += '<div class="alert alert-info" id="success-alert">' +
        '<p><span class="icon-info-sign"></span><i class="close icon-remove-circle"></i>';

    for (var message in messages) {
        html_code += messages[message];
    }
    ' </p > ' +
        '</div > ';

    $('#resultados_ajax').append(html_code);

}