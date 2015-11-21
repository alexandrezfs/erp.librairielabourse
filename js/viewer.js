function actualize () {
	
    $.ajax({
      type: "POST", 
      url: "postcall/viewer.postcall.php",
      data: "data=1",
      success: function(response){
          $("#viewer-container").html(response);
          setTimeout("actualize()", 60000);
      } 
    });
}

actualize();