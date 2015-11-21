var lotID = 0;

function refreshLots() {
	$.ajax({
		type: "POST", 
		url: "postcall/refreshlots.postcall.php", 
		data: "refresh=1",
		success: function(response){
			$("#lots-en-attente").html(response);
			setTimeout("refreshLots()", 5000);
		}
	});
}

function addLot() {
	if($("#nom").val().length != 0){
		$.ajax({
			type: "POST", 
			url: "postcall/addlot.postcall.php", 
			data: "nom=" + $("#nom").val() + "&description=" + $("#description").val(),
			success: function(response){
				$("#nom").val("");
				$("#description").val("");
				refreshLots();
			}
		});
	}
	else{
		alert("Merci d'entrer un nom de vendeur");
	}
}

function printVendus() {
	
  if($("#code").val().length > 1){

    $("#vendus").html('<center><img src="images/design/loading.gif"></center>');

    $.ajax({
      type: "GET", 
      url: "getcall/smallsearch.getcall.php",
      data: "keyword="+$("#code").val(),
      success: function(response){
          $("#vendus").html(response);
      } 
    });

  }
  else{
  	 $("#vendus").html('');
  }

}

function emptyAll() {
	emptyCode();
	emptyTitre();
	emptyAuteur();
	emptyEditeur();
	emptyVente();
	emptyAchatEsp();
	emptyAchatEch();
}

function emptyCode() {
	$("#code").val("");
}

function emptyTitre() {
	$("#titre").val("");
}

function emptyAuteur() {
	$("#auteur").val("");
}

function emptyEditeur() {
	$("#editeur").val("");
}

function emptyVente() {
	$("#vente").val("");
}

function emptyAchatEsp() {
	$("#achatesp").val("");
}

function emptyAchatEch() {
	$("#achatech").val("");
}

function refreshProd() {
	
    $.ajax({
      type: "GET", 
      url: "getcall/printprodlot.getcall.php",
      data: "lotID="+lotID,
      success: function(response){
        $("#prod-lot").html(response);
      }
    });

}

function addProd() {
	if (isValidForm()) {
	    $.ajax({
	      type: "POST", 
	      url: "postcall/addprod2lot.postcall.php",
	      data: "code="+$("#code").val()+
	      "&type="+ $("#type").val()+
	      "&titre="+ $("#titre").val()+
	      "&type="+ $("#type").val()+
	      "&auteur="+$("#auteur").val()+
	      "&editeur="+$("#editeur").val()+
	      "&prixesp="+$("#achatesp").val()+
	      "&prixech="+$("#achatech").val()+
	      "&vente="+ $("#vente").val()+
	      "&lotID="+lotID,
	      success: function(response){
	      	refreshProd(lotID);
	      	emptyAll();
	      	$("#code").focus();
	      } 
	    });
	}
}

function deleteProd(prodID) {

    $.ajax({
      type: "POST", 
      url: "postcall/delprod2lot.postcall.php",
      data: "prodID="+prodID,
      success: function(response){
      	refreshProd(lotID);
      } 
    });

}

function isValidForm() {

	var response = false;
	
	if($("#vente").val() == ""){
		$("#vente").focus();
		alert("Prix de vente manquant !");
	}
	else if ($("#achatech").val() == "") {
		$("#achatech").focus();
		alert("Valeur echange manquante !");
	}
	else if ($("#achatesp").val() == "") {
		$("#achatesp").focus();
		alert("Valeur espèces manquant !");
	}
	else if ($("#code").val() == "") {
		$("#code").focus();
		alert("Code barre manquant !");
	}
	else if($("#code").val().match(/^[0-9]+$/) == null) {
		$("#code").focus();
		alert("Code barre mal formaté !");
	}
	else if ($("#titre").val() == "") {
		$("#titre").focus();
		alert("Titre manquant !");
	}
	else if(isNaN($("#vente").val())){
		$("#vente").focus();
		alert("Valeur vente erronée !");	
	}
	else if(isNaN($("#achatesp").val())){
		$("#achatesp").focus();
		alert("Valeur espèces erronée !");	
	}
	else if(isNaN($("#achatech").val())){
		$("#achatech").focus();
		alert("Valeur echange erronée !");	
	}
	else{
		response = true;
	}

	return response;

}

function calcul() {

	if (!isNaN($("#vente").val())) {
		var vente = $("#vente").val();
		var esp = (vente*0.8)/2;
		var ech = esp*1.4;

		$("#achatesp").val(esp.toFixed(2));
		$("#achatech").val(ech.toFixed(2));
	}

}

function validLot() {

	if (validateFinalInputs()) {
	    $.ajax({
	      type: "GET", 
	      url: "getcall/validlot.getcall.php",
	      data: "lotID="+lotID+
	      "&vente="+$("#venteFinal").val()+
	      "&achatesp="+$("#achatespFinal").val()+
	      "&achatech="+$("#achatechFinal").val(),
	      success: function(response){
	      	document.location.href = "/acheteur.php";
	      }
	    });
	}
}

function validateFinalInputs() {

	var result = false;

	if(isNaN($("#venteFinal").val())){
		$("#venteFinal").focus();
		alert("Valeur vente erronée !");	
	}
	else if(isNaN($("#achatespFinal").val())){
		$("#achatespFinal").focus();
		alert("Valeur espèces erronée !");	
	}
	else if(isNaN($("#achatechFinal").val())){
		$("#achatechFinal").focus();
		alert("Valeur echange erronée !");	
	}
	else{
		result = true;
	}

	return result;
}

refreshLots();