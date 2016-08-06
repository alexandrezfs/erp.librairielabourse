<?php

  require_once(__DIR__ . "/autoload/session.autoload.php");
  require_once(__DIR__ . "/autoload/checkconnected.autoload.php");
  require_once(__DIR__ . "/class/Network.class.php");
  require_once(__DIR__ . "/class/User.class.php");
  require_once(__DIR__ . "/class/Magasin.class.php");

  $Magasin = new Magasin();

  $magasins = $Magasin->getMagasins();

?>

<!DOCTYPE html>
<html>
<head>
  <?php require_once(__DIR__ . "/template/headcode.template.php"); ?>
</head>
<body>

    <?php include(__DIR__ . "/template/header.template.php"); ?>

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

          <?php include(__DIR__ . "/template/network.template.php"); ?>

        </div>

      </div>
    </div>

    <?php include(__DIR__ . "/template/footer.template.php"); ?>

</body>
</html> 