<?php

	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/IA.class.php");
  	require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/session.autoload.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/db.autoload.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Mail.class.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Transaction.class.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Viewer.class.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Searcher.class.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Magasin.class.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Reassort.class.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Fraude.class.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/class/IosPushNotificationCenter.php");
  	require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/produitType.autoload.php");


	class Alert extends IA
	{

		private $welcomeMessage;
		private $endMessage;
		
		function Alert()
		{

			parent::IA();

			$this->welcomeMessage = "

				<h1>Message de l'I.A</h1>

				<p>Message automatique</p>

				------------------------------------------------------------------

				<br>

			";

			$this->endMessage = "

				<br>

				------------------------------------------------------------------

				<br>

				Bourse Intelligence Artificielle © NGUYEN Alexandre.

			";
		}

		public function GO()
		{
			$returnMessage = "Alerting... Genrating statistics." . PHP_EOL;
			
			$this->Mail->setObject("I.A Bourse Information Systems : RAPPORT GENERAL DU " . date("d/m/Y"));
			$this->Mail->setMessagetxt = "Activez HTML pour lire ce message.";
			$message = $this->welcomeMessage;
			$returnMessage = "GENERATING CHIFFRE STATS" . PHP_EOL;
			$message .= $this->alertChiffre();
			$returnMessage = "GENERATING MOST EXPENSIVE PRODUCTS STATS" . PHP_EOL;
			$message .= $this->alertMostExpensiveProducts();
			//$returnMessage = "GENERATING FRAUDE STATS" . PHP_EOL;
			//$message .= $this->alertFraude();
			$returnMessage = "GENERATING REA FAIT STATS" . PHP_EOL;
			$message .= $this->alertReaFait();
			$returnMessage = "GENERATING IS ALIVE STATS" . PHP_EOL;
			$message .= $this->alertIsAlive();
			$returnMessage = "END GENERATING !" . PHP_EOL;
			$message .= $this->endMessage;

			foreach ($this->emails as $email) {

				$this->Mail->setMessagehtml($message);

				$this->Mail->setSender("ia@librairielabourse.fr");
				$this->Mail->setReceiver($email);
				$this->Mail->setSenderName("I.A BOURSE");

				$returnMessage = "SENDING MAIL TO " . $email . "..." . PHP_EOL;

				$this->Mail->sendMail();

				$returnMessage = "SENDING MAIL OK" . PHP_EOL;

			}

			return $returnMessage;

		}

		public function alertFraude()
		{
          $this->Fraude->setDate(date("d/m/Y"));
          $fraudes = $this->Fraude->getSuspectProducts();

          $message = "<br><br><h3>Ces produits méritent votre attention</h3>";

          foreach ($fraudes as $key => $value) {
          	$message .= '
          	<p>
          		Le produit ' . $value->getTitre() . ' ' . $value->getAuteur() . ' ' . $value->getEditeur() . ' ' . $value->getType() . '<br>
          		a été vendu à ' . $value->getPrix() . ' EUROS a ' . $value->getHeure() . ' sur <strong>' . $value->getMagasin() . '</strong><br>
          		<strong>cependant, il est habituellement vendu autour de ' . $value->getUsualPrice() . ' EUROS...</strong>
          	</p>';
          }

          $message .= "<br><br>

          ----------------------------------------------------";

          return $message;
		}

		public function alertReaFait()
		{
              $types = getProduitsTypes();

              $this->Reassort->setDate(date("d/m/Y"));

              $message = "<br><br><h3>Les réassorts d'aujourd'hui ont-ils été faits ?</h3>";

              foreach ($this->magasins as $key => $magasin) {

              	$this->Reassort->setMagasin($magasin['localisation']);

              	$message .= '<p style="margin-top:15px;"><strong>' . $magasin['localisation'] . '</strong></p>';

	              foreach ($types as $key => $type) {

	                $this->Reassort->setType($type);

	                $message .= '<p>';
	                  $message .= '[' . $type . ']';
	                  $message .= ' FAIT A [' .  $this->Reassort->getReaPercent() . ' %]';
	                $message .= '</p>';

	              }
              }

              $message .= "<br><br>

              ----------------------------------------------------";

              return $message;
		}

		public function alertChiffre()
		{	
			$this->Transaction->setDate(date("d/m/Y"));
			$globals = $this->Transaction->getGlobalsWithDATE();

			$message = "<br><br><h3>Voici vos chiffres d'affaire le " . date("d/m/Y") . " à " . date("H:i") . " : </h3>";

			$total = 0;
			foreach ($globals as $key => $value) {
				$total += $value['chiffre_journee'];
				$message .= '<p>[' . $value['magasin'] . '] : ' . $value['chiffre_journee'] . ' EUROS</p>';

                //Send an alert to iOS devices as well.
                $iOSMessage = 'Résultat ' . $value['magasin'] . ' : ' . $value['chiffre_journee'] . ' €';
                $iosPushNotificationCenter = new IosPushNotificationCenter();
                $iosPushNotificationCenter->broadcastNotification($iOSMessage);
            }

			$message .= "

				---------------------------------
				<br>
				TOTAL : " . $total . " EUROS
				<br>

			";

			return $message;
		}

		public function alertIsAlive()
		{

			$Magasin = new Magasin();
			$magasins = $Magasin->getMagasins();

			$message = '<br><br><h3>Etat du réseau de La Bourse</h3>';

			foreach ($magasins as $key => $value) {
				
				$Magasin->setNom($value['localisation']);

	            if($Magasin->isAlive()){
	            	$message .= '</p>La caisse : ' . $value['localisation'] . ' est bien connectée</p>';
	            }
	            else{
	            	$message .= '<p>La caisse : ' . $value['localisation'] . ' n\'est <strong>PAS connectée</strong></p>';
	            }
			}

			return $message;

		}

		public function alertMostExpensiveProducts()
		{
			$Magasin = new Magasin();
			$magasins = $Magasin->getMagasins();

			$message = '<br><br>';

			foreach ($magasins as $key => $value) {

				$this->Transaction->setMagasin($value['localisation']);
				
				$message .= '
				<br><br>
				<h3>Voici les produits les plus chers vendus sur : <strong>' . $value['localisation'] . '</strong></h3>';

				$products = $this->Transaction->getMostExpensiveProducts();

				$message .= '<table>';

				$message .= '<thead>
					<tr>
						<td style="border:1px solid black">PRIX</td>
						<td style="border:1px solid black">TYPE</td>
						<td style="border:1px solid black">TITRE</td>
						<td style="border:1px solid black">AUTEUR</td>
						<td style="border:1px solid black">EDITEUR</td>
						<td style="border:1px solid black">EDITION</td>
					</tr>
				</thead>';

				foreach ($products as $key => $product) {
					$message .= '<tr>

						<td style="border:1px solid black">' . $product['prix'] . ' EUROS</td>
						<td style="border:1px solid black">' . $product['type'] . '</td>
						<td style="border:1px solid black">' . $product['titre'] . '</td>
						<td style="border:1px solid black">' . $product['auteur'] . '</td>
						<td style="border:1px solid black">' . $product['editeur'] . '</td>
						<td style="border:1px solid black">' . $product['edition'] . '</td>

					</tr>';
				}

				$message .= '</table>';
			}

			return $message;
		}
	}

?>