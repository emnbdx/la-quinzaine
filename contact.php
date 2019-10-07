<?php
	$MAIL_ADRESSE = 'eddy.montus@gmail.com';
	$MAIL_SUJET = 'Contact from la quinzaine';

	$name = htmlspecialchars($_POST['name']);
	$mail = htmlspecialchars($_POST['email']);
	$phone = htmlspecialchars($_POST['phone']);
	$text = htmlspecialchars($_POST['message']);
		
	//Build mail
	$body = "<html>";
	$body .= "<head><title> $MAIL_SUJET </title></head>";

	$body .= "<body>Bonjour, <br>$name a fait une demande<br><br>";
	if(strlen($phone) != 0) {
		$body .= "Téléphone : $phone <br>";			
	}
	if(strlen($text) != 0) {
		$body .= "Message : $text <br>";			
	}
	$body .= "</body>";

	$body .= "</html>";
	// Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

	// En-têtes additionnels
	$headers .= 'To: Eddy<eddy.montus@gmail.com>, Marine<marinedesplaces@hotmail.fr>' . "\r\n";
	$headers .= 'From: "'. $name . '"<' . $mail . '>' . "\r\n";
	$headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";

	if(mail($MAIL_ADRESSE, $MAIL_SUJET, $body, $headers)) {
		echo 'SUCCESS';
	} else {
		echo 'ERROR';
	}
?>