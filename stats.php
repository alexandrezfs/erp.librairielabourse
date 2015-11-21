<?php

  require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/session.autoload.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/checkconnected.autoload.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Network.class.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Stats.class.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Magasin.class.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Access.class.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/class/User.class.php");


  $Magasin = new Magasin();

  $magasins = $Magasin->getMagasins();

  $User = new User();

  $User->checkConnected();

  $Access = new Access();
  $Access->setUsername($_SESSION['username']);
  $Access->setModule('Statistiques');
  $Access->isAllowedRedirect();

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
            
            <legend>Ventes par heure</legend>

            <div class="row-fluid">
              
              <p>Date de départ</p>
              <select id="day_start">
                <option value="1">Jour</option>
                <?php for($i = 1; $i < 32; $i++): ?>
                  <?php $i = sprintf("%02s", $i); ?>
                  <option value="<?php echo $i ?>"><?php echo $i ?></option>
                <?php endfor; ?>
              </select>

              <select id="month_start">
                <option value="1">Mois</option>
                <?php for($i = 1; $i < 13; $i++): ?>
                  <?php $i = sprintf("%02s", $i); ?>
                  <option value="<?php echo $i ?>"><?php echo $i ?></option>
                <?php endfor; ?>
              </select>

              <select id="year_start">
                <option value="1">Année</option>
                <?php for($i = 2010; $i < 2300; $i++): ?>
                  <option value="<?php echo $i ?>"><?php echo $i ?></option>
                <?php endfor; ?>
              </select>

              <p>Date de fin</p>

              <select id="day_end">
                <option value="1">Jour</option> 
                <?php for($i = 1; $i < 32; $i++): ?>
                  <?php $i = sprintf("%02s", $i); ?>
                  <option value="<?php echo $i ?>"><?php echo $i ?></option>
                <?php endfor; ?>
              </select>

              <select id="month_end">
                <option value="1">Mois</option>
                <?php for($i = 1; $i < 13; $i++): ?>
                  <?php $i = sprintf("%02s", $i); ?>
                  <option value="<?php echo $i ?>"><?php echo $i ?></option>
                <?php endfor; ?>
              </select>

              <select id="year_end">
                <option value="1">Année</option>
                <?php for($i = 2010; $i < 2300; $i++): ?>
                  <option value="<?php echo $i ?>"><?php echo $i ?></option>
                <?php endfor; ?>
              </select>

              <p>Magasin</p>
              <select id="magasin">
                <option value="1">Magasin</option>
                <?php foreach ($magasins as $key => $value): ?>
                  <option value="<?php echo $value[0]; ?>"><?php echo $value[0]; ?></option>
                <?php endforeach; ?>
              </select>

              <p>
                Moyenne par jour
                <input type="checkbox" id="averageByDay">
              </p>

              <p>
                <button class="btn btn-primary" id="button-get-stats-per-hour">Confirmer</button>
              </p>

            </div>

            <div id="container-stats"></div>

          </div>

          <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/network.template.php"); ?>

        </div>

      </div>
    </div>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/footer.template.php"); ?>

</body>
</html> 