$.widget( "custom.catcomplete", $.ui.autocomplete, {
    _create: function() {
      this._super();
      this.widget().menu( "option", "items", "> :not(.ui-autocomplete-category)" );
    },
//ini - o que for digitando ficar em bold 
    _renderItem: function( ul, item) {
        return $( "<li data-ide="+item.value+" aria-ref="+item.ref+"></li>" )
            .data( "item.autocomplete", item )
            .append( $( "<a></a>" ).html( item.label ) )
            .appendTo( ul );
    },
//fim - o que for digitando ficar em bold
    _renderMenu: function( ul, items ) {
      var that = this,
        currentCategory = "";
      $.each( items, function( index, item ) {
        var li;
        if ( item.category != currentCategory ) {
          ul.append( "<li class='ui-autocomplete-category'>" + item.category + "</li>" );
          currentCategory = item.category;
        }
        li = that._renderItemData( ul, item );
        if ( item.category ) {
          li.attr( "aria-label", item.category + " : " + item.label );
        }
      });
    }
  });
//ini - quando der resize na janela vai esconder o resultado do autocomplete.
$( window ).resize(function() {
  $('#ui-id-1').css('display','none');
});
//fim - quando der resize na janela vai esconder o resultado do autocomplete.

$(function() {
  
  var isSearch = false;
  var search = '';

  function viewSearch(search, filepath)
  {
    if (window.location.href.indexOf("search") > -1)
    {
      $.ajax({
            type: "POST",
            url: '/search/ajax_view',
            data: {id: search},
            success: function(data) {
              $("#conteudo").html(data);
            }
          });
    } else {
      event.preventDefault();
      window.location.href = '/search?q='+search;
    }
  }

  $('input#search').on('catcompleteselect', function (e, ui) {
    search = ui.item.value;
    isSearch = true;
    viewSearch(search);
  });

  $('input#search').on( "keypress", function() {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
      //event.preventDefault();
      if(!isSearch)
      {
        search = $(this).val();
      }
      isSearch = false;
      $('#ui-id-1').hide();
      viewSearch(search);
    }
  });


	$('input#search').attr('autocomplete','on');
    $( "input#search" ).catcomplete({
      	source: function(request, response) {
      		//var v = $( "input[name=search]" ).val();
      		$.ajax({
  			  	type: "POST",
  			  	url: '/search/ajax_search',
  			  	data: {search: request.term},
  			  	dataType: "json",
  			  	success: function(data) {
  	            	response( $.map( data, function( item ) {
  	              		return {
  	              			value: item.ide, // 8 or 9
  		                	label: item.valor, // Here it will either be Scholarship or fewfew
                        category: item.category,
                        ref:null
  	              		}
  	            	}));
            }
			    });
      	},
      	minLength: 1,
    });
});

/*
$(function() { 
	$('input[name=search]').attr('autocomplete','on');
    $( "input[name=search]" ).autocomplete({
      	source: function(request, response) {
      		var v = $( "input[name=search]" ).val();
	        $.ajax({
	          	url: '/search/ajax_search',
	          	data: {search: v},
	          	dataType: "json",
	          	success: function(data) {
	            	response( $.map( data.myData, function( item ) {
	              		return {
		                	label: item.vehicle_id, // Here it will either be Scholarship or fewfew
		                	value: item.vehicle_value // 8 or 9
	              		}
	            	}));
	          	}
	        });
      	},
    });
});
*/