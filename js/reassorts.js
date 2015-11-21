function updateFait (id) {

	var restant = $("#restant-input-"+id).val();
	var pris = $("#pris-input-"+id).is(':checked');

    $.ajax({
      type: "POST", 
      url: "postcall/updatereafait.postcall.php",
      data: "id="+id+"&restant="+restant+"&pris="+pris,
      success: function(response){
  		
      }
    });

}