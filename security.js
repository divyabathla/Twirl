$(document).ready(function(){
	$.ajax({
		beforeSend: function(){
				$('.loader').css("visibility", "visible");
			},
			url : 'php/security.php',
			success : function(response){
						$('.loader').css("visibility", "hidden");
						var result = $.parseJSON(response);
						
						if(result["success"] == 1){
							
						}else{
							window.setInterval(function(){window.location = "home.php";}, 500);
						}
					},
			error : function failCallBk(){
						alert("Something went wrong.");
					}
	});
});