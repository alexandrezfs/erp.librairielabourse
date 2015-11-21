<?php

  require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/session.autoload.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/checkconnected.autoload.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Network.class.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/class/User.class.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Document.class.php");

  $User = new User();
  $Document = new Document();

  $User->checkConnected();
  $User->rememberMe();

  $documents = $Document->getDocs();

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
           
              <legend>Télécharger un document</legend>  

              <form action="postcall/uploaddoc.postcall.php" method="POST" enctype="multipart/form-data">
                <p><input type="file" name="file"></p>
                <p><input type="submit" class="btn btn-primary" value="Télécharger"></p>
              </form>

              <div class="margin-top-1">

                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <td>Ajouté le</td>
                        <td>Document</td>
                        <td>Par</td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        foreach ($documents as $key => $value) {
                            echo '
                            <tr>
                              <td>' . $value['date'] . '</td>
                              <td><a href="http://' . $value['filelink'] . '">' . $value['filelink'] . '</a></td>
                              <td>' . $value['author'] . '</td>
                            </tr>';
                        }
                      ?>
                    </tbody>
                  </table>

              </div>

          </div>

          <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/network.template.php"); ?>

        </div>

      </div>
    </div>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/footer.template.php"); ?>

</body>
</html> 