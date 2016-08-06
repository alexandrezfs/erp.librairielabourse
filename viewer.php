<?php

  require_once(__DIR__ . "/autoload/session.autoload.php");
  require_once(__DIR__ . "/class/Network.class.php");
  require_once(__DIR__ . "/class/MobileDetect.class.php");
  require_once(__DIR__ . "/class/User.class.php");
  require_once(__DIR__ . "/class/Access.class.php");


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
    <?php require_once(__DIR__ . "/template/headcode.template.php"); ?>
</head>
<body>

    <?php include(__DIR__ . "/template/header.template.php"); ?>

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
                include(__DIR__ . "/template/network.template.php");
            }

          ?>

        </div>

      </div>
    </div>

    <?php include(__DIR__ . "/template/footer.template.php"); ?>

</body>
</html> 