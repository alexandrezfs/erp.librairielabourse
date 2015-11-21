<?php

  require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/session.autoload.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Network.class.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/class/User.class.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Access.class.php");

  $User = new User();

  $User->checkConnected();

  $Access = new Access();
  $Access->setUsername($_SESSION['username']);
  $Access->setModule('Acheteur');
  $Access->isAllowedRedirect();

?>

<!DOCTYPE html>
<html>
<head>
  <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/template/headcode.template.php"); ?>
  <script type="text/javascript" src="js/acheteur.js"></script>
</head>
<body>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/modal.template.php"); ?>
    
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/header.template.php"); ?>

    <?php if(isset($_GET['lotid']) && isset($_GET['nom'])): ?>

      <script type="text/javascript">
        lotID = <?php echo $_GET['lotid']; ?>;
        refreshProd();
      </script>

      <a href="/acheteur.php">
        <div class="mask-dialog">

        </div>
      </a>

      <div class="lot-dialog">

        <div class="lot-entry input-append">

          <h4>Lot de <?php echo $_GET['nom']; ?> </h4>

            <div>
              <input type="text" class="input-medium" placeholder="ISBN / EAN" id="code" onkeyup="printVendus();">
              <select id="type">
                <option>LIVRE</option>
                <option>CD</option>
                <option>VINYLE</option>
                <option>JEU</option>
                <option>CONSOLE</option>
                <option>DVD</option>
                <option>BLU-RAY</option>
                <option>AUTRE</option>
              </select>
              <input type="text" class="input-medium" placeholder="Titre" id="titre">
              <input type="text" class="input-medium" placeholder="Auteur / Console" id="auteur">
              <input type="text" class="input-medium" placeholder="Editeur" id="editeur">
            </div>

            <div class="margin-top-1">
              <input type="text" class="input-mini" placeholder="Vente" id="vente" onfocusout="calcul()">
              <span class="add-on">€</span>
              <input type="text" class="input-mini" placeholder="ESP" id="achatesp">
              <span class="add-on">€</span>
              <input type="text" class="input-mini" placeholder="ECH" id="achatech">
              <span class="add-on">€</span>
              <button type="submit" class="btn" id="add" onfocus="addProd()">Ajouter</button>
            </div>

        </div>

        <div class="table-lot margin-top-1" id="prod-lot">

        </div>

        <div class="margin-top-1">

          <a href="#" onclick="validLot();">
            <button class="btn btn-primary">
              Valider le lot
            </button>
          </a>

          <a href="getcall/deletelot.getcall.php?lotID=<?php echo $_GET['lotid'] ?>" onclick="return confirm('Supprimer le lot ?');">
            <button class="btn">
              Supprimer le lot
            </button>
          </a>

          <a href="/acheteur.php">
            <button class="btn">
              Fermer la fenêtre
            </button>
          </a>

        </div>

        <div class="margin-top-1" id="vendus">

        </div>

      </div>

    <?php endif ?>

    <div class="container sub-body">

      <div class="row-fluid margin-top-1">
         
        <div class="span9">

          <div class="controls text-align-center well">

            <div class="row-fluid">

                <div class="row-fluid">

                  <legend>Acheteur</legend>

                </div>

                <div class="row-fluid margin-top-1">
                  <div class="span5">
                     <div>
                        <h4>Ajouter un lot</h4>
                        <input type="text" placeholder="Nom du vendeur" id="nom">
                        <input type="text" placeholder="Description" id="description">
                        <br>
                        <button class="btn btn-primary" onclick="addLot();">Ajouter</button>
                     </div>

                  </div>

                   <div class="span7" id="lots-en-attente">
                    
                   </div>
                </div>

            </div>

          </div>

        </div>

        <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/network.template.php"); ?>

      </div>

    </div>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/footer.template.php"); ?>

</body>
</html> 