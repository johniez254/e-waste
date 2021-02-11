//check if requires reload
var check_reload = $("#reload").val();

$(document).ready(function(){
	$("#regform").unbind('submit').bind('submit', function() {
		
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
					$("#message").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>');					


						//reset inputs
						document.getElementById("regform").reset();
						$(".form-group").removeClass('has-error').removeClass('has-success');
						$(".help-block").remove();
						
						//reload page
						if(check_reload){
							reLoad();
						}
				}
				else {
					
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
				} // /success
			}); // /ajax

		return false;
	});
});// JavaScript Document


//update client
$(document).ready(function(){
	$("#updateClientForm").unbind('submit').bind('submit', function() {
		
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
					$("#clientUpdate").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>');					


						//reset inputs
						//document.getElementById("clientUpdate").reset();
						$(".form-group").removeClass('has-error').removeClass('has-success');
						$(".help-block").remove();
						
						//reload page
						reLoad();
				}
				else {
					
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
				} // /success
			}); // /ajax

		return false;
	});
});// JavaScript Document

//reload page
function reLoad(){
	// window.location.reload(true);
	setTimeout(function(){
		window.location.reload(true);
	}, 3000);
}



