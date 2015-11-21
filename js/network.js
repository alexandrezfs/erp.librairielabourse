var username;

$(document).ready(function() {

  username = $("#username-network").val();

	$('#message-network').keydown(function(event) {
	  if(event.which == 13){
	  	addMsg();
	  }
	});

  printMsg();
  listenMessages();

});

function openSmallNetwork() {
    window.open("small-network.php","Network","menubar=no, status=no, scrollbars=no, menubar=no, resizable=no, width=300, height=670");
}

function addMsg () {

 console.log("SEND A MESSAGE !!");
	
 var message = $("#message-network").val();

 if (message.length > 0) {
   socket.emit('send-message', { author : username, message : message });

   $("#message-network").val("");
 };

}

function printMsg() {
  
  socket.emit('get-messages', function(data){
    console.log("ASK FOR MESSAGES");
  });

}

function htmlspecialchars(str) {

  return str.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;");

}

function listenMessages() {

    socket.on('messages', function(data){

      $("#network-messages").html("");

      for (var i = 0; i < data.length; i++) {
        $("#network-messages").append("<strong>" + data[i].author + " (" + data[i].datetime + ")</strong><br>" + htmlspecialchars(data[i].message) + "<br>");
      };
    });

    socket.on('message', function(data){

      var keepHtml = $("#network-messages").html();
      $("#network-messages").html("");
      $("#network-messages").html("<strong>" + data.author + " (" + data.datetime + ")</strong><br>" + htmlspecialchars(data.message) + "<br>" + keepHtml);
    });

    socket.on('produit-a-monter', function(data){
      var keepHtml = $("#network-messages").html();
      console.log(data);
      $("#network-messages").html("");
      $("#network-messages").html("<strong>" + data.author + " (" + data.datetime + ")</strong><br><div style=\"background-color:yellow;color:blue;padding:5px;\"><big>Produit demandé !</big><br>Code barre > " + htmlspecialchars(data.produit.code) +  "<br>Titre > " + htmlspecialchars(data.produit.titre) + "<br>Auteur > " + htmlspecialchars(data.produit.auteur) + "<br>Editeur > " + htmlspecialchars(data.produit.editeur) + "</div><br>" + keepHtml); 
    });

}