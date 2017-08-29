function getAllTweet(){
	$.ajax({
		beforeSend: function(){
				$('.loader').css("visibility", "visible");
			},
			type : 'POST',
			url : 'api.php',
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
									+"<th>Date</th>"
									+"<th>ID</th>"
									+"<th>Full URL</th>"
									+"<th>T URL</th>"
									+"</tr>"
								  );
								  table.append(th);
								  table.append("<tbody>");
								result["Tweet"][0].forEach(function(userData) {
								  var tr = $('<tr>');
								  
									tr.append("<th scope='row'>" + counter + "</th>");
									tr.append('<td>' + userData.created_at + '</td>');
									
									tr.append('<td>' + userData.id + '</td>');
									
									
									tr.append('<td>' + userData.expanded_url + '</td>');
									 
									tr.append('<td>' + userData.url + '</td>'); 
									
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
						$('.loader').css("visibility", "hidden");
					}
	});
}