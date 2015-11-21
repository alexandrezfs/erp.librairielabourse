<?php

  	require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/session.autoload.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/autoload/db.autoload.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "/class/Sound.class.php");

	class Tache{

		private $description;
		private $date;
		private $fait;
		private $author;
		private $id;
		private $Sound;

		function Tache()
		{
			$this->Sound = new Sound();
		}

		public function findPossibleProduct()
		{
			$query = getDb()->prepare("SELECT * FROM produits WHERE code = :code");
			$query->execute(array(
				'code' => $this->description
				));

			$row = $query->fetch();

			if($query->rowCount() > 0){
				return $this->description . ' TITRE : ' . $row['titre'] . ' AUTEUR : ' . $row['auteur'] . ' EDITEUR : ' . $row['editeur'];
			}
			else{
				return $this->description;
			}

		}

		public function alert()
		{

			$this->Sound->setUsername($_SESSION['username']);

			if(!$this->tacheDone() && $this->Sound->isSoundActivated()){
				echo '
					<object data="/dewplayer/dewplayer.swf" width="0" height="0" name="dewplayer" id="dewplayer" type="application/x-shockwave-flash">
					<param name="movie" value="/dewplayer/dewplayer.swf" />
					<param name="flashvars" value="mp3=/dewplayer/mp3/alert.mp3&autostart=1" />
					<param name="wmode" value="transparent" />
					</object>
				';
			}

		}

		public function printTachesView()
		{

			$taches = $this->getTaches();

			echo '

				<table class="table table-bordered table-striped">

					<thead>
						<tr>
							<td>Tâche</td>
							<td>Fait</td>
						</tr>
					</thead>
					<tbody>';

					foreach ($taches as $key => $value) {
						echo '<tr>';
							echo '<td>[' . $value['date'] . '] <strong>[' . $value['author'] . ']</strong> ' . $value['description'] . '</td>';
							
							if ($value['fait'] == 'oui') {
								echo '<td><input type="checkbox" onclick="toggleTache(' . $value['id'] . ')" checked></td>';
							}
							else{
								echo '<td><input type="checkbox" onclick="toggleTache(' . $value['id'] . ')"></td>';
							}

						echo '</tr>';
					}

			echo '
					</tbody>

				</table>

			';
		}

		public function getTaches()
		{
			$query = getDb()->prepare("SELECT * FROM taches ORDER BY id DESC LIMIT 50");
			$query->execute();

			return $query->fetchAll();
		}

		public function addTache()
		{
			$this->description = $this->findPossibleProduct();
			
			$query = getDb()->prepare("INSERT INTO taches(author, description, date, fait) VALUES(:author, :description, :date, :fait)");
			$query->execute(array(
				'author' => $this->author,
				'description' => $this->description,
				'date' => $this->date,
				'fait' => $this->fait
				));

		}

		public function tacheDone()
		{
			$query = getDb()->prepare("SELECT fait FROM taches WHERE fait = ? LIMIT 50");
			$query->execute(array('non'));

			if($query->rowCount() > 0){
				return false;
			}
			else{
				return true;
			}
		}

		public function toggleTache()
		{
			
			$query = getDb()->prepare("SELECT fait FROM taches WHERE id = ?");
			$query->execute(array($this->id));

			$row = $query->fetch();

			if ($row['fait'] == 'oui') {
				$query = getDb()->prepare("UPDATE taches SET fait = ? WHERE id = ?");
				$query->execute(array('non', $this->id));
			}
			else{
				$query = getDb()->prepare("UPDATE taches SET fait = ? WHERE id = ?");
				$query->execute(array('oui', $this->id));
			}

		}

		public function isFait()
		{
			$query = getDb()->prepare("SELECT fait FROM taches WHERE id = ?");
			$query->execute(array($this->id));

			$row = $query->fetch();

			if ($row['fait'] = 'oui') {
				return true;
			}
			else{
				return false;
			}
		}
		
		/**
		 * Getter for description
		 *
		 * @return mixed
		 */
		public function getDescription()
		{
		    return $this->description;
		}
		
		/**
		 * Setter for description
		 *
		 * @param mixed $description Value to set
		
		 * @return self
		 */
		public function setDescription($description)
		{
		    $this->description = $description;
		    return $this;
		}
		
		/**
		 * Getter for date
		 *
		 * @return mixed
		 */
		public function getDate()
		{
		    return $this->date;
		}
		
		/**
		 * Setter for date
		 *
		 * @param mixed $date Value to set
		
		 * @return self
		 */
		public function setDate($date)
		{
		    $this->date = $date;
		    return $this;
		}
		
		/**
		 * Getter for fait
		 *
		 * @return mixed
		 */
		public function getFait()
		{
		    return $this->fait;
		}
		
		/**
		 * Setter for fait
		 *
		 * @param mixed $fait Value to set
		
		 * @return self
		 */
		public function setFait($fait)
		{
		    $this->fait = $fait;
		    return $this;
		}
		
		/**
		 * Getter for author
		 *
		 * @return mixed
		 */
		public function getAuthor()
		{
		    return $this->author;
		}
		
		/**
		 * Setter for author
		 *
		 * @param mixed $author Value to set
		
		 * @return self
		 */
		public function setAuthor($author)
		{
		    $this->author = $author;
		    return $this;
		}
		
		/**
		 * Getter for id
		 *
		 * @return mixed
		 */
		public function getId()
		{
		    return $this->id;
		}
		
		/**
		 * Setter for id
		 *
		 * @param mixed $id Value to set
		
		 * @return self
		 */
		public function setId($id)
		{
		    $this->id = $id;
		    return $this;
		}
		

	}

?>