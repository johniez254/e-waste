// select on product data
var base_url=$("#base_url").val();
function getGadgetPrice(row = null) {
	if(row) {
		var gadgetTypeId = $("#gadgetType"+row).val();		
		
		if(gadgetTypeId == "") {
			$("#gadgetPrice"+row).val("");
			$("#gadgetQuantity"+row).val("");						
			$("#totalPrice"+row).val("");


		} else {
			$.ajax({
				url: base_url+'client/disposes_crud/getPrice',
				type: 'post',
				data: {gadgetTypeId : gadgetTypeId},
				dataType: 'json',
				success:function(response) {
					// setting the rate value into the rate input field
					
					$("#gadgetPrice"+row).val(response.gadget_price);
					$("#gadgetPriceValue"+row).val(response.gadget_price);

					$("#gadgetQuantity"+row).val(1);

					var totalPrice = Number(response.gadget_price) * 1;
					totalPrice = totalPrice.toFixed(2);
					$("#totalPrice"+row).val(totalPrice);
					$("#totalPriceValue"+row).val(totalPrice);

					finalAmount();
				} // /success
			}); // /ajax function to fetch the product data	
		}
				
	} else {
		alert('no row! please refresh the page');
	}
} // /select on product data



// get total based on quantity user inputs
function getTotal(row = null) {
	if(row) {
		var quantity =  Number($("#gadgetQuantity"+row).val());
		
		var total = Number($("#gadgetPrice"+row).val()) * Number($("#gadgetQuantity"+row).val());
		total = total.toFixed(2);
		$("#totalPrice"+row).val(total);
		$("#totalPriceValue"+row).val(total);
		
		finalAmount();

	} else {
		alert('no row !! please refresh the page');
	}
}



//getfinal Total
function finalAmount() {
	var tableDisposeLength = $("#disposeTable tbody tr").length;
	var totalFinalAmount = 0;
	for(x = 0; x < tableDisposeLength; x++) {
		var tr = $("#disposeTable tbody tr")[x];
		var count = $(tr).attr('id');
		count = count.substring(3);

		totalFinalAmount = Number(totalFinalAmount) + Number($("#totalPrice"+count).val());
	} // /for

	totalFinalAmount = totalFinalAmount.toFixed(2);

	// final total
	$("#finalTotal").val(totalFinalAmount);
	$("#finalTotalValue").val(totalFinalAmount);

} // /sub total amount


//function for adding new dispose row
function addDisposeRow() {
	$("#addDisposeRowBtn").button("loading");

	var tableLength = $("#disposeTable tbody tr").length;

	var tableRow;
	var arrayNumber;
	var count;

	if(tableLength > 0) {		
		tableRow = $("#disposeTable tbody tr:last").attr('id');
		arrayNumber = $("#disposeTable tbody tr:last").attr('class');
		count = tableRow.substring(3);	
		count = Number(count) + 1;
		arrayNumber = Number(arrayNumber) + 1;					
	} else {
		// no table row
		count = 1;
		arrayNumber = 0;
	}

	$.ajax({
		url: base_url+'client/disposes_crud/get_gadgets',
		type: 'post',
		dataType: 'json',
		success:function(response) {
			$("#addDisposeRowBtn").button("reset");			

			var tr = '<tr id="row'+count+'" class="'+arrayNumber+'">'+
				'<td>'+
					count+'.'+
				'</td>'+			  				
				'<td>'+
					'<div class="form-group">'+
						'<select class="form-control" name="gadgetType[]" id="gadgetType'+count+'" onchange="getGadgetPrice('+count+')" >'+
							'<option value="" selected>Select Gadget</option>';
							// console.log(response);
							$.each(response, function(index, value) {
								tr += '<option value="'+value['gadget_id']+'">'+value['gadget_name']+'</option>';							
							});
														
						tr += '</select>'+
					'</div>'+
				'</td>'+
				'<td>'+
					'<input type="text" name="gadgetPrice[]" placeholder="Gadget Price" id="gadgetPrice'+count+'"  readonly class="form-control" />'+
					'<input type="hidden" name="gadgetPriceValue[]" id="gadgetPriceValue'+count+'" autocomplete="off" class="form-control" />'+
				'</td>'+
				'<td>'+
					'<div class="form-group">'+
						'<input type="number" name="gadgetQuantity[]" id="gadgetQuantity'+count+'" onkeyup="getTotal('+count+')" placeholder="Add Quantity" autocomplete="off" class="form-control" min="1" />'+
						'<input type="hidden" name="gadgetQuantityValue" value="" id="gadgetQuantityValue<?php echo $x;?>" />'+
					'</div>'+
				'</td>'+
				'<td>'+
					'<input type="text" name="totalPrice[]" id="totalPrice'+count+'" autocomplete="off" placeholder="total price" class="form-control" readonly />'+
					'<input type="hidden" name="totalPriceValue[]" id="totalPriceValue'+count+'" autocomplete="off" class="form-control" />'+
				'</td>'+
				'<td>'+
					'<button class="btn btn-danger removeDisposeRowBtn" type="button" onclick="removeDisposeRow('+count+')"><i class="fa fa-trash-o"></i></button>'+
				'</td>'+
			'</tr>';
			if(tableLength > 0) {							
				$("#disposeTable tbody tr:last").after(tr);
			} else {				
				$("#disposeTable tbody").append(tr);
			}		

		} // /success
	});	// get the product data

} // /add row



//remove selected row
function removeDisposeRow(row=null) {
	if(row) {
		$("#row"+row).remove();

		//recalculate
		finalAmount();
	} else {
		alert('error! Refresh the page again');
	}
}


//validateorderform
function validateDisposeForm(){
	$(document).ready(function() {	

		// create order form function
		$("#disposeForm").unbind('submit').bind('submit', function() {
			var form = $(this);

			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.help-block').remove();
				
			var name = $("#name").val();
			// var email = $("#email").val();
			var phone = $("#phone").val();
			var address = $("#address").val();
			var who = $("#who").val();
			var userfile = $("#userfile").val();
			var collectDate = $("#collectDate").val();
			var description = $("#description").val();		

			// form validation 
			if(name == "") {
				$("#name").after('<p class="help-block"> The Name field is required </p>');
				$('#name').closest('.form-group').addClass('has-error');
			} else {
				$('#name').closest('.form-group').addClass('has-success');
			} // /else
			
			// if(email == "") {
			// 	$("#email").after('<p class="help-block"> The Customer Name field is required </p>');
			// 	$('#email').closest('.form-group').addClass('has-error');
			// }else {
			// 	$('#email').closest('.form-group').addClass('has-success');
			// } // /else

			if(phone == "") {
				$("#phone").after('<p class="help-block"> The Phone field is required </p>');
				$('#phone').closest('.form-group').addClass('has-error');
			} else {
				if(phonenumber()!=false){
					$('#phone').closest('.form-group').addClass('has-success');
				} else{
				    $("#phone").after('<p class="help-block"> Input a  valid phone number </p>');
					$('#phone').closest('.form-group').addClass('has-error');
				}
			} // /else

			if(address == "") {
				$("#address").after('<p class="help-block"> The Location address field is required </p>');
				$('#address').closest('.form-group').addClass('has-error');
			} else {
				$('#address').closest('.form-group').addClass('has-success');
			} // /else

			if(who == "") {
				$("#who").after('<p class="help-block"> Select who you are </p>');
				$('#who').closest('.form-group').addClass('has-error');
			} else {
				$('#who').closest('.form-group').addClass('has-success');
			} // /else

			if(userfile == "") {
				$("#userfile").after('<p class="help-block"> Upload dispose image!</p>');
				$('#userfile').closest('.form-group').addClass('has-error');
			} else {
				$('#userfile').closest('.form-group').addClass('has-success');
			} // /else

			if(collectDate == "") {
				$("#collectDate").after('<p class="help-block"> The Collection Date field is required </p>');
				$('#collectDate').closest('.form-group').addClass('has-error');
			} else {
				$('#collectDate').closest('.form-group').addClass('has-success');
			} // /else

			//descriptions

			if(description == "") {
				$("#description").after('<p class="help-block"> The Description field is required </p>');
				$('#description').closest('.form-group').addClass('has-error');
			} else {
				$('#description').closest('.form-group').addClass('has-success');
			} // /else


			// array validation
			var gadgetType = document.getElementsByName('gadgetType[]');				
			var validateGadgetType;
			for (var x = 0; x < gadgetType.length; x++) {       			
				var gadgetTypeId = gadgetType[x].id;	    	
		    if(gadgetType[x].value == ''){	    		    	
		    	$("#"+gadgetTypeId+"").after('<p class="help-block"> Gadget type Field is required! </p>');
		    	$("#"+gadgetTypeId+"").closest('.form-group').addClass('has-error');	    		    	    	
	      } else {      	
		    	$("#"+gadgetTypeId+"").closest('.form-group').addClass('has-success');	    		    		    	
	      }          
	   	} // for

	   	for (var x = 0; x < gadgetType.length; x++) {       						
		    if(gadgetType[x].value){	    		    		    	
		    	validateGadgetType = true;
	      } else {      	
		    	validateGadgetType = false;
	      }          
	   	} // for       		   	
	   	
	   	//validate quantity array
	   	var gadgetQuantity = document.getElementsByName('gadgetQuantity[]');		   	
	   	var validateGadgetQuantity;
	   	for (var x = 0; x < gadgetQuantity.length; x++) {       
	 			var gadgetQuantityId = gadgetQuantity[x].id;
		    if(gadgetQuantity[x].value == ''){	    	
		    	$("#"+gadgetQuantityId+"").after('<p class="help-block"> Quantity Field is required!! </p>');
		    	$("#"+gadgetQuantityId+"").closest('.form-group').addClass('has-error');	    		    		    	
	      } else {      	
		    	$("#"+gadgetQuantityId+"").closest('.form-group').addClass('has-success');	    		    		    		    	
	      } 
	   	}  // for

	   	for (var x = 0; x < gadgetQuantity.length; x++) {       						
		    if(gadgetQuantity[x].value){	    		    		    	
		    	validateGadgetQuantity = true;
	      } else {      	
		    	validateGadgetQuantity = false;
	      }          
	   	} // for       	
	   	

			if(name && phone && collectDate && address && who && userfile && description) {
				if(validateGadgetType == true && validateGadgetQuantity == true) {
					// dispose add button load
					$("#createDisposeBtn").button('loading');

					$.ajax({
						url : form.attr('action'),
						type: form.attr('method'),
						data: form.serialize(),					
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// reset button
							$("#createDisposeBtn").button('reset');
							
							$(".help-block").remove();
							$('.form-group').removeClass('has-error').removeClass('has-success');

							if(response.success == true) {
								
								// create order button
								$(".success-messages").html('<div class="alert alert-success">'+
					            	'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
					            	'<strong><i class="fa fa-check-circle"></i></strong> <b>'+ response.messages +
					            	'</b> <br /> <br /> <a href="#" onclick="gotoPaymentsPage('+"'"+response.transaction_code+"'"+')" class="theme_button"> <i class="fa fa-money"></i> Proceed to Payment </a>'+
					            	'<a href="#" onclick="reLoad()" class="theme_button color1" style="margin-left:10px;"> <i class="fa fa-plus-circle"></i> Add New Dispose </a>'+
					            	
					   		       '</div>');
								
							$("html, body, div.panel, div.pane-body").animate({scrollTop: '0px'}, 100);

							// disabled te modal footer button
							document.getElementById("addDisposeRowBtn").style.display="none";
							document.getElementById("taskButtons").style.display="none";
							
							// remove the product row
							$(".removeDisposeRowBtn").addClass('disabled');
								
							} else {
								alert(response.messages);								
							}
						} // /response
					}); // /ajax
				} // if array validate is true
			} // /if field validate is true
			

			return false;
		}); // /create order form function		

}); // /documernt
}//validateorder



//reload page
function reLoad(){
	// window.location.reload(true);
	setTimeout(function(){
		window.location.reload(true);
	}, 2000);
}

//reset form
function resetDisposeForm() {
	// reset the input field
	$("#disposeForm")[0].reset();
	// remove remove text danger
	$(".help-block").remove();
	// remove form group error 
	$(".form-group").removeClass('has-success').removeClass('has-error');
	
} // /reset order form

//redirect to payments
function gotoPaymentsPage(transaction_code=null) {
	if(transaction_code){
	  location.replace(base_url+"client/disposes/view/"+transaction_code)

	}
}

//validate phone number field
function phonenumber() {
  // var phoneno =/^(?:254|\+254|0)?(7(?:(?:[129][0-9])|(?:0[0-8])|(4[0-1]))[0-9]{6})$/;
  var phoneno =/^(?:254|\+254|0)?((7|1)(?:(?:[129][0-9])|(?:0[0-8])|(4[0-1]))[0-9]{6})$/;
  if(phone.value.match(phoneno) && phone.value.length==9) {
    return true;
  }
  else {
    return false;
  }
}
