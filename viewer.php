<?php

  require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/session.autoload.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Network.class.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/class/MobileDetect.class.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/class/User.class.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Access.class.php");


  $MobileDetect = new Mobile_Detect();

  $User = new User();

  $User->checkConnected();

  $Access = new Access();
  $Access->setUsername($_SESSION['username']);
  $Access->setModule('Viewer');
  $Access->isAllowedRedirect();

?>

<!DOCTYPE html>
<html>
<head>
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/template/headcode.template.php"); ?>
</head>
<body>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/header.template.php"); ?>

  <script type="text/javascript">
  //<![CDATA[
  window.onload = function() {
    try {
      snow.count = 30;   // number of flakes
      snow.delay = 20;   // timer interval
      snow.minSpeed = 2; // minimum movement/time slice
      snow.maxSpeed = 5; // maximum movement/time slice
      snow.start();
    } catch(e) {
      // no snow :(
    }
  };
  //]]>
  </script>

    <div class="container sub-body">
      <div class="controls margin-top-1">

        <div class="row-fluid">
          <div class="span9 well text-align-center">

            <div id="viewer-container">
              <em>Chargement en cours, veuillez patienter...</em>
            </div>

          </div>

          <?php 

            if(!$MobileDetect->isMobile()){
                include($_SERVER['DOCUMENT_ROOT'] . "/template/network.template.php"); 
            }

          ?>

        </div>

      </div>
    </div>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/footer.template.php"); ?>

</body>
</html> 