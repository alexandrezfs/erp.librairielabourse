<?php

  require_once(__DIR__ . "/autoload/session.autoload.php");
  require_once(__DIR__ . "/autoload/checkconnected-admin.autoload.php");
  require_once(__DIR__ . "/class/Module.class.php");
  require_once(__DIR__ . "/class/EmailAlert.class.php");

  $EmailAlert = new EmailAlert();

?>

<!DOCTYPE html>
<html>
<head>
  <?php require_once(__DIR__ . "/template/headcode.template.php"); ?>

  <script type="text/javascript" src="js/alert.admin.js"></script>
<body>

    <?php include(__DIR__ . "/template/header.template.php"); ?>

    <div class="container sub-body">
      <div class="controls text-align-center margin-top-1 big-text">

      	<?php
      		if(isset($_GET['event'])){
      			if($_GET['event'] == 'added'){
      				echo '<div class="alert alert-success">Adresse ajoutée !</div>';
      			}
      			else if($_GET['event'] == 'deleted'){
      				echo '<div class="alert alert-success">Adresse supprimée !</div>';
      			}
      		}
      	?>

        <div class="row-fluid">
          <div class="span12 well">
            <legend>B.I.S ADMIN CONTROL PANEL</legend>
            <div>
              <img src="images/design/bis_logo.png">
            </div>

            <div class="row-fluid margin-top-2">
              <legend>Ajouter une adresse e-mail</legend>	
              	<input type="text" name="email" id="input-alert-email" placeholder="adresse e-mail">
              	<br>
              	<input type="button" class="btn" id="submit-alert-email" value="Valider">
            </div>

            <div class="row-fluid margin-top-2">
              
              <legend>Liste des adresses d'alerte</legend>

              <table class="table table-striped">
	              <thead>
	                <tr>
	                  <th>E-mail</th>
                    <th>#</th>
	                </tr>
	              </thead>

			           <tbody>
              
  		              <?php
  		              	
                      $emails = $EmailAlert->getEmails();

  		              	foreach ($emails as $key => $value) {
  		              		echo '
  				                <tr>
  				                  <td>' . $value . '</td>
  				                  <td><a href="getcall/delalertmail.getcall.php?email=' . $value. '" onclick="return confirm(\'Supprimer cette adresse ?\');">Supprimer</a></td>
  				                </tr>
  				            ';
  		              	}

  		              ?>

               		</tbody>

            	</table>

            </div>

          </div>
        </div>

      </div>
    </div>

    <?php include(__DIR__ . "/template/footer.template.php"); ?>

</body>
</html> 