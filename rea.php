<?php

  require_once(__DIR__ . "/autoload/session.autoload.php");
  require_once(__DIR__ . "/autoload/checkconnected.autoload.php");
  require_once(__DIR__ . "/class/Network.class.php");
  require_once(__DIR__ . "/class/Reassort.class.php");
  require_once(__DIR__ . "/autoload/produitType.autoload.php");

  if(!isset($_GET['date']) || !isset($_GET['magasin'])){header("location:/");}

  $Reassort = new Reassort();

?>

<!DOCTYPE html>
<html>
<head>
  <?php require_once(__DIR__ . "/template/headcode.template.php"); ?>
</head>
<body>

    <?php include(__DIR__ . "/template/header.template.php"); ?>

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
                echo '<td><a href="http://services.librairielabourse.fr/reports/product?date=' . $_GET['date'] . '&magasin=' . htmlspecialchars($_GET['magasin']) . '&rea=REASSORTI&type=' . $value . '" target="_blank"><button class="btn">Consulter les REASSORTIS</button></a></td>';
                echo '<td><a href="http://services.librairielabourse.fr/reports/product?date=' . $_GET['date'] . '&magasin=' . htmlspecialchars($_GET['magasin']) . '&rea=NON_REASSORTI&type=' . $value . '" target="_blank"><button class="btn">Consulter les NON REASSORTIS</button></a></td>';
                echo '</tr>';

              }

              echo '    </tbody>

                      </table>

               </div>';

            ?>

          </div>

          <?php include(__DIR__ . "/template/network.template.php"); ?>

        </div>

      </div>
    </div>

    <?php include(__DIR__ . "/template/footer.template.php"); ?>

</body>
</html> 