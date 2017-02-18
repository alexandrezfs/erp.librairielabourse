<?php

  require_once(__DIR__ . "/../autoload/session.autoload.php");
  require_once(__DIR__ . "/../autoload/checkconnected.autoload.php");
  require_once(__DIR__ . "/../class/Network.class.php");
  require_once(__DIR__ . "/../class/Transaction.class.php");
  require_once(__DIR__ . "/../autoload/produitType.autoload.php");

  if(!isset($_GET['date']) || !isset($_GET['magasin'])){header("location:/");}

  $Transaction = new Transaction();

  $Transaction->setDate($_GET['date']);
  $Transaction->setMagasin($_GET['magasin']);

  $global = $Transaction->getGlobalWithDATE();

?>

           <legend>Fiche Comptable du <?php echo $_GET['date']; ?> sur <?php echo $_GET['magasin'] ?></legend>

            <h3>Chiffre d'affaires : <?php echo $global['chiffre_journee'] ?> €</h3>

            <?php

              $transactions = $Transaction->getTransactionsWithDATE();

              echo '<div class="item-type-reassort">
                      <table class="table table-bordered small-text">
                                            <thead>
                                              <tr class="show-nodetails">
                                                <th>#</th>
                                                <th>Heure</th>
                                                <th>Bon cadeau</th>
                                                <th>Avoir</th>
                                                <th>Avoir UTIL</th>
                                                <th>Echange</th>
                                                <th>Echange UTIL</th>
                                                <th>Av+Ech converti</th>
                                                <th>Remise</th>
                                                <th>Ech-D</th>
                                                <th>Esp</th>
                                                <th>CB</th>
                                                <th>Chèque</th>
                                                <th>Esp émis</th>
                                                <th>Avoir émis</th>
                                                <th>Total achat</th>
                                                <th>Total vente</th>
                                                <th>Produits</th>
                                                <th>#</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                    ';

              foreach ($transactions as $key => $value) {

                $Transaction->setNoTransaction($value['no_transaction']);

                echo '
                  <tr class="hidden-details">
                    <th>#</th>
                    <th>Heure</th>
                    <th>Bon cadeau</th>
                    <th>Avoir</th>
                    <th>Avoir UTIL</th>
                    <th>Echange</th>
                    <th>Echange UTIL</th>
                    <th>Av+Ech converti</th>
                    <th>Remise</th>
                    <th>Ech-D</th>
                    <th>Esp</th>
                    <th>CB</th>
                    <th>Chèque</th>
                    <th>Esp émis</th>
                    <th>Avoir émis</th>
                    <th>Total achat</th>
                    <th>Total vente</th>
                    <th>Produits</th>
                    <th>#</th>
                  </tr>
                ';

                echo '<tr>';
                  echo '<td>' . $value['no_transaction'] . '</td>';
                  echo '<td>' . $value['heure'] . '</td>';
                  echo '<td>' . $value['bon_cadeau'] . '</td>';
                  echo '<td>' . $value['avoir'] . '</td>';
                  echo '<td>' . $value['avoir_util'] . '</td>';
                  echo '<td>' . $value['echange'] . '</td>';
                  echo '<td>' . $value['echange_util'] . '</td>';
                  echo '<td>' . $value['avoir_echange_converti'] . '</td>';
                  echo '<td>' . $value['remise'] . '</td>';
                  echo '<td>' . $value['echange_direct'] . '</td>';
                  echo '<td>' . $value['esp_reel'] . '</td>';
                  echo '<td>' . $value['cb'] . '</td>';
                  echo '<td>' . $value['cheque'] . '</td>';
                  echo '<td>' . $value['esp_reel_emis'] . '</td>';
                  echo '<td>' . $value['avoir_emis'] . '</td>';
                  echo '<td>' . $value['total_achats'] . '</td>';
                  echo '<td>' . $value['total_ventes'] . '</td>';
                  echo '<td>' . $value['nb_produits'] . '</td>';
                  echo '<td><a href="#modal" role="button" data-toggle="modal" onclick="buildDetailledTransacModal(' . $value['no_transaction'] . ', \'' . $value['magasin'] . '\', \'' . $value['date'] . '\'); return false;">Détails</a></td>';
                echo '</tr>';

                echo '<tr class="hidden-details no-border">';
                 echo '<td colspan="19" class="no-border">' . $Transaction->getPrintedDetailledContainer() . '</td>';
                echo '</tr>';

                echo '<tr class="hidden-details no-border">';
                 echo '<td colspan="19" class="space-details no-border"></td>';
                echo '</tr>';

                $bon_cadeau += $value['bon_cadeau'];
                $avoir += $value['avoir'];
                $avoir_util += $value['avoir_util'];
                $echange += $value['echange'];
                $echange_util += $value['echange_util'];
                $avoir_echange_converti += $value['avoir_echange_converti'];
                $remise += $value['remise'];
                $echange_direct += $value['echange_direct'];
                $cb += $value['cb'];
                $cheque += $value['cheque'];
                $esp_emis += $value['esp_reel_emis'];
                $avoir_emis += $value['avoir_emis'];
                $esp_reel += $value['esp_reel'];
                $total_achats += $value['total_achats'];
                $total_ventes += $value['total_ventes'];
                $nb_produits += $value['nb_produits'];

              }

                echo '<tr class="bold">';
                  echo '<td>TOTAUX</td>';
                  echo '<td>#</td>';
                  echo '<td>' . number_format($bon_cadeau, 2, '.', ' ') . '</td>';
                  echo '<td>' . number_format($avoir, 2, '.', ' ') . '</td>';
                  echo '<td>' . number_format($avoir_util, 2, '.', ' ') . '</td>';
                  echo '<td>' . number_format($echange, 2, '.', ' ') . '</td>';
                  echo '<td>' . number_format($echange_util, 2, '.', ' ') . '</td>';
                  echo '<td>' . number_format($avoir_echange_converti, 2, '.', ' ') . '</td>';
                  echo '<td>' . number_format($remise, 2, '.', ' ') . '</td>';
                  echo '<td>' . number_format($echange_direct, 2, '.', ' ') . '</td>';
                  echo '<td>' . number_format($esp_reel, 2, '.', ' ') . '</td>';
                  echo '<td>' . number_format($cb, 2, '.', ' ') . '</td>';
                  echo '<td>' . number_format($cheque, 2, '.', ' ') . '</td>';
                  echo '<td>' . number_format($esp_emis, 2, '.', ' ') . '</td>';
                  echo '<td>' . number_format($avoir_emis, 2, '.', ' ') . '</td>';
                  echo '<td>' . number_format($total_achats, 2, '.', ' ') . '</td>';
                  echo '<td>' . number_format($total_ventes, 2, '.', ' ') . '</td>';
                  echo '<td>' . $nb_produits . '</td>';
                  echo '<td>#</td>';
                echo '</tr>';

              echo '    </tbody>

                      </table>

               </div>';

            ?>