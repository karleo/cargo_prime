"use strict";

$(function () {
  cdp_load_countries();
  cdp_load_states();
  cdp_load_cities();
});

function cdp_load_countries() {

  $("#country").select2({
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
    var country = $("#country").val();
    $("#state").attr("disabled", true);
    $("#state").val(null);
    if (country != null) {
      $("#state").attr("disabled", false);
    }
    cdp_load_states();
  });
}

function cdp_load_states() {
  var country = $("#country").val();

  $("#state").select2({
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

    var state = $("#state").val();

    $("#city").attr("disabled", true);
    $("#city").val(null);

    if (state != null) {
      $("#city").attr("disabled", false);
    }

    cdp_load_cities();
  });
}

function cdp_load_cities() {
  var state = $("#state").val();

  $("#city").select2({
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



function cdp_showError(errors) {
  Swal.fire({
    title: "There was an error processing the request!",
    text: errors,
    icon: 'error',
    allowOutsideClick: false,
    confirmButtonText: 'Ok'
  })

}

function cdp_showSuccess(messages) {
  Swal.fire({
    title: messages,
    icon: 'success',
    allowOutsideClick: false,
    confirmButtonText: 'Ok'
  })
}


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
  input.classList.remove("is-invalid");
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
      input.classList.add("is-invalid");
      var errorCode = iti.getValidationError();
      errorMsg.innerHTML = errorMap[errorCode];
      errorMsg.classList.remove("hide");
    }
  }
});

// on keyup / change flag: reset
input.addEventListener('change', reset);
input.addEventListener('keyup', reset);

$("#new_register").on('submit', function (event) {
  if (iti.isValidNumber()) {

    var parametros = $(this).serialize();
    $.ajax({
      type: "POST",
      url: "./ajax/sign_up_ajax.php",
      data: parametros,
      dataType: 'json',
      beforeSend: function (objeto) {
        Swal.fire({
          title: 'Wait a moment please...',
          allowOutsideClick: false,
          didOpen: () => {
            Swal.showLoading()
          }
        })
      },
      success: function (data) {
        if (data.success) {
          cdp_showSuccess(data.messages)
        } else {
          cdp_showError(data.errors)
        }
      }
    });
  } else {
    input.classList.add("is-invalid");
    var errorCode = iti.getValidationError();
    errorMsg.innerHTML = errorMap[errorCode];
    errorMsg.classList.remove("hide");
    $('#phone_custom').focus();
  }
  event.preventDefault();

});