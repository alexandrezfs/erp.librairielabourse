<?php

  require_once(__DIR__ . "/autoload/session.autoload.php");
  require_once(__DIR__ . "/class/Network.class.php");
  require_once(__DIR__ . "/class/User.class.php");
  require_once(__DIR__ . "/class/Access.class.php");

  $User = new User();

  $User->checkConnected();

  $Access = new Access();
  $Access->setUsername($_SESSION['username']);
  $Access->setModule('Searcher');
  $Access->isAllowedRedirect();

?>

<!DOCTYPE html>
<html>
<head>
  <?php require_once(__DIR__ . "/template/headcode.template.php"); ?>
</head>
<body>

    <?php include(__DIR__ . "/template/modal.template.php"); ?>
    
    <?php include(__DIR__ . "/template/header.template.php"); ?>

    <div class="container sub-body">

      <div class="row-fluid margin-top-1">
         
        <div class="span9">

          <div class="controls text-align-center well">

            <legend>Searcher</legend>

            <div class="margin-top-1">

              <input class="full-width" type="text" placeholder="Donnez moi une date, un code barre, un nom de produit..." id="searcher-input">

            </div>

          </div>

          <div id="searcher-results" class="small-text">
            
          </div>

        </div>

        <?php include(__DIR__ . "/template/network.template.php"); ?>

      </div>

    </div>

    <?php include(__DIR__ . "/template/footer.template.php"); ?>

</body>
</html> 