<?php

  require_once(__DIR__ . "/autoload/session.autoload.php");
  require_once(__DIR__ . "/autoload/checkconnected.autoload.php");
  require_once(__DIR__ . "/class/Network.class.php");
  require_once(__DIR__ . "/class/Transaction.class.php");
  require_once(__DIR__ . "/autoload/produitType.autoload.php");

?>

<!DOCTYPE html>
<html>
<head>
  <title>Bourse ERP X1</title>

  <meta charset="utf-8">

  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet"  type="text/css" href="bootstrap/css/bootstrap-responsive.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">

  <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
  <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
  <script type="text/javascript" src="js/network.js"></script>
  <script type="text/javascript" src="js/transactions.js"></script>

  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
  
</head>
<body>

    <?php include(__DIR__ . "/template/header.template.php"); ?>

    <?php include(__DIR__ . "/template/modal.template.php"); ?>

    <div class="container sub-body">
      <div class="controls margin-top-1 small-text">

        <div class="row-fluid">
          <div class="span12" id="container-fichecompta">

              <div class="loading-big">
                <img src="images/design/loading-big.gif">
                <br><br>
                <p>Le calcul de la fiche comptable peut prendre du temps, veuillez patienter...</p>
              </div>

              <script type="text/javascript">
                $.ajax({
                  type: "GET", 
                  url: "postcall/buildfichecompta.postcall.php",
                  data: "magasin=<?php echo $_GET['magasin'] ?>&date=<?php echo $_GET['date'] ?>",
                  success: function(response){
                      $("#container-fichecompta").html(response);
                  }
                });
              </script>

          </div>

        </div>

      </div>
    </div>

    <?php include(__DIR__ . "/template/footer.template.php"); ?>

</body>
</html> 