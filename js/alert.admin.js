var reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');
				
$(document).ready(function(){
	$("#submit-alert-email").click(function(){
		if(!reg.test($("#input-alert-email").val())){
			alert("Adresse e-mail incorrecte !");
		}
		else{
			$.ajax({
				type: "POST", 
				url: "postcall/addalertmail.postcall.php", 
				data:
				"email="+$("#input-alert-email").val(),
				success: function(response){
					document.location.href = "/alert.admin.php?event=added";
				}
			});
		}
	});
});