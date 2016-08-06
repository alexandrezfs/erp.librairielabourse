<!DOCTYPE html>
<html>
<head>
  <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/template/headcode.template.php"); ?>
</head>
<body>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/header.template.php"); ?>

    <div class="container sub-body">
      <div class="controls text-align-center margin-top-1 big-text">

        <div class="row-fluid margin-top-2">
          <h1>Accès refusé</h1>

          <div class="alert alert-block margin-top-1">
            <p>Vous n'êtes pas autorisé à utiliser ce module. Veuillez <a href="/">vous connecter</a> avec un compte autorisé.</p>
          </div>

        </div>

      </div>
    </div>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/footer.template.php"); ?>

</body>
</html> 