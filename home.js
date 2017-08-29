var _result="";
$(document).ready(function(){
	$.ajax({
		beforeSend: function(){
				$('.loader').css("visibility", "visible");
			},
			url : 'php/home.php',
			success : function(response){
						$('.loader').css("visibility", "hidden");
						 _result = $.parseJSON(response);
						 var result = _result;
						if(result["success"] == 1){
							$('#logoutBtn').append(""
							+"<button type='button' id='logUserout' class='btn btn-warning'>Logout(Not "+ result["Users"][0].name +") ?</button>"
							);
							
							//Logout User JS
							$("#logUserout").on("click",function(){
								$.ajax({
								beforeSend: function(){
										$('.loader').css("visibility", "visible");
									},
									url : 'php/logout.php',
									success : function(response){
										$('.loader').css("visibility", "hidden");
										var result = $.parseJSON(response);
										if(result["success"] == 1){
											$('#result').append(""
											+"<div class='alert alert-success' role='alert'>"
											+"	<strong>"+result["msg"]+" <span id='timer'></span> sec.</strong>"
											+"</div>"
											);
											startTimer(5,$("#timer"));
											window.setInterval(function(){window.location = "index.html";}, 5000);
										}else{
											$('#result').append(""
											+"<div class='alert alert-danger' role='alert'>"
											+"	<strong>"+result["msg"]+"</strong>"
											+"</div>"
											);
										}
									},
									error : function failCallBk(){
										alert("Something went wrong.");
									}
								});
							});
								
							//End
						}else{
							$('#result').append(""
							+"<div class='alert alert-danger' role='alert'>"
							+"	<strong>Error Occured!</strong>"
							+"</div>"
							);
						}
					},
			error : function failCallBk(){
						alert("Something went wrong.");
					}
	});
});


function getAllUsers(){
	$.ajax({
		beforeSend: function(){
				$('.loader').css("visibility", "visible");
			},
			type : 'POST',
			url : 'php/home.php',
			data : {data:"all"},
			success : function(response){
						$('.loader').css("visibility", "hidden");
						var result = $.parseJSON(response);
							if(result["success"] == 1){
								//reset result div
								$("#result").html("");
								var counter = 1;
								//Edit Modal
								
								//End
								var container = $('#result'),
								  table = $("<table class='table table-striped'>");
								  var th = $("<thead>");
								  th.append("<tr>"
									+"<th>#</th>"
									+"<th>Name</th>"
									+"<th>User Name</th>"
									+"<th>Email</th>"
									+"<th>Action</th>"
									+"</tr>"
								  );
								  table.append(th);
								  table.append("<tbody>");
								result["Users"][0].forEach(function(userData) {
								  var tr = $('<tr>');
								  
									tr.append("<th scope='row'>" + counter + "</th>");
									tr.append('<td>' + userData.name + '</td>');
									if(userData.username == _result["Users"][0].username){
									  tr.append('<td>' + userData.username + '(Current User)</td>');
									}else{
										tr.append('<td>' + userData.username + '</td>');
									}
									
									tr.append('<td>' + userData.email + '</td>');
									 
									if(userData.username == _result["Users"][0].username){
										tr.append("<td><button class='btn btn-info editUser' uid='"+userData.id+"' onClick='editUser("+userData.id+")'  data-toggle='modal' data-target='#editUserModal'>Edit</button>&nbsp;</td>");
									}else{
										tr.append("<td><button class='btn btn-info editUser' uid='"+userData.id+"' onClick='editUser("+userData.id+")' data-toggle='modal' data-target='#editUserModal'>Edit</button>&nbsp;<button onClick='deleteUser()' class='btn btn-danger' uid='"+userData.id+"'>Delete</button></td>");
									}
									
									table.append(tr);
									counter++;
								});
								table.append("</tbody>");
								container.append(table);
								
							}else{
								$('#result').append(""
							+"<div class='alert alert-danger' role='alert'>"
							+"	<strong>Error Occured!</strong>"
							+"</div>"
							);
							}
						}
					,
			error : function failCallBk(){
						alert("Something went wrong.");
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

function editUser(uid){
		$(".modal-title").html("Edit User Id : " + uid);
		$.ajax({
			beforeSend: function(){
				$('.loader').css("visibility", "visible");
			},
			type : 'POST',
			url : 'php/home.php',
			data : {"uid" : uid},
			success : function(response){
					$('.loader').css("visibility", "hidden");
						var result = $.parseJSON(response);
						if(result["success"] == 1){
							$("#firstName").val(""+ result["Users"][0].name);
							$("#userName").val(""+ result["Users"][0].username);
							$("#email").val(""+ result["Users"][0].email);
						}else{
							$('#result').append(""
							+"<div class='alert alert-danger' role='alert'>"
							+"	<strong>Error Occured!</strong>"
							+"</div>"
							);
						}
			},
			error : function failCallBk(){
						alert("Something went wrong.");
			}
		});
}

function deleteUser(){
	
}