    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="/">Bourse I.S</a>
          <div class="nav-collapse collapse">
  		
	<?php if(isset($_SESSION['username'])): ?>
  
          <ul class="nav">
              <li class="">
                <a href="./searcher.php">Searcher</a>
              </li>
              <li class="">
                <a href="./viewer.php">Viewer</a>
              </li>
              <li class="">
                <a href="./acheteur.php">Acheteur</a>
              </li>
              <li class="">
                <a href="./network.php">Etat du Réseau</a>
              </li>
              <li class="">
                <a href="./documents.php">Documents</a>
              </li>
              <li class="">
                <a href="./disconnect.php">Déconnexion</a>
              </li>
            </ul>

	<?php endif; ?>

          </div>
        </div>
      </div>
    </div>
