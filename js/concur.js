function verifFields() {
	
	if($("#titreSite").val().length == 0 || 
		$("#beforePattern").val().length == 0){

		alert('Une information est manquante');

	}
	else{
		document.form.submit();
	}

}