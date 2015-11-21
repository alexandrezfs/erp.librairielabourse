<?php

  require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/session.autoload.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Network.class.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/class/User.class.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Access.class.php");

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
  <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/template/headcode.template.php"); ?>
</head>
<body>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/modal.template.php"); ?>
    
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/header.template.php"); ?>

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

        <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/network.template.php"); ?>

      </div>

    </div>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/footer.template.php"); ?>

</body>
</html> 