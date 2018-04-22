$( document ).on( "focus", "input#act_service", function() {
    $('input#act_service').attr('autocomplete','on');
    $( "input#act_service" ).catcomplete({
        source: function(request, response) {
            $.ajax({
                type: "POST",
                url: '/admin/service/ajax_search',
                data: {search: request.term},
                dataType: "json",
                success: function(data) {
                    response( $.map( data, function( item ) {
                        return {
                            value: item.ide,
                            label: item.valor,
                            category: item.category,
                            ref: item.ref
                        }
                    }));
                    //$( 'input[name=act_service_id_'+$(this).data('id')+']' ).val('');
                    $(this).next().val('');
                }
            });
        },
        select: function(event, ui){
            //$( 'input[name=act_service_id_'+$(this).data('id')+']' ).val(ui.item.ref);
            $(this).next().val(ui.item.ref);
        },
        minLength: 1,
    });
});

