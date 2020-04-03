<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';
    require_once("config.php");

	$name = htmlspecialchars($_POST['name']);
	$mail = htmlspecialchars($_POST['email']);
	$phone = htmlspecialchars($_POST['phone']);
	$text = htmlspecialchars($_POST['message']);
		
	//Build mail
	$body = "<html>";
	$body .= "<head><title> Contact from la quinzaine </title></head>";

	$body .= "<body>Bonjour, <br>$name a fait une demande<br><br>";
	if(strlen($phone) != 0) {
		$body .= "Téléphone : $phone <br>";			
	}
	if(strlen($text) != 0) {
		$body .= "Message : $text <br>";			
	}
	$body .= "</body>";
	$body .= "</html>";

	// Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->isSMTP();
        $mail->Host       = Config::$MAIL_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = Config::$MAIL_LOGIN;
        $mail->Password   = Config::$MAIL_PASSWORD;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // To load the French version
        $mail->setLanguage('fr', '/PHPMailer/language/');
        $mail->CharSet    = PHPMailer::CHARSET_UTF8;

        //Recipients
        $mail->setFrom($mail, $name);
        $mail->addAddress("eddy.montus@gmail.com", "Eddy");
        $mail->addAddress("marinedesplaces@hotmail.fr", "Marine");
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = "Contact from la quinzaine";
        $mail->Body    = $body;
        
        $mail->send();
		echo 'SUCCESS';
    } catch (Exception $e) {
		echo 'ERROR';
    }
?>