$(function() {
    $('input[name=order_for]').attr('autocomplete','on');
    $( "input[name=order_for]" ).catcomplete({
        
        source: function(request, response) 
        {
            var retorno = '';
            var v = $( "input[name=order_for]" ).val();
            $.ajax({
                type: "POST",
                url: '/admin/order/ajax_search_order_for',
                data: {search: request.term},
                dataType: "json",
                success: function(data) 
                {
                    response( $.map( data, function( item ) {
                        return {
                            value       : item.ide,
                            label       : item.valor,
                            category    : item.category,
                            ref         : item.ref,
                            tpCategory  : item.tpCategory
                        }
                    }));
                    $('input[name=svo_client_id]').val('');
                    $('input[name=svo_vehicle_owner_id]').val('');
                    $('input[name=svo_vehicle_id]').val('');
                    
                    $('input[name=cli_id]').val('');
                    $('input[name=vow_vehicle]').data('validation','');
                    $('input[name=vow_client]').data('validation','');
                    $('div[name=vehicle]').hide();
                    $('div[name=client]').hide();
                }
            });
        },
        select: function(event, ui){
            if(ui.item.tpCategory == 1){
                $('input[name=svo_client_id]').val(ui.item.ref);
                $('div[name=vehicle]').show();
                $('input[name=vow_vehicle]').data('validation','required');
                alert('cade');
            } else if (ui.item.tpCategory == 2) {
                $('input[name=svo_vehicle_owner_id]').val(ui.item.ref);
            } else if (ui.item.tpCategory == 3){
                $('input[name=svo_vehicle_id]').val(ui.item.ref);
                $('div[name=client]').show();
                $('input[name=vow_client]').data('validation','required');
            } 
        },
        minLength: 1,
    });
});
