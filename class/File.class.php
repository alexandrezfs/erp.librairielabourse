<?php

	class File{

		private $token;
		private $file;
		private $fileLink;

		public function File()
		{
			
		}

		public function uploadFile()
		{
			if($this->file['error'] == 0)
			{
				$file = $_SERVER['DOCUMENT_ROOT'] . '/upload/docs/' . $this->file['name'];
				$this->fileLink = $_SERVER['HTTP_HOST'] . '/upload/docs/' . $this->file['name'];
				
				move_uploaded_file($this->file['tmp_name'], $file);

				return true;
			}
			else{
				return false;
			}
		}

		public function uploadImg()
		{
			$this->initKey();

			if($this->file['error'] == 0 && $this->file['size'] < 8000000)
			{
		
				$infodata = pathinfo($this->file['name']);
				$uploadExtensions = $infodata['extension'];
				$allowedExtensions = array('jpg', 'jpeg', 'gif', 'png', 'bmp', 'JPG', 'JPEG', 'GIF', 'PNG', 'BMP'); 

				//if allowed ext are ok with the current extension...
				if(in_array($uploadExtensions, $allowedExtensions))
				{	
					$image = $_SERVER['DOCUMENT_ROOT'] . '/upload/images/' . $this->token . '.' . $uploadExtensions;
					$this->fileLink = $_SERVER['HTTP_HOST'] . '/upload/images/' . $this->token . '.' . $uploadExtensions;
					
					move_uploaded_file($this->file['tmp_name'], $image);

					return true;
				}
				else{
					return false;
				}
				
			}
			else{
				return false;
			}
		}

		/**
		 * Getter for fileLink
		 *
		 * @return mixed
		 */
		public function getFileLink()
		{
		    return $this->fileLink;
		}
		
		/**
		 * Setter for fileLink
		 *
		 * @param mixed $fileLink Value to set
		
		 * @return self
		 */
		public function setFileLink($fileLink)
		{
		    $this->fileLink = $fileLink;
		    return $this;
		}
		

		public function initKey()
		{
			$this->token = md5(uniqid(rand(), true));
		}

		/**
		 * Getter for token
		 *
		 * @return mixed
		 */
		public function getToken()
		{
		    return $this->token;
		}
		
		/**
		 * Setter for token
		 *
		 * @param mixed $token Value to set
		
		 * @return self
		 */
		public function setToken($token)
		{
		    $this->token = $token;
		    return $this;
		}
		

		/**
		 * Getter for file
		 *
		 * @return mixed
		 */
		public function getFile()
		{
		    return $this->file;
		}
		
		/**
		 * Setter for file
		 *
		 * @param mixed $file Value to set
		
		 * @return self
		 */
		public function setFile($file)
		{
		    $this->file = $file;
		    return $this;
		}
		

	}

?>