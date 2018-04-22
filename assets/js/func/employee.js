$( document ).on( "focus", "input#act_employee", function() {
    $( "input#act_employee" ).attr('autocomplete','on');
    $( "input#act_employee" ).catcomplete({
        source: function(request, response) {
            $.ajax({
                type: "POST",
                url: '/admin/employee/ajax_search',
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
                      //$( 'input[name=act_employee_id_'+$(this).data('id')+']' ).val('');
                      $(this).next().val('');
                }
            });
        },
        select: function(event, ui){
          //$( 'input[name=act_employee_id_'+$(this).data('id')+']' ).val(ui.item.ref);
          $(this).next().val(ui.item.ref);
        },
        minLength: 1,
    });
});
