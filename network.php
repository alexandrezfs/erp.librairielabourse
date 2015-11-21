<?php

  require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/session.autoload.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/checkconnected.autoload.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Network.class.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/class/User.class.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Magasin.class.php");

  $Magasin = new Magasin();

  $magasins = $Magasin->getMagasins();

?>

<!DOCTYPE html>
<html>
<head>
  <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/template/headcode.template.php"); ?>
</head>
<body>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/header.template.php"); ?>

    <div class="container sub-body">
      <div class="controls text-align-center margin-top-1">

        <div class="row-fluid">
          <div class="span9 well">
            
            <legend>Etat du réseau</legend>

            <?php

            echo '<table class="margin-top-1 table table-bordered">';

              echo '<tr>';

                foreach ($magasins as $key => $magasin) {

                    $Magasin->setNom($magasin['localisation']);

                        if($Magasin->isAlive()){
                          echo '
                          <td>
                            <center>'
                               . $magasin['localisation'] . 
                               '<br><img src="images/design/network.gif">
                             </center>
                           </td>';
                        }
                        else{
                          echo '
                          <td>
                            <center>' . $magasin['localisation'] . '
                            <br><img src="images/design/warning.png">
                            </center>
                          </td>';
                        }
                }

              echo '</tr>';

            echo '</table>';

            ?>

            <div class="margin-top-1">
              <strong>Etat du réseau du serveur de LA BOURSE</strong>
              <br>
              <img src="http://weathermap.ovh.net/schemes/weathermap_europe.png?1365854360487">
            </div>

          </div>

          <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/network.template.php"); ?>

        </div>

      </div>
    </div>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/footer.template.php"); ?>

</body>
</html> 