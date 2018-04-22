$(function() {
    $('input[name=svo_vehicle_owner]').attr('autocomplete','on');
    $( "input[name=svo_vehicle_owner]" ).catcomplete({
        
        source: function(request, response) 
        {
            var retorno = '';
            var v = $( "input[name=svo_vehicle_owner]" ).val();
            $.ajax({
                type: "POST",
                url: '/admin/vehicle_owner/ajax_search',
                data: {search: request.term},
                dataType: "json",
                success: function(data) 
                {
                    response( $.map( data, function( item ) {
                        return {
                            value   : item.ide,
                            label   : item.valor,
                            category: item.category,
                            ref     : item.ref
                        }
                    }));
                    $('input[name=svo_vehicle_owner_id]').val('');
                }
            });
        },
        select: function(event, ui){
            $('input[name=svo_vehicle_owner_id]').val(ui.item.ref);
        },
        minLength: 1,
    });
});
