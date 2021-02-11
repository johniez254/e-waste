$(document).ready(function(){
	$("#loginform").unbind('submit').bind('submit', function() {
		
		var form = $(this);
		var url = form.attr('action');
		var type = form.attr('method');

		$.ajax({
			url  : url,
			type : type,
			data : form.serialize(),
			dataType: 'json',
			success:function(response) {
				if(response.success === true) {
					window.location = response.messages;
				}
				else {
					if(response.messages instanceof Object) {
						$("#message").html('');	

						$.each(response.messages, function(index, value) {
							var key = $("#" + index);
								
							key.closest('.form-group')
							.removeClass('has-error')
							.removeClass('has-success')
							.addClass(value.length > 0 ? 'has-error' : 'has-success')
							.find('.help-block').remove();

							key.after(value);

						});
						
					} 
					else {
						//$("#loginForm")[0].reset();						
						$(".help-block").remove();
						$(".form-group").removeClass('has-error').removeClass('has-success');

						$("#message").html('<div class="alert alert-danger">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><center>'+
						  response.messages + 
						'</center></div>');
					} // /else
				} // /else
			} // /if
		});

		return false;
	});
});// JavaScript Document


