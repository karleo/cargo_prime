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

var active_paypal = $('#active_paypal').val();
var active_stripe = $('#active_stripe').val();
var active_paystack = $('#active_paystack').val();
var order_total_order = $('#order_total_order').val();
var consolidate_id = $('#consolidate_id').val();
var track_order = $('#track_order').val();

var order_sender_id = $('#order_sender_id').val();

function redirect() {
  window.location = "consolidate_view.php?id=" + consolidate_id;
}


if (active_paypal == 1) {

  //    <!-- ================================================================ -->
  //                         <!-- PAYPAL METHOD PAYMENT -->
  //    <!-- ================================================================ -->

  // Render the PayPal button into #paypal-button-container
  paypal.Buttons({

    createOrder: function (data, actions) {
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: order_total_order
          }
        }]
      });
    },

    // Finalize the transaction
    onApprove: function (data, actions) {

      return actions.order.capture().then(function (details) {

        cdp_addPaymentPayPalSuccess(details);


      });
    }


  }).render('#paypal-button-container');


}




function cdp_addPaymentPayPalSuccess(details) {

  $.ajax({

    url: './ajax/consolidate/add_payment_paypal_method_ajax.php?order_id=' + consolidate_id + '&track_order=' + track_order + '&customer=' + order_sender_id,
    method: 'post',
    data: details,
    success: function (data) {

      $('html, body').animate({
        scrollTop: 0
      }, 600);

      $('#resultados_ajax').html(data);

    }
  })
}




//    <!-- ================================================================ -->
//                         <!-- END PAYPAL METHOD PAYMENT -->
//    <!-- ================================================================ -->





//    <!-- ================================================================ -->
//                         <!-- STRIPE METHOD PAYMENT -->
//    <!-- ================================================================ -->
if (active_stripe == 1) {

  var public_key_stripe = $('#public_key_stripe').val();
  // A reference to Stripe.js initialized with your real test publishable API key.
  var stripe = Stripe(public_key_stripe);

  var elements = stripe.elements();

  var style = {
    base: {
      color: "#32325d",
      fontFamily: 'Arial, sans-serif',
      fontSmoothing: "antialiased",
      fontSize: "16px",
      "::placeholder": {
        color: "#32325d"
      }
    },
    invalid: {
      fontFamily: 'Arial, sans-serif',
      color: "#fa755a",
      iconColor: "#fa755a"
    }
  };

  var card = elements.create("card", { style: style });
  // Stripe injects an iframe into the DOM
  card.mount("#card-element");

  // Disable the button until we have Stripe set up on the page
  document.querySelector("button").disabled = true;

  card.on("change", function (event) {
    // Disable the Pay button if there are no card details in the Element
    document.querySelector("button").disabled = event.empty;
    document.querySelector("#card-error-custom").textContent = event.error ? event.error.message : "";
  });





  var form = document.getElementById("payment-form");

  form.addEventListener("submit", function (event) {
    event.preventDefault();
    // Complete payment when the submit button is clicked

    // Disable the button until we have Stripe set up on the page
    document.querySelector("button").disabled = true;

    fetch("./ajax/consolidate/add_payment_stripe_method_ajax.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({
        email_property_card_stripe: document.getElementById('email_property_card_stripe').value,
        name_property_card_stripe: document.getElementById('name_property_card_stripe').value,
        order_id: document.getElementById('order_id').value,
        track_order: document.getElementById('track_order').value,
      })
    })
      .then(function (result) {
        return result.json();
      })
      .then(function (data) {
        payWithCard(stripe, card, data.clientSecret);
      });
  });

  // Calls stripe.confirmCardPayment
  // If the card requires authentication Stripe shows a pop-up modal to
  // prompt the user to enter authentication details without leaving your page.
  var payWithCard = function (stripe, card, clientSecret) {
    loading(true);
    stripe
      .confirmCardPayment(clientSecret, {
        payment_method: {
          card: card
        }
      })
      .then(function (result) {
        if (result.error) {
          // Show error to your customer
          showError(result.error.message);
        } else {
          // The payment succeeded!
          loading(false);
          document.querySelector("button").disabled = true;

          console.log(result.paymentIntent)

          if (result.paymentIntent.status === 'succeeded') {

            cdp_addPaymentStripeSuccess(result.paymentIntent);
          }


        }
      });
  };


  // Show the customer the error from Stripe if their card fails to charge
  var showError = function (errorMsgText) {
    loading(false);
    var errorMsg = document.querySelector("#card-error-custom");
    errorMsg.textContent = errorMsgText;
    setTimeout(function () {
      errorMsg.textContent = "";
    }, 4000);
  };

  // Show a spinner on payment submission
  var loading = function (isLoading) {
    if (isLoading) {
      // Disable the button and show a spinner
      document.querySelector("button").disabled = true;
      document.querySelector("#spinner").classList.remove("hidden");
      document.querySelector("#button-text").classList.add("hidden");
    } else {
      document.querySelector("button").disabled = false;
      document.querySelector("#spinner").classList.add("hidden");
      document.querySelector("#button-text").classList.remove("hidden");
    }
  };


  function cdp_addPaymentStripeSuccess(details) {

    $.ajax({

      url: './ajax/consolidate/add_payment_stripe_method_success_ajax.php?order_id=' + consolidate_id + '&track_order=' + track_order + '&customer=' + order_sender_id,
      method: 'post',
      data: details,
      success: function (data) {

        $('html, body').animate({
          scrollTop: 0
        }, 600);

        $('#resultados_ajax').html(data);

      }
    })
  }

}



$("#add_charges").on('submit', function (event) {
  $('#save_form2').attr("disabled", true);

  if (cdp_validateZiseFiles() == true) {

    return false;
  }

  var inputFileImage = document.getElementById("filesMultiple");
  var notes = $('#notes').val();
  var mode_pay = $('#mode_pay').val();

  var file = inputFileImage.files[0];
  var data = new FormData();

  data.append('file_invoice', file);
  data.append('notes', notes);
  data.append('mode_pay', mode_pay);
  $.ajax({
    type: "POST",
    url: "./ajax/consolidate/consolidate_add_payment_doc_ajax.php?order_id=" + consolidate_id,
    data: data,
    contentType: false,       // The content type used when sending data to the server.
    cache: false,             // To unable request pages to be cached
    processData: false,
    beforeSend: function (objeto) {
      $("#resultados_ajax").html("<img src='assets/images/loader.gif'/><br/>Wait a moment please...");
    },
    success: function (datos) {
      $("#resultados_ajax").html(datos);
      $('#save_form2').attr("disabled", false);

      $('html, body').animate({
        scrollTop: 0
      }, 600);


    }
  });
  event.preventDefault();

})


function cdp_validateZiseFiles() {

  var inputFile = document.getElementById('filesMultiple');
  var file = inputFile.files;

  var size = 0;
  console.log(file);

  for (var i = 0; i < file.length; i++) {

    var filesSize = file[i].size;

    if (size > 5242880) {

      $('.resultados_file').html("<div class='alert alert-danger'>" +
        "<button type='button' class='close' data-dismiss='alert'>&times;</button>" +
        "<strong>Error! Sorry, but the file size is too large. Select files smaller than 5MB. </strong>" +

        "</div>"
      );
    } else {
      $('.resultados_file').html("");
    }

    size += filesSize;
  }

  if (size > 5242880) {
    $('.resultados_file').html("<div class='alert alert-danger'>" +
      "<button type='button' class='close' data-dismiss='alert'>&times;</button>" +
      "<strong>Error! Sorry, but the file size is too large. Select files smaller than 5MB. </strong>" +

      "</div>"
    );

    return true;

  } else {
    $('.resultados_file').html("");

    return false;
  }

}




$('#openMultiFile').click(function () {

  $("#filesMultiple").click();
});


$('#clean_file_button').click(function () {

  $("#filesMultiple").val('');

  $('#selectItem').html('Attach files');

  $('#clean_files').addClass('hide');


});



$('input[type=file]').change(function () {

  var inputFile = document.getElementById('filesMultiple');
  var file = inputFile.files;
  var contador = 0;
  for (var i = 0; i < file.length; i++) {

    contador++;
  }
  if (contador > 0) {

    $('#clean_files').removeClass('hide');
  } else {

    $('#clean_files').addClass('hide');

  }

  $('#selectItem').html('attached files (' + contador + ')');
});




if (active_paystack == 1) {


  //    <!-- ================================================================ -->
  //                         <!-- PAYSTACK METHOD PAYMENT -->
  //    <!-- ================================================================ -->



  const paymentForm = document.getElementById('paymentForm');
  var public_key_paystack = $('#public_key_paystack').val();
  var order_total_order = $('#order_total_order').val();
  order_total_order = parseInt(order_total_order);
  order_total_order = order_total_order * 100;

  paymentForm.addEventListener("submit", function (event) {

    event.preventDefault();

    let handler = PaystackPop.setup({
      key: public_key_paystack, // Replace with your public key
      email: document.getElementById("email-address").value,
      amount: order_total_order,
      firstname: document.getElementById("first-name").value,
      lastname: document.getElementById("last-name").value,

      onClose: function () {
      },
      callback: function (response) {
        cdp_addPaymentPaystackSuccess(response);
      }
    });
    handler.openIframe();

  });


  function cdp_addPaymentPaystackSuccess(details) {

    var firstname = document.getElementById("first-name").value;
    var lastname = document.getElementById("last-name").value;

    $.ajax({

      url: './ajax/consolidate/add_payment_paystack_method_success_ajax.php?order_id=' + consolidate_id + '&track_order=' + track_order + '&customer=' + order_sender_id + '&firstname=' + firstname + '&lastname=' + lastname,
      method: 'post',
      data: details,
      success: function (data) {

        $('html, body').animate({
          scrollTop: 0
        }, 600);

        $('#resultados_ajax').html(data);

      }
    })
  }


}



function cdp_soloNumeros(e) {
  var key = e.charCode;
  return key >= 44 && key <= 57;
}

