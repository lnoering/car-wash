$(function() {
	$('input[name=vow_vehicle]').attr('autocomplete','on');
    $( "input[name=vow_vehicle]" ).catcomplete({
      	source: function(request, response) {
      		var v = $( "input[name=vow_vehicle]" ).val();
      		$.ajax({
  			  	type: "POST",
  			  	url: '/admin/vehicle/ajax_search',
  			  	data: {search: request.term},
  			  	dataType: "json",
  			  	success: function(data) {
  	            	response( $.map( data, function( item ) {
  	              		return {
  	              			value: item.ide,
  		                	label: item.valor,
                      	category: item.category,
                      	ref: null
  	              		}
  	            	}));
            	}
		    });
      	},
      	minLength: 1,
    });
});
