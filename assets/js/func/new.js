jQuery(document).ready(function($) {

	$( document ).on( 'click' ,'button#adicionar',function (event) {
		$( ".adicionando" ).toggle();
		$( "div#result" ).hide();
	});

	jQuery('form#add').submit(function(event){
		// Stop form from submitting normally
  		event.preventDefault();
		var post = $.post(
				$('#add').attr('action'),
				$('#add').serialize(),
				'json');

			post.done(function(json){
				json = json.substring(json.search('}')+1, -json.length);
				obj = JSON && JSON.parse(json) || $.parseJSON(json);

				$( "div#result" ).show();
				$( "div#result" ).addClass('alert');
				if(obj.st)
				{
					$( ".adicionando" ).toggle();
					$( "div#result" ).removeClass('alert-danger');
					$( "div#result" ).addClass('alert-success');
					$('tbody tr:first').before(obj.retorno);
					setTimeout(function() { $("div#result").fadeOut(1500); }, 5000);
				} else {
					$( "div#result" ).removeClass('alert-success');
					$( "div#result" ).addClass('alert-danger');
				}
				$('div#result div').html(obj.msg);
			});
		return false;
	});

	$( "button#delete" ).click(function(event) {
	  	var url = $('form#add').attr('action');
		url = url.split("ajax_add");
		url = url[0]+"ajax_delete";
		
		var element = this;

	  	var post = $.post(
	  		url,
	  		{id:$(element).data('id')},
	  		'json');

	  	post.done(function(json){
	  		json = json.substring(json.search('}')+1, -json.length);
	  		obj = JSON && JSON.parse(json) || $.parseJSON(json);
	  		
	  		$( "div#result" ).show();
			$( "div#result" ).addClass('alert');
			if(obj.st)
			{
				$( "div#result" ).removeClass('alert-danger');
				$( "div#result" ).addClass('alert-success');
				
				if($(element).parents('tr').next('tr#infoActivitys')){ //elemento filho da order
	  				$(element).parents('tr').next('tr#infoActivitys').remove();
	  			}
	  			$(element).parents('tr').remove();
				setTimeout(function() { $("div#result").fadeOut(1500); }, 5000);
			} else {
				$( "div#result" ).removeClass('alert-success');
				$( "div#result" ).addClass('alert-danger');
			}
			$('div#result div').html(obj.msg);
			
		});
	  	return false;
	  	
	});

	var btn = null;
	$( "button#edit" ).click(function(event) {
		btn = this;
	});

	jQuery('form#update').submit(function(event){
		event.preventDefault();
		var campos = this.elements;
		var readonly = true;

		if($(btn).find("span").hasClass('glyphicon-pencil')) {
			$(btn).find("span").removeClass('glyphicon-pencil').addClass('glyphicon-floppy-disk');

			readonly = false;	
			$(btn).blur();	
			for(var i =0; i < campos.length-2; i++){
				if(campos[i].tagName == 'INPUT'){
					$(campos[i]).prop( "readonly", readonly );
				}
				if(campos[i].type == 'checkbox'){
					$(campos[i]).prop("disabled", false);
				}
			}	
		} else {
			var post = $.post(
					$(this).attr('action'),
					$(this).serialize(),
					'json');
				//($(this).serialize()+'&'+$.param({ 'id': $(btn).data('id') })),
				post.done(function(json){
					json = json.substring(json.search('}')+1, -json.length);
					obj = JSON && JSON.parse(json) || $.parseJSON(json);

					$( "div#result" ).show();
					$( "div#result" ).addClass('alert');
					$( ".adicionando" ).hide();
					if(obj.st)
					{
						$(btn).find("span").removeClass('glyphicon-floppy-disk').addClass('glyphicon-pencil');
						readonly = true;
						$( "div#result" ).removeClass('alert-danger');
						$( "div#result" ).addClass('alert-success');
						setTimeout(function() { $("div#result").fadeOut(1500); }, 5000);
					} else {
						readonly = false;
						$( "div#result" ).removeClass('alert-success');
						$( "div#result" ).addClass('alert-danger');
					}
					$('div#result div').html(obj.msg);

					$(btn).blur();
					for(var i =0; i < campos.length-2; i++){
						if(campos[i].tagName == 'INPUT'){
							$(campos[i]).prop( "readonly", readonly );
						}
						if(campos[i].type == 'checkbox'){
							$(campos[i]).prop("disabled", true);
						}
					}
				});
			return false;
		}
	});

	$( "div#result :button" ).click(function(event) {
		$( "div#result" ).hide();
	});

});
