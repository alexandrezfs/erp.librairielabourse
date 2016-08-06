<?php

	require_once(__DIR__ . "../vendor/phpmailer/phpmailer/PHPMailerAutoload.php");

	class Mail{

		private $object;
		private $sender;
		private $receiver;
		private $sendername;
		private $messagetxt;
		private $messagehtml;

		function Mail(){

		}

		public function sendMail(){

			//SMTP needs accurate times, and the PHP time zone MUST be set
			//This should be done in your php.ini, but this is how to do it if you don't have access to that
			date_default_timezone_set('Europe/Paris');

			//Create a new PHPMailer instance
			$mail = new PHPMailer();

			//Tell PHPMailer to use SMTP
			$mail->isSMTP();

			//Enable SMTP debugging
			// 0 = off (for production use)
			// 1 = client messages
			// 2 = client and server messages
			$mail->SMTPDebug = 2;

			//Ask for HTML-friendly debug output
			$mail->Debugoutput = 'html';

			//Set the hostname of the mail server
			$mail->Host = 'smtp.gmail.com';

			//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
			$mail->Port = 587;

			//Set the encryption system to use - ssl (deprecated) or tls
			$mail->SMTPSecure = 'tls';

			//Whether to use SMTP authentication
			$mail->SMTPAuth = true;

			//Username to use for SMTP authentication - use full email address for gmail
			$mail->Username = "librairielabourse@gmail.com";

			//Password to use for SMTP authentication
			$mail->Password = "labourse";

			//Set who the message is to be sent from
			$mail->setFrom($this->sender, $this->sendername);

			//Set an alternative reply-to address
			$mail->addReplyTo($this->sender, $this->sendername);

			//Set who the message is to be sent to
			$mail->addAddress($this->receiver);

			//Set the subject line
			$mail->Subject = $this->object;

			//Read an HTML message body from an external file, convert referenced images to embedded,
			//convert HTML into a basic plain-text alternative body
			$mail->msgHTML($this->messagehtml);

			//Replace the plain text body with one created manually
			$mail->AltBody = $this->messagetxt;

			//send the message, check for errors
			if (!$mail->send()) {
			    echo "Mailer Error: " . $mail->ErrorInfo;
			} else {
			    echo "Message sent!";
			}

		}
		
		/**
		 * Getter for messagehtml
		 *
		 * @return mixed
		 */
		public function getMessagehtml()
		{
		    return $this->messagehtml;
		}
		
		/**
		 * Setter for messagehtml
		 *
		 * @param mixed $messagehtml Value to set
		
		 * @return self
		 */
		public function setMessagehtml($messagehtml)
		{
		    $this->messagehtml = utf8_encode($messagehtml);
		    return $this;
		}
		

		/**
		 * Getter for messagetxt
		 *
		 * @return mixed
		 */
		public function getMessagetxt()
		{
		    return $this->messagetxt;
		}
		
		/**
		 * Setter for messagetxt
		 *
		 * @param mixed $messagetxt Value to set
		
		 * @return self
		 */
		public function setMessagetxt($messagetxt)
		{
		    $this->messagetxt = $messagetxt;
		    return $this;
		}
		

		/**
		 * Getter for sendername
		 *
		 * @return mixed
		 */
		public function getSendername()
		{
		    return $this->sendername;
		}
		
		/**
		 * Setter for sendername
		 *
		 * @param mixed $sendername Value to set
		
		 * @return self
		 */
		public function setSendername($sendername)
		{
		    $this->sendername = $sendername;
		    return $this;
		}
		

		/**
		 * Getter for receiver
		 *
		 * @return mixed
		 */
		public function getReceiver()
		{
		    return $this->receiver;
		}
		
		/**
		 * Setter for receiver
		 *
		 * @param mixed $receiver Value to set
		
		 * @return self
		 */
		public function setReceiver($receiver)
		{
		    $this->receiver = $receiver;
		    return $this;
		}
		

		/**
		 * Getter for sender
		 *
		 * @return mixed
		 */
		public function getSender()
		{
		    return $this->sender;
		}
		
		/**
		 * Setter for sender
		 *
		 * @param mixed $sender Value to set
		
		 * @return self
		 */
		public function setSender($sender)
		{
		    $this->sender = $sender;
		    return $this;
		}
		

		/**
		 * Getter for object
		 *
		 * @return mixed
		 */
		public function getObject()
		{
		    return $this->object;
		}
		
		/**
		 * Setter for object
		 *
		 * @param mixed $object Value to set
		
		 * @return self
		 */
		public function setObject($object)
		{
		    $this->object = $object;
		    return $this;
		}
		

	}

?>