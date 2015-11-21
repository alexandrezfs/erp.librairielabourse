<?php

  require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/session.autoload.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/class/User.class.php");

  $User = new User();

  $User->autoConnec();

?>

<!DOCTYPE html>
<html>
<head>
  <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/template/headcode.template.php"); ?>
</head>
<body>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/header.template.php"); ?>

    <div class="container sub-body">
      <div class="controls text-align-center margin-top-1 big-text">

        <?php
          if(isset($_GET['event'])){
            if($_GET['event'] == 'connec'){
              echo '<div class="alert alert-error">Utilisateur invalide !</div>';
            }
          }
        ?>

        <div class="row-fluid">
          <div class="span12 well">
            <legend>Bienvenue sur la plateforme du B.I.S</legend>
            <div>
              <img src="images/design/bis_logo.png">
            </div>
            <div class="row-fluid margin-top-2">
                <p>Identification</p>
                <form action="postcall/login.postcall.php" method="POST">
                    <input type="text" name="username" placeholder="Nom d'utilisateur">
                    <br>
                    <input type="password" name="password" placeholder="Mot de passe">
                    <br>
                    <input type="submit" class="btn">
                </form>
            </div>
          </div>
        </div>

      </div>
    </div>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/footer.template.php"); ?>

</body>
</html> 