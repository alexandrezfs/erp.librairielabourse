$(document).ready(function(){

	$('#new-tache').keydown(function(event) {
	  if(event.which == 13){
	  	addTache();
	  }
	});

	printTaches();
  alertTache();

});

function alertTache () {
  
  $.ajax({
    type: "POST", 
    url: "postcall/alerttache.postcall.php", 
    data: "call=1",
    success: function(response){
      $("#alert-tache").html(response);
    } 
  });

  setTimeout("alertTache()", 7000);

}

function toggleTache (id) {
  
  $.ajax({
    type: "POST", 
    url: "postcall/toggletache.postcall.php", 
    data: "id="+id,
    success: function(response){
      printTaches();
    } 
  });

}

function addTache () {
	
  $.ajax({
    type: "POST", 
    url: "postcall/addtache.postcall.php", 
    data: "description="+$("#new-tache").val(),
    success: function(response){
    	printTaches();
    	$("#new-tache").val("");
    } 
  });

}

function printTaches () {

  $.ajax({
    type: "POST", 
    url: "postcall/gettaches.postcall.php", 
    data: "call=1",
    success: function(response){
        $("#taches-table").html(response);
    } 
  });

  setTimeout("printTaches()", 4000);

}