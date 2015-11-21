var timerSearch;

$(document).ready(function(){

	$('#searcher-input').keyup(function(event) {
      clearTimeout(timerSearch);
      timerSearch = setTimeout("search()", 1000);
	});

});

function search(){

  if($("#searcher-input").val().length > 1){

    $("#searcher-results").html('<center><img src="images/design/loading.gif"></center>');

    $.ajax({
      type: "GET", 
      url: "getcall/search.getcall.php",
      data: "keyword="+$("#searcher-input").val(),
      success: function(response){
          $("#searcher-results").html(response);
      } 
    });

  }

}

function buildTransacModal(id, magasin) {
  
    $.ajax({
      type: "POST", 
      url: "postcall/buildtransacinfo.postcall.php",
      data: "id="+id+"&magasin="+magasin,
      success: function(response){
          $("#modal-content").html(response);
          $("#modal-title").html("Détails de la transaction " + id + " sur " + magasin);
          $("#modal-confirm").html("<a href=\"#\" data-dismiss=\"modal\"><button class=\"btn\">Fermer</button></a>");
      }
    });

}

function buildProduitsModal(code) {

    $.ajax({
      type: "POST", 
      url: "postcall/buildproduitinfo.postcall.php",
      data: "code="+code,
      success: function(response){
          $("#modal-content").html(response);
          $("#modal-title").html("Modifier les informations d'un produit");
          $("#modal-confirm").html("<a href=\"#\" onclick=\"confirmChangesProduit(); return false;\"><button class=\"btn btn-primary\">Enregistrer les changements</button></a>");
      }
    });

}

function confirmChangesProduit(){
    
    $.ajax({
      type: "POST", 
      url: "postcall/confirmproduitinfo.postcall.php",
      data: "code="+$("#code-input").val()+"&titre="+$("#titre-input").val()+"&auteur="+$("#auteur-input").val()+"&editeur="+$("#editeur-input").val()+"&edition="+$("#edition-input").val()+"&type="+$("#type-input").val(),
      success: function(response){

        $('#modal').modal('hide');
        
      }
    });

}