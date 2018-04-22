$(function() {
    $('input[name=veh_model]').attr('autocomplete','on');
    $( "input[name=veh_model]" ).catcomplete({
        source: function(request, response) {
            var v = $( "input[name=veh_model]" ).val();
            $.ajax({
                type: "POST",
                url: '/admin/model/ajax_search',
                data: {search: request.term, brand: $('input[name=brand_id]').val()},
                dataType: "json",
                success: function(data) {
                      response( $.map( data, function( item ) {
                          return {
                            value: item.ide, //C3
                            label: item.valor, //<b>C</b>3
                            category: item.category,
                            ref: item.ref
                          }
                      }));
                      $('input[name=veh_model_id]').val('');
                }
            });
        },
        select: function(event, ui){
          $('input[name=veh_model_id]').val(ui.item.ref);
        },
        minLength: 1,
    });
});
