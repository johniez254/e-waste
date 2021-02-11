var base_url = $("#base_url").val();

$(document).ready(function(){
	$("#nameForm").unbind('submit').bind('submit', function() {
		
		var form = $(this);
			var url = form.attr('action');
			var type = form.attr('method');

		$.ajax({
			url  : url,
			type : type,
			data : form.serialize(),
			dataType: 'json',
			success:function(response) {
				if(response.success == true) {
					$("#nameMessage").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>');					

						// document.getElementById("nameForm").reset();
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


$(document).ready(function(){
	$("#passwordForm").unbind('submit').bind('submit', function() {
		
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
					$("#passwordMessage").html('<div class="alert alert-success alert-dismissible" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  response.messages + 
						'</div>');					


						$("#passwordForm")[0].reset();
						$(".form-group").removeClass('has-error').removeClass('has-success');
						$(".help-block").remove();
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


		
function clearForm()
{
	$('input[type="text"]').val('');
	$('select').val('');
	$(".fileinput-remove-button").click();	
}


//clear form input		
function resetForm(){
	$("#nameForm")[0].reset();
	
	$(".form-group").removeClass('has-error').removeClass('has-success');
	$('.help-block').remove();	
}


//reload page
function reLoad(){
	// window.location.reload(true);
	setTimeout(function(){
		window.location.reload(true);
	}, 3000);
}