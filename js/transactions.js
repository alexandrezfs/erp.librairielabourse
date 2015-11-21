function buildDetailledTransacModal(id, magasin, date){
  
    $.ajax({
      type: "POST", 
      url: "postcall/buildtransdetailsacinfo.postcall.php",
      data: "id="+id+"&magasin="+magasin+"&date="+date,
      success: function(response){
          $("#modal-content").html(response);
          $("#modal-title").html("Détails de la transaction " + id + " sur " + magasin);
          $("#modal-confirm").html("<a href=\"#\" data-dismiss=\"modal\"><button class=\"btn\">Fermer</button></a>");
      }
    });

}

function buildDetailledTransacContainers() {
  $(".hidden-details").toggle();
  $(".show-nodetails").toggle();
}