"use strict";

$(function () {


  $.ajax({
    url: './ajax/dashboard/shipments/load_graphics_shipments_ajax.php',
    type: "POST",
    dataType: "json",
    success: function (data) {

      console.log(data);

      var ctx = document.getElementById('myChart').getContext('2d');
      var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          datasets: [{
            label: 'Shipments',
            backgroundColor: '#7460ee',
            borderColor: '#7460ee',
            data: data

          }]
        },

        // Configuration options go here
        options: {

          title: {
            display: true,
            // text: 'Chart.js Bar Chart - Stacked'
          },

          tooltips: {
            mode: 'index',
            intersect: false
          },

          responsive: true,

        }
      })

    },
    error: function (data) {

    },
  });

  cdp_load(1);

});

 
//Cargar datos AJAX
function cdp_load(page) {

  var parametros = { "page": page };
  $("#loader").fadeIn('slow');
  $.ajax({
    url: './ajax/dashboard/shipments/load_shipments_ajax.php',
    data: parametros,
    beforeSend: function (objeto) {
    },
    success: function (data) {
      $(".outer_div").html(data).fadeIn('slow');
    }
  })
}


