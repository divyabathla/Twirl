$(document).ready(function(){
	$("#loginUser").submit(function(){		
		$.ajax({
			beforeSend: function(){
				$('.loader').css("visibility", "visible");
			},
			type : 'POST',
			url : 'php/login.php',
			data : $(this).serialize(),
			success : function(response){
						$('.loader').css("visibility", "hidden");
						var result = $.parseJSON(response);
						
						if(result["success"] == 1){
							
								$('#result').append(""
							+"<div class='alert alert-success' role='alert'>"
							+"	<strong>"+result["msg"] +" <span id='timer'></span> sec.</strong>"
							+"</div>"
								);
								startTimer(5,$("#timer"))
								window.setInterval(function(){window.location="home.php"},5000);
							
						}else{
							$('#result').append(""
							+"<div class='alert alert-danger' role='alert'>"
							+"	<strong>"+result["msg"]+"</strong>"
							+"</div>"
							);
						}
					},
			error : function failCallBk(){
						alert("Something went wrong ");
						$('.loader').css("visibility", "hidden");
					}
		});
		
		//Prevent whole page refresh.
		return false;
	});
});

function forgetPassword(){
	
	$.ajax({
			beforeSend: function(){
				$('.loader').css("visibility", "visible");
			},
			type : 'POST',
			url : 'php/forgetPass.php',
			data :{"email":$("#email").val()},
			success : function(response){
						$('.loader').css("visibility", "hidden");
					
						var result = $.parseJSON(response);
						
						if(result["success"] == 1){
							$(".modal-body").html(result["msg"]);
						}else{
							$(".modal-body").html("Error Invalid email supplied. Please try again.");
						}
					},
			error : function failCallBk(){
						alert("Something went wrong while sending email.");
						$('.loader').css("visibility", "hidden");
					}
		});
}

function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.html(minutes + ":" + seconds);

        if (--timer < 0) {
            timer = duration;
        }
    }, 1000);
}
