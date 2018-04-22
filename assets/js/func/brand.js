$(function() {
	$('input[name=bra_name]').attr('autocomplete','on');
    $( "input[name=bra_name]" ).catcomplete({
      	source: function(request, response) {
      		var v = $( "input[name=bra_name]" ).val();
      		$.ajax({
  			  	type: "POST",
  			  	url: '/admin/brand/ajax_search',
  			  	data: {search: request.term},
  			  	dataType: "json",
  			  	success: function(data) {
  	            	response( $.map( data, function( item ) {
  	              		return {
  	              			value: item.ide, // 8 or 9
  		                	label: item.valor, // Here it will either be Scholarship or fewfew
                        category: item.category,
                        ref:item.ref
  	              		}
  	            	}));
                  $('input[name=brand_id]').val('');
            }
			    });
      	},
        select: function(event, ui){
          $('input[name=brand_id]').val(ui.item.ref);
        },
      	minLength: 1,
    });
});

