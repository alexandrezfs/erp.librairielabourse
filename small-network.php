<?php

  require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/session.autoload.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/checkconnected.autoload.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Network.class.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/class/User.class.php");

  $User = new User();

  $User->checkConnected();
  $User->rememberMe();

?>

<!DOCTYPE html>
<html>
<head>
  <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/template/headcode.template.php"); ?>
</head>
<body>

    <div class="small-network-container well margin-top-1">

      <legend><center>Network</center></legend>

      <input type="text" id="message-network" class="full-width">
      <input type="hidden" id="username-network" value="<?php echo $_SESSION['username'] ?>">

      <div id="network-messages">

      </div>

    </div>

</body>
</html> 