<?php

  require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/session.autoload.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/checkconnected.autoload.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Network.class.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Reassort.class.php");

  if(!isset($_GET['date']) || !isset($_GET['magasin']) || !isset($_GET['type'])){header("location:/");}

  $Reassort = new Reassort();

?>

<!DOCTYPE html>
<html>
<head>
  <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/template/headcode.template.php"); ?>

  <style type="text/css" media="print">
    @page { size: landscape; }
  </style>

</head>
<body>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/header.template.php"); ?>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/modal.template.php"); ?>

    <div class="container sub-body">
      <div class="controls margin-top-1">

        <div class="row-fluid">
          <div class="span9 well">

            <legend>
              Fiche Réassort Détaillée du <?php echo $_GET['date']; ?> sur <?php echo $_GET['magasin'] ?> pour <?php echo $_GET['type'] ?>
            
              <a href="rea-details-printable.php?date=<?php echo $_GET['date']; ?>&magasin=<?php echo $_GET['magasin'] ?>&type=<?php echo $_GET['type'] ?>">
                <button class="btn pull-right">Version imprimable</button>
              </a>

            </legend>

            <div style="clear:both;"></div>

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
                                                <th>Restant</th>
                                                <th>Pris</th>
                                                <th>#</th>
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
                      echo '
                      <td>
                        <select class="small-input" id="restant-input-' . $value['id_table'] . '" onchange="updateFait(' . $value['id_table'] . ');">';

                          echo '<option value="null">?</option>';

                          for ($i=0; $i < 21; $i++) { 
                            if($Reassort->getRestant() == $i){
                              echo '<option value="' . $i . '" SELECTED>' . $i . '</option>';
                            }
                            else{
                              echo '<option value="' . $i . '">' . $i . '</option>';
                            }
                          }

                        echo '
                        </select>
                      </td>';

                      echo '<td>';

                        if($Reassort->getPris() == 'true'){
                         echo '<input type="checkbox" id="pris-input-' . $value['id_table'] . '" onclick="updateFait(' . $value['id_table'] . ');" checked>';
                        }
                        else{
                         echo '<input type="checkbox" id="pris-input-' . $value['id_table'] . '" onclick="updateFait(' . $value['id_table'] . ');">';
                        }

                      echo '</td>';

                      echo '
                      <td>
                        <a href="#modal" role="button" class="btn" data-toggle="modal" onclick="buildProduitsModal(\'' . $value['code'] . '\'); return false;">Corriger</a>
                      </td>';

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
                                                <th>Edition</th>
                                                <th>Restant</th>
                                                <th>Pris</th>
                                                <th>#</th>
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
                      echo '
                      <td>
                        <select class="small-input" id="restant-input-' . $value['id_table'] . '" onchange="updateFait(' . $value['id_table'] . ');">';

                          echo '<option value="null">?</option>';

                          for ($i=0; $i < 21; $i++) { 
                            if($Reassort->getRestant() == $i){
                              echo '<option value="' . $i . '" SELECTED>' . $i . '</option>';
                            }
                            else{
                              echo '<option value="' . $i . '">' . $i . '</option>';
                            }
                          }

                        echo '
                        </select>
                      </td>';

                      echo '<td>';

                        if($Reassort->getPris() == 'true'){
                         echo '<input type="checkbox" id="pris-input-' . $value['id_table'] . '" onclick="updateFait(' . $value['id_table'] . ');" checked>';
                        }
                        else{
                         echo '<input type="checkbox" id="pris-input-' . $value['id_table'] . '" onclick="updateFait(' . $value['id_table'] . ');">';
                        }

                      echo '</td>';

                      echo '
                      <td>
                        <a href="#modal" role="button" class="btn" data-toggle="modal" onclick="buildProduitsModal(\'' . $value['code'] . '\'); return false;">Corriger</a>
                      </td>';

                    echo '</tr>';

                    echo '<script>$(".' . $value['code'] . '").barcode("' . $value['code'] . '", "code128", {barWidth:1, barHeight:15})</script>';

                }

              echo '    </tbody>

                      </table>';

            ?>

          </div>

          <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/network.template.php"); ?>

        </div>

      </div>
    </div>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/footer.template.php"); ?>

</body>
</html> 