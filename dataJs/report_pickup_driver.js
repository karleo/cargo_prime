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

$(function () {

  var start = moment().startOf('month');
  var end = moment().endOf('month');

  $('#daterange').daterangepicker({
    startDate: start,
    endDate: end,
    locale: {
      'format': 'Y/M/D',

    },

    ranges: {
      'Today': [moment(), moment()],
      'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Last 7 Days': [moment().subtract(6, 'days'), moment()],
      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      'This Month': [moment().startOf('month'), moment().endOf('month')],
      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],

    }
  }).on('change', function (e) {
    cdp_load(1);
  });

  cdp_load(1);

});





//Cargar datos AJAX
function cdp_load(page) {
  var status_courier = $("#status_courier").val();
  var employee_id = $("#employee_id").val();
  var daterange = $("#daterange").val();
  var parametros = { "page": page, 'status_courier': status_courier, 'employee_id': employee_id, 'range': daterange };
  $("#loader").fadeIn('slow');
  $.ajax({
    url: './ajax/reports/report_pickup_driver_ajax.php',
    data: parametros,
    beforeSend: function (objeto) {
    },
    success: function (data) {
      $(".outer_div").html(data).fadeIn('slow');
    }
  })
}



function cdp_exportExcel() {

  var status_courier = $("#status_courier").val();
  var employee_id = $("#employee_id").val();
  var daterange = $("#daterange").val();

  window.open('report_pickup_driver_excel.php?range=' + daterange + '&status_courier=' + status_courier + '&employee_id=' + employee_id);

}


function cdp_exportPrint() {

  var status_courier = $("#status_courier").val();
  var employee_id = $("#employee_id").val();
  var daterange = $("#daterange").val();

  window.open('report_pickup_driver_print.php?range=' + daterange + '&status_courier=' + status_courier + '&employee_id=' + employee_id);

}