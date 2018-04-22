$(function() {
    $('input[name=vow_client]').attr('autocomplete','on');
    $( "input[name=vow_client]" ).catcomplete(
    {
        source: function(request, response) 
        {
            var v = $( "input[name=vow_client]" ).val();
            $.ajax({
                type: "POST",
                url: '/admin/client/ajax_search',
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
                    $('input[name=cli_id]').val('');
                }
            });
        },
        select: function(event, ui){
            $('input[name=cli_id]').val(ui.item.ref);
        },
        minLength: 1,
    });
});
