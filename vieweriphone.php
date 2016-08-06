<?php

  require_once(__DIR__ . "/autoload/session.autoload.php");
  require_once(__DIR__ . "/class/Network.class.php");
  require_once(__DIR__ . "/class/MobileDetect.class.php");
  require_once(__DIR__ . "/class/Transaction.class.php");
  require_once(__DIR__ . "/class/Magasin.class.php");
  require_once(__DIR__ . "/class/Viewer.class.php");

  $Viewer = new Viewer();

?>

<!DOCTYPE html>
<html>
<head>
  <?php require_once(__DIR__ . "/template/headcode.template.php"); ?>

  <script type="text/javascript">

    function refresh() {
      document.location.href = "/vieweriphone.php";
      setTimeout("refresh()", 30000);
    }

    setTimeout("refresh()", 30000);

  </script>

</head>
<body>

    <?php include(__DIR__ . "/template/header.template.php"); ?>

    <div class="container sub-body">
      <div class="controls">

        <div class="row-fluid">
          <div class="span12 well text-align-center">

            <legend>Viewer</legend>

            <div id="viewer-mobile-container">
              <?php
                $Viewer->getMobilePrintedView();
              ?>
            </div>

          </div>

        </div>

      </div>
    </div>

    <?php include(__DIR__ . "/template/footer.template.php"); ?>

</body>
</html> 