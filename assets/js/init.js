(function($){
  $(function(){

    $('.button-collapse').sideNav();

  }); // end of document ready
})(jQuery); // end of jQuery name space

(function(){
	 $('select').material_select();
	$('#table_id').DataTable({
		"lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]]
	});		
})();

$(document).ready(function(){
    $('.tooltipped').tooltip({delay: 5000});
    $(".dropdown-button").dropdown( { hover: true});
  });