<?php

  require_once(__DIR__ . "/autoload/session.autoload.php");
  require_once(__DIR__ . "/autoload/checkconnected.autoload.php");
  require_once(__DIR__ . "/class/Network.class.php");
  require_once(__DIR__ . "/class/User.class.php");

  $User = new User();
  $Network = new Network();

  $User->checkConnected();
  $User->rememberMe();

?>

<!DOCTYPE html>
<html>
<head>
  <?php require_once(__DIR__ . "/template/headcode.template.php"); ?>

  <?php $Network->callSmallNetwork(); ?>

</head>
<body>

    <?php include(__DIR__ . "/template/header.template.php"); ?>

    <div class="container sub-body">
      <div class="controls margin-top-1">

        <div class="row-fluid">
          <div class="span9 well text-align-center big-text">
            <legend>Bienvenue, <?php echo $_SESSION['username'] ?> !</legend>

            <div class="row-fluid">

                <div class="span4">
                  <a href="searcher.php" class="no-link-deco">
                    <img src="images/design/searcher.png">
                    <br>
                    Searcher
                  </a>
                </div>

                <div class="span4">
                  <a href="viewer.php" class="no-link-deco">
                    <img src="images/design/viewer.png">
                    <br>
                    Viewer
                  </a>
                </div>

                <div class="span4">
                  <a href="acheteur.php" class="no-link-deco">
                    <img src="images/design/acheteur.png">
                    <br>
                    Acheteur
                  </a>
                </div>

            </div>

            <div class="row-fluid margin-top-2">

                <div class="span4">
                  <a href="network.php" class="no-link-deco">
                    <img src="images/design/network.png">
                    <br>
                    Etat du réseau
                  </a>
                </div>

                <div class="span4">
                  <a href="documents.php" class="no-link-deco">
                    <img src="images/design/documents.png">
                    <br>
                    Documents
                  </a>
                </div>

                <div class="span4">
                  <a href="disconnect.php" class="no-link-deco">
                    <img src="images/design/disconnect.png">
                    <br>
                    Disconnect
                  </a>
                </div>

            </div>

            <div class="row-fluid margin-top-2">

                <div class="span4">
                  <a href="stats.php" class="no-link-deco">
                    <img src="images/design/stats.png">
                    <br>
                    Statistiques
                  </a>
                </div>

            </div>

          </div>

          <?php include(__DIR__ . "/template/network.template.php"); ?>

        </div>

      </div>
    </div>

    <?php include(__DIR__ . "/template/footer.template.php"); ?>

</body>
</html> 