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

            <h4 class="margin-top-1">Entrées / sorties de valeur</h4>

            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <td><strong>ESP [ENTREE]</strong></td>
                  <td><strong>CB [ENTREE]</strong></td>
                  <td><strong>CHEQUE [ENTREE]</strong></td>
                  <td><strong>AVOIR [ENTREE]</strong></td>
                  <td><strong>ECHANGE [ENTREE]</strong></td>
                  <td><strong>ESP [SORTIE]</strong></td>
                  <td><strong>AVOIR [SORTIE]</strong></td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php echo $Transaction->getEsp() . '€'; ?></td>
                  <td><?php echo $Transaction->getCB() . '€'; ?></td>
                  <td><?php echo $Transaction->getCheque() . '€'; ?></td>
                  <td><?php echo $Transaction->getAvoirUtil() . '€'; ?></td>
                  <td><?php echo $Transaction->getEchangeUtil() . '€'; ?></td>
                  <td><?php echo $Transaction->getEspEmis() . '€'; ?></td>
                  <td><?php echo $Transaction->getAvoirEmis() . '€'; ?></td>
                </tr>
              </tbody>
            </table>

            <h4 class="margin-top-1">Produits (statistiques)</h4>

            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <td><strong>#</strong></td>
                  <td><strong>LIVRE</strong></td>
                  <td><strong>DVD</strong></td>
                  <td><strong>BLU-RAY</strong></td>
                  <td><strong>CD</strong></td>
                  <td><strong>VINYLE</strong></td>
                  <td><strong>JEU</strong></td>
                  <td><strong>CONSOLE</strong></td>
                  <td><strong>AUTRE</strong></td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Nombre</td>
                  <td><?php echo $Transaction->getTotalLIVRE(); ?></td>
                  <td><?php echo $Transaction->getTotalDVD(); ?></td>
                  <td><?php echo $Transaction->getTotalBLURAY(); ?></td>
                  <td><?php echo $Transaction->getTotalCD(); ?></td>
                  <td><?php echo $Transaction->getTotalVINYLE(); ?></td>
                  <td><?php echo $Transaction->getTotalJEU(); ?></td>
                  <td><?php echo $Transaction->getTotalCONSOLE(); ?></td>
                  <td><?php echo $Transaction->getTotalAUTRE(); ?></td>
                </tr>
                <tr>
                  <td>Valeur</td>
                  <td><?php echo $Transaction->getTotalLIVREPrix() . '€'; ?></td>
                  <td><?php echo $Transaction->getTotalDVDPrix() . '€'; ?></td>
                  <td><?php echo $Transaction->getTotalBLURAYPrix() . '€'; ?></td>
                  <td><?php echo $Transaction->getTotalCDPrix() . '€'; ?></td>
                  <td><?php echo $Transaction->getTotalVINYLEPrix() . '€'; ?></td>
                  <td><?php echo $Transaction->getTotalJEUPrix() . '€'; ?></td>
                  <td><?php echo $Transaction->getTotalCONSOLEPrix() . '€'; ?></td>
                  <td><?php echo $Transaction->getTotalAUTREPrix() . '€'; ?></td>
                </tr>
                <tr>
                  <td>Moyenne</td>
                  <td><?php if($Transaction->getTotalLIVRE() != 0){echo number_format($Transaction->getTotalLIVREPrix() / $Transaction->getTotalLIVRE(), 2, '.', ' ') . '€';} else{echo '0€';} ?></td>
                  <td><?php if($Transaction->getTotalDVD() != 0){echo number_format($Transaction->getTotalDVDPrix() / $Transaction->getTotalDVD(), 2, '.', ' ')  . '€';} else{echo '0€';} ?></td>
                  <td><?php if($Transaction->getTotalBLURAY() != 0){echo number_format($Transaction->getTotalBLURAYPrix() / $Transaction->getTotalBLURAY(), 2, '.', ' ')  . '€';} else{echo '0€';} ?></td>
                  <td><?php if($Transaction->getTotalCD() != 0){echo number_format($Transaction->getTotalCDPrix() / $Transaction->getTotalCD(), 2, '.', ' ')  . '€';} else{echo '0€';} ?></td>
                  <td><?php if($Transaction->getTotalVINYLE() != 0){echo number_format($Transaction->getTotalVINYLEPrix() / $Transaction->getTotalVINYLE(), 2, '.', ' ')  . '€';} else{echo '0€';} ?></td>
                  <td><?php if($Transaction->getTotalJEU() != 0){echo number_format($Transaction->getTotalJEUPrix() / $Transaction->getTotalJEU(), 2, '.', ' ')  . '€';} else{echo '0€';} ?></td>
                  <td><?php if($Transaction->getTotalCONSOLE() != 0){echo number_format($Transaction->getTotalCONSOLEPrix() / $Transaction->getTotalCONSOLE(), 2, '.', ' ')  . '€';} else{echo '0€';} ?></td>
                  <td><?php if($Transaction->getTotalAUTRE() != 0){echo number_format($Transaction->getTotalAUTREPrix() / $Transaction->getTotalAUTRE(), 2, '.', ' ')  . '€';} else{echo '0€';} ?></td>
                </tr>
              </tbody>
            </table>

            <h4 class="margin-top-1">Comparaison Réassorts / Non réassorts</h4>

            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <td><strong>#</strong></td>
                  <td><strong>Reassortis</strong></td>
                  <td><strong>Non réassortis</strong></td>
                  <td><strong>Totaux</strong></td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Nombre</td>
                  <td><?php echo $Transaction->getTotalProdRea(); ?></td>
                  <td><?php echo $Transaction->getTotalProdNoRea(); ?></td>
                  <td><?php echo $Transaction->getTotalProd(); ?></td>
                </tr>
                <tr>
                  <td>Valeur</td>
                  <td><?php echo $Transaction->getTotalProdReaPrix() . '€'; ?></td>
                  <td><?php echo $Transaction->getTotalProdNoReaPrix() . '€'; ?></td>
                  <td><?php echo $Transaction->getTotalProdPrix() . '€'; ?></td>
                </tr>
              </tbody>
            </table>

            <h4 class="margin-top-1">Détail des transactions</h4>

            <p>
              <a href="#" onclick="buildDetailledTransacContainers(); return false;"><button class="btn btn-primary">Afficher + de détails</button></a>
            </p>

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