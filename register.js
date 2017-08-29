$(document).ready(function(){
	$("#registerUser").submit(function(){
		$.ajax({
			beforeSend: function(){
				$('.loader').css("visibility", "visible");
			},
			type : 'POST',
			url : 'php/register.php',
			data : $(this).serialize(),
			success : function(response){
					$('.loader').css("visibility", "hidden");
						var result = $.parseJSON(response);
						if(result["success"] == 1){
							$('#result').append(""
							+"<div class='alert alert-success' role='alert'>"
							+"	<strong>"+result["msg"]+"</strong><a href='index.html'>Back to login ? </a>"
							+"</div>"
							);
							  
						}else{
							$('#result').append(
							""
							+"<div class='alert alert-danger' role='alert'>"
							+"	<strong>"+result["msg"]+"</strong>"
							+"</div>"
							);
						}
						
						//Reset All Form fields
						
					},
			error : function failCallBk(){
						alert("Something went wrong.");
					}
		});
		
		//Prevent whole page refresh.
		return false;
	});
});

