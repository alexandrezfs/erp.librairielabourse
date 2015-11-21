<?php

  require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/session.autoload.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/checkconnected-admin.autoload.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/class/User.class.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Concurrence.class.php");

  $User = new User();

?>

<!DOCTYPE html>
<html>
<head>
  <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/template/headcode.template.php"); ?>
<body>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/header.template.php"); ?>

    <div class="container sub-body">
      <div class="controls text-align-center margin-top-1">

        <?php
          if(isset($_GET['event'])){
            if($_GET['event'] == 'error'){
              echo '<div class="alert alert-error">Erreur d\'envoi, vérifiez que votre image en est bien une et qu\'elle fait moins de 8 Mo.</div>';
            }
            else if($_GET['event'] == 'added'){
              echo '<div class="alert alert-success">Pattern ajouté !</div>';
            }
            else if($_GET['event'] == 'deleted'){
              echo '<div class="alert alert-success">Pattern supprimé !</div>';
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

                <legend>Ajouter un pattern marché</legend>

                <form name="form" action="postcall/ajouter-concur-pattern.postcall.php" method="POST" enctype="multipart/form-data">
                  <p>Titre du site</p>
                  <input type="text" name="titreSite" id="titreSite">
                  <p>Pattern avant le mot clé</p>
                  <input type="text" name="beforePattern" class="full-middle-width" id="beforePattern">
                  <p>Pattern après le mot clé</p>
                  <input type="text" name="afterPattern" class="full-middle-width" id="afterPattern">
                  <div class="mod-file">
                    <p>Image représentant le site</p>
                    <input type="file" name="file">
                  </div>
                  <a href="#" onclick="verifFields(); return false;"><button class="btn btn-primary">Valider</button></a>
                </form>  

                <legend class="margin-top-2">Liste des patterns</legend>

                <table class="table table-bordered small-text">
                  <?php

                    $Concurrence = new Concurrence();
                    $patterns = $Concurrence->getPatterns();

                    foreach ($patterns as $key => $value) {
                      echo '
                      <tr>
                        <td><img src="http://' . $value['image'] . '" class="max-height-1"></td>
                        <td>' . $value['titre'] . '</td>
                        <td>' . $value['before_pattern'] . ' %KEYWORD% ' . $value['after_pattern'] . '</td>
                        <td><a href="getcall/deletepattern.getcall.php?id=' . $value['id'] . '" onclick="return confirm(\'Vous-vous vraiment supprimer ce pattern ?\')">Supprimer</a></td>
                      </tr>
                      ';
                    }

                  ?>
                </table>

            </div>

          </div>
        </div>

      </div>
    </div>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/footer.template.php"); ?>

</body>
</html> 