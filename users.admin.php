<?php

  require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/session.autoload.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/checkconnected-admin.autoload.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/class/User.class.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Module.class.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Access.class.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Sound.class.php");

  $User = new User();
  $Access = new Access();
  $Sound = new Sound();

  $modules = Module::getModules();

?>

<!DOCTYPE html>
<html>
<head>
  <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/template/headcode.template.php"); ?>
<body>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/header.template.php"); ?>

    <div class="container sub-body">
      <div class="controls text-align-center margin-top-1 big-text">

      	<?php
      		if(isset($_GET['event'])){
      			if($_GET['event'] == 'noinfo'){
      				echo '<div class="alert alert-error">Veuillez entrez un nom et un mot de passe svp.</div>';
      			}
      			else if($_GET['event'] == 'added'){
      				echo '<div class="alert alert-success">Utilisateur ajouté !</div>';
      			}
      			else if($_GET['event'] == 'deleted'){
      				echo '<div class="alert alert-success">Utilisateur supprimé !</div>';
      			}
            else if($_GET['event'] == 'removed-allowed'){
              echo '<div class="alert alert-success">Permission supprimée !</div>';
            }
            else if($_GET['event'] == 'added-allowed'){
              echo '<div class="alert alert-success">Permission enregistrée !</div>';
            }
            else if($_GET['event'] == 'param-changed'){
              echo '<div class="alert alert-success">Paramêtre prit en compte</div>';
            }
      		}
      	?>

        <div class="row-fluid">
          <div class="span12 well">
            <legend>B.I.S ADMIN CONTROL PANEL</legend>
            <div>
              <img src="images/design/bis_logo.png">
            </div>

            <div class="row-fluid margin-top-2">
              <legend>Ajouter un utilisateur</legend>	
              <form action="postcall/adduser.postcall.php" method="POST">
              	<p>Nom d'utilisateur</p>
              	<input type="text" name="username">
              	<p>Mot de passe</p>
              	<input type="password" name="password">
              	<br>
              	<input type="submit">
              </form>
            </div>

            <div class="row-fluid margin-top-2">
              
              <legend>Liste des utilisateurs</legend>

              <table class="table table-striped">
	              <thead>
	                <tr>
	                  <th>Nom d'utilisateur</th>
	                  <th>Mot de passe</th>
	                  <th>#</th>
	                </tr>
	              </thead>

			      <tbody>
              
		              <?php

		              	$users = $User->getUsers();

		              	foreach ($users as $key => $value) {
		              		echo '
				                <tr>
				                  <td>' . $value['username'] . '</td>
				                  <td>' . $value['password'] . '</td>
				                  <td><a href="getcall/deluser.getcall.php?id=' . $value['id'] . '" onclick="return confirm(\'Supprimer cet utilisateur ?\');">Supprimer</a></td>
				                </tr>
				            ';
		              	}

		              ?>

               		</tbody>
            	</table>

            </div>

            <div class="row-fluid margin-top-2">
              
              <legend>Permissions</legend>

              <?php

                foreach ($users as $key => $value) {
                  echo '<div class="row-fluid margin-top-1">';
                    echo '<div class="span6">';
                      echo '<p>[' . $value['username'] . ']</p>';
                      foreach ($modules as $key => $module) {

                          $Access->setUsername($value['username']);
                          $Access->setModule($module['module_name']);

                          if($Access->isAllowed()){
                            echo '<p>' . $module['module_name'] . ' <a href="getcall/deleteallowed.getcall.php?username=' . $value['username'] . '&module=' . $module['module_name'] . '">(Supprimer)</a></p>';
                          }

                      }
                    echo '</div>';
                    echo '<div class="span6">';
                      echo '<p>[' . $value['username'] . ']</p>';
                      echo '<form action="postcall/addallow.postcall.php" method="POST">';
                        echo '<select name="module">';
                          foreach ($modules as $key => $module) {
                              echo '<option name="' . $module['module_name'] . '">' . $module['module_name'] . '</option>';
                          }
                        echo '</select>';
                        echo '<input type="hidden" name="username" value="' . $value['username'] . '">';
                        echo '<br>';
                        echo '<input type="submit" value="Ajouter la permission">';
                      echo '</form>';
                    echo '</div>';
                  echo '</div>';
                }

              ?>

            </div>

            <div class="row-fluid margin-top-2">
              
              <legend>Sound</legend>

              <?php

                foreach ($users as $key => $value) {
                  echo '<div class="row-fluid margin-top-1">';
                    echo '<div class="span6">';
                      echo '<p>[' . $value['username'] . ']</p>';
                    echo '</div>';
                    echo '<div class="span6">';

                      $Sound->setUsername($value['username']);

                      if($Sound->isSoundActivated()){
                        echo '<p>SON ACTIF</p>';
                      }
                      else{
                        echo '<p>SON INACTIF</p>';
                      }


                      echo '<form action="postcall/togglesound.postcall.php" method="POST">';
                        echo '<input type="hidden" name="username" value="' . $value['username'] . '">';
                        echo '<br>';
                        echo '<input type="submit" value="Changer">';
                      echo '</form>';
                    echo '</div>';
                  echo '</div>';
                }

              ?>

            </div>

          </div>
        </div>

      </div>
    </div>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/footer.template.php"); ?>

</body>
</html> 