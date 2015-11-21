<?php

  require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/session.autoload.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/checkconnected.autoload.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Network.class.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Reassort.class.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/produitType.autoload.php");

  if(!isset($_GET['date']) || !isset($_GET['magasin'])){header("location:/");}

  $Reassort = new Reassort();

?>

<!DOCTYPE html>
<html>
<head>
  <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/template/headcode.template.php"); ?>
</head>
<body>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/header.template.php"); ?>

    <div class="container sub-body">
      <div class="controls margin-top-1">

        <div class="row-fluid">
          <div class="span9 well">

            <legend>Fiche Réassort du <?php echo $_GET['date']; ?> sur <?php echo $_GET['magasin'] ?></legend>

            <?php

              echo '<div class="item-type-reassort">
                      <table class="table table-striped table-bordered">
                                            <thead>
                                              <tr>
                                                <th>type</th>
                                                <th>Pourcentage</th>
                                                <th>#</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                    ';

              $types = getProduitsTypes();

              foreach ($types as $key => $value) {

                $Reassort->setType($value);
                $Reassort->setMagasin($_GET['magasin']);
                $Reassort->setDate($_GET['date']);

                echo '<tr>';
                  echo '<td>' . $value . '</td>';
                  echo '<td>' .  $Reassort->getReaPercent() . ' %</td>';
                  echo '<td><a href="rea-details.php?date=' . $_GET['date'] . '&magasin=' . $_GET['magasin'] . '&type=' . $value . '"><button class="btn">Consulter</button></a></td>';
                echo '</tr>';

              }

              echo '    </tbody>

                      </table>

               </div>';

            ?>

          </div>

          <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/network.template.php"); ?>

        </div>

      </div>
    </div>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/footer.template.php"); ?>

</body>
</html> 