<?php

  require_once(__DIR__ . "/autoload/session.autoload.php");
  require_once(__DIR__ . "/autoload/checkconnected.autoload.php");
  require_once(__DIR__ . "/class/Network.class.php");
  require_once(__DIR__ . "/class/Reassort.class.php");

  if(!isset($_GET['date']) || !isset($_GET['magasin']) || !isset($_GET['type'])){header("location:/");}

  $Reassort = new Reassort();

?>

<!DOCTYPE html>
<html>
<head>
  <?php require_once(__DIR__ . "/template/headcode.template.php"); ?>

  <script type="text/javascript">
    window.print();
  </script>

</head>
<body>

    <div class="container sub-body">
      <div class="controls">

        <div class="row-fluid">
          <div class="span12 well">

            <legend>
              Fiche Réassort Imprimable du <?php echo $_GET['date']; ?> sur <?php echo $_GET['magasin'] ?> pour <?php echo $_GET['type'] ?>
            </legend>

            <?php

                $Reassort->setMagasin($_GET['magasin']);
                $Reassort->setType($_GET['type']);
                $Reassort->setDate($_GET['date']);

                $rows = $Reassort->getReaList();

                echo '<h4>Réassortis</h4>';

                echo '                      
                <table class="table table-striped table-bordered very-small-text">
                                            <thead>
                                              <tr>
                                                <th>Heure</th>
                                                <th>Prix</th>
                                                <th>EAN / ISBN</th>
                                                <th>Titre</th>
                                                <th>Auteur</th>
                                                <th>Editeur</th>
                                                <th>Edition</th>
                                              </tr>
                                            </thead>
                                            <tbody>';

                foreach ($rows as $key => $value) {

                    $Reassort->setIdProd($value['id_table']);
                    $Reassort->findReaStat();

                    echo '<tr>';
                      echo '<td>' . $value['heure'] . '</td>';
                      echo '<td>' . $value['prix'] . '</td>';
                      echo '<td class="' . $value['code'] . '">' .  substr($value['code'],0,17) . '</td>';
                      echo '<td>' .  $value['titre'] . '</td>';
                      echo '<td>' .  $value['auteur'] . '</td>';
                      echo '<td>' .  $value['editeur'] . '</td>';
                      echo '<td>' .  $value['edition'] . '</td>';

                    echo '</tr>';

                    echo '<script>$(".' . $value['code'] . '").barcode("' . $value['code'] . '", "code128", {barWidth:1, barHeight:15})</script>';

                }

              echo '    </tbody>

                      </table>';



                $rows = $Reassort->getNoReaList();

                echo '<h4 class="margin-top-1">Non Réassortis</h4>';

                echo '                      
                <table class="table table-striped table-bordered very-small-text">
                                            <thead>
                                              <tr>
                                                <th>Heure</th>
                                                <th>Prix</th>
                                                <th>EAN / ISBN</th>
                                                <th>Titre</th>
                                                <th>Auteur</th>
                                                <th>Editeur</th>
                                              </tr>
                                            </thead>
                                            <tbody>';

                foreach ($rows as $key => $value) {

                    $Reassort->setIdProd($value['id_table']);
                    $Reassort->findReaStat();

                    echo '<tr>';
                      echo '<td>' . $value['heure'] . '</td>';
                      echo '<td>' . $value['prix'] . '</td>';
                      echo '<td class="' . $value['code'] . '">' .  substr($value['code'],0,17) . '</td>';
                      echo '<td>' .  $value['titre'] . '</td>';
                      echo '<td>' .  $value['auteur'] . '</td>';
                      echo '<td>' .  $value['editeur'] . '</td>';
                      echo '<td>' .  $value['edition'] . '</td>';
                    echo '</tr>';

                    echo '<script>$(".' . $value['code'] . '").barcode("' . $value['code'] . '", "code128", {barWidth:1, barHeight:15})</script>';

                }

              echo '    </tbody>

                      </table>';

            ?>

          </div>

        </div>

      </div>
    </div>

</body>
</html> 