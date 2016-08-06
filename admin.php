<?php

  require_once(__DIR__ . "/autoload/session.autoload.php");
  require_once(__DIR__ . "/autoload/checkconnected-admin.autoload.php");

?>

<!DOCTYPE html>
<html>
<head>
  <?php require_once(__DIR__ . "/template/headcode.template.php"); ?>
</head>
<body>

    <?php include(__DIR__ . "/template/header.template.php"); ?>

    <div class="container sub-body">
      <div class="controls text-align-center margin-top-1 big-text">

        <div class="row-fluid">
          <div class="span12 well">
            <legend>B.I.S ADMIN CONTROL PANEL</legend>
            <div class="row-fluid margin-top-2">
              <div class="span4">
                <a href="users.admin.php">Utilisateurs</a>
              </div>
              <div class="span4">
                <a href="concur.admin.php">Pattern Concurrence</a>
              </div>
              <div class="span4">
                <a href="alert.admin.php">Alertes</a>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <?php include(__DIR__ . "/template/footer.template.php"); ?>

</body>
</html> 