jQuery(document).ready(function($) {

	$( document ).on( "click", "button#btnactivity", function() {
		event.preventDefault();
		$(this).parent().remove();
		//var id = $(this).data('id');
		//$( '#activity_'+id ).remove();
	});

	// $('#activity').click(function(event) {
	$( document ).on( 'click' ,'button#activity',function(event) {
		event.preventDefault();
		var post = $.post(
				"/admin/activity/ajax_new",
				{id: $( "input[name=tot_activity]" ).val()},
				'json');

			post.done(function(json){
				obj = JSON && JSON.parse(json) || $.parseJSON(json);

				if(obj.st)
				{
					$( "#add_activity" ).next().before(obj.retorno);
				}
			});
		return false;
	});

	$( document ).on( "click", "button#editActivity", function() {
		event.preventDefault();
		var btn = this;
		var edit = true;
		if(!$("button#delete").length)
		{	
			edit = false;
		}
		if($(btn).find("span").hasClass('glyphicon-pencil'))
		{
			var id = $(btn).data('id');
			$( '#activity_'+id ).remove();

			var post = $.post(
					"/admin/activity/ajax_list",
					{id: $( btn ).data('id'), ed: edit},
					'json');

			post.done(function(json){
				obj = JSON && JSON.parse(json) || $.parseJSON(json);

				if(obj.st)
				{
					$(btn).find("span").removeClass('glyphicon-pencil').addClass('glyphicon-remove');
					$(btn).parents("tr").after(obj.retorno);
				}
			});
		} else {
			$(btn).find("span").removeClass('glyphicon-remove').addClass('glyphicon-pencil');
			$(btn).parents("tr").next().remove();
		}
		return false;
	});

});