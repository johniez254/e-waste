//validateorderform
var base_url=$("#base_url").val();
function validateGadgetForm(){
	$(document).ready(function() {	

		// create order form function
		$("#gadgetForm").unbind('submit').bind('submit', function() {
			var form = $(this);

			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.help-block').remove();


			// array validation
			var gadgetName = document.getElementsByName('gadgetName[]');				
			var validateGadget;
			for (var x = 0; x < gadgetName.length; x++) {       			
				var gadgetNameId = gadgetName[x].id;	    	
		    if(gadgetName[x].value == ''){	    		    	
		    	$("#"+gadgetNameId+"").after('<p class="help-block"> This Gadget Name Field is required! </p>');
		    	$("#"+gadgetNameId+"").closest('.form-group').addClass('has-error');	    		    	    	
	      }
	       else {
	       	$("#"+gadgetNameId+"").closest('.form-group').addClass('has-success');	    		    		    	
	      }          
	   	} // for

	   	for (var x = 0; x < gadgetName.length; x++) {       						
		    if(gadgetName[x].value){	    		    		    	
		    	validateGadget = true;
	      } else {      	
		    	validateGadget = false;
	      }          
	   	} // for


		// array validation
		var gadgetPrice = document.getElementsByName('gadgetPrice[]');				
		var validateGadgetPrice;
			for (var x = 0; x < gadgetPrice.length; x++) {       			
				var gadgetPriceId = gadgetPrice[x].id;	    	
			    if(gadgetPrice[x].value == ''){	    		    	
			    	$("#"+gadgetPriceId+"").after('<p class="help-block"> This Gadget Price Field is required! </p>');
			    	$("#"+gadgetPriceId+"").closest('.form-group').addClass('has-error');
			    }
		       else {      	
			    	$("#"+gadgetPriceId+"").closest('.form-group').addClass('has-success');	    		    		    	
		      }          
	   	} // for

	   	for (var x = 0; x < gadgetPrice.length; x++) {       						
		    if(gadgetPrice[x].value){	    		    		    	
		    	validateGadgetPrice = true;
	      } else {      	
		    	validateGadgetPrice = false;
	      }          
	   	} // for        		   	
	   	
	   	
		if(validateGadget == true && validateGadgetPrice==true) {
			// create order button
			$("#createGadgetBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),					
				dataType: 'json',
				success:function(response) {
					console.log(response);
					// reset button
					$("#createGadgetBtn").button('reset');
					
					$(".help-block").remove();
					$('.form-group').removeClass('has-error').removeClass('has-success');

					if(response.success == true) {
						// create order button
						$(".messages").html('<div class="alert alert-success">'+
				        	'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				        	'<strong><i class="fa fa-check-circle"></i></strong> <b>'+ response.messages +
				        	'</div>');
						$("html, body, div.panel, div.pane-body").animate({scrollTop: '0px'}, 100);
						// disabled te modal footer button
						document.getElementById("taskButtons").style.display="none";
						// remove the product row
						$(".removeGadgetRowBtn").addClass('disabled');
						//reload form
						reLoad();
						} else {
							alert(response.messages);								
						}
					} // /response
				}); // /ajax
			} // if array validate is true
		return false;
		}); // /create order form function		
	}); // /documernt
}//validateorder



//add gadgets row
function addRow() {
	$("#addRowBtn").button("Adding");

	var tableLength = $("#gadgetsTable tbody tr").length;

	var tableRow;
	var arrayNumber;
	var count;

	if(tableLength > 0) {		
		tableRow = $("#gadgetsTable tbody tr:last").attr('id');
		arrayNumber = $("#gadgetsTable tbody tr:last").attr('class');
		count = tableRow.substring(3);	
		count = Number(count) + 1;
		arrayNumber = Number(arrayNumber) + 1;					
	} else {
		// no table row
		count = 1;
		arrayNumber = 0;
	}
	$.ajax({		
		success:function(response) {
			$("#addRowBtn").button("reset");			

			var tr = '<tr id="row'+count+'" class="'+arrayNumber+'">'+
							  				
			'<td>'+
				''+count+'.'+
			'</td>'+
			'<td>'+
				'<div class="form-group">'+
				'<input type="text" name="gadgetName[]" id="gadgetName'+count+'" autocomplete="off" class="form-control" placeholder="Gadget Name"/>'+
				'</div>'+
			'</td>'+
			'<td>'+
				'<div class="form-group">'+
				'<input type="number" name="gadgetPrice[]" placeholder="price in ksh" id="gadgetPrice'+count+'" autocomplete="off" class="form-control" min="1" />'+
				'</div>'+
			'</td>'+
			'<td>'+
				'<button class="btn btn-danger removeGadgetBtn" type="button" onclick="removeGadgetRow('+count+')" data-toggle="tooltip" data-placement="top" title="Delete Row"><i class="fa fa-trash-o"></i></button>'+
			'</td>'+
		'</tr>';
		if(tableLength > 0) {							
			$("#gadgetsTable tbody tr:last").after(tr);
		} else {				
			$("#gadgetsTable tbody").append(tr);
		}		

	} // /success
});	// get the product data

} // /add row end


//update client
$(document).ready(function(){
	$("#updateGadgetForm").unbind('submit').bind('submit', function() {
		
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
					$("#gadgetUpdate").html('<div class="alert alert-success alert-dismissible" role="alert">'+
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

//function check gadgetAvailability
// function checkGadgetAvailability(name=null){
// 	if(name){
// 		$.ajax({
// 		        url: base_url+'admin/gadgets_crud/check_availability/'+name,
// 		        success: function(response)
// 		        {
// 	            // jQuery('#check').html(response);
// 	            if(response==false){
// 	            	return false;
// 	            } else{
// 	            	return true
// 	            }
// 	        }
// 	    });
// 	}
// }

//remove selected row
function removeGadgetRow(row=null) {
	if(row) {
		$("#row"+row).remove();
	} else {
		alert('error! Refresh the page again');
	}
}

//reset form
function resetGadgetForm() {
	// reset the input field
	$("#gadgetForm")[0].reset();
	// remove remove text danger
	$(".help-block").remove();
	// remove form group error 
	$(".form-group").removeClass('has-success').removeClass('has-error');
	
} // /reset order form



//reload page
function reLoad(){
	// window.location.reload(true);
	setTimeout(function(){
		window.location.reload(true);
	}, 3000);
}