<?php
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;

   require_once "PHPMailer/PHPMailer.php";
   require_once "PHPMailer/SMTP.php";
   require_once "PHPMailer/Exception.php";

   $name = $_GET['name'];
   $price = $_GET['price'];
   $condition = $_GET['condition'];
   $category = $_GET['category'];
   $mentions = $_GET['mentions'];
   $phone = $_GET['phone'];
   $your_email = $_GET['your_email'];
   $owner_email = $_GET['owner_email'];

   $mail = new PHPMailer(TRUE);

   $mail->isSMTP();
   $mail->Host = 'smtp.gmail.com';
   $mail->SMTPAuth = true;
   $mail->Username = 'beleasebastian@gmail.com';
   $mail->Password = 'catalin99';
   $mail->Port = 465;
   $mail->SMTPSecure = 'tls';

   $mail->isHTML(true);
   $mail->setFrom('beleasebastian@gmail.com', $name);
   $mail->addAddress('beleasebastian@gmail.com');
   $mail->Subject = "TEST";
   $mail->Body = "BODY";
   echo "ASD";
   if($mail->send())
   	 {
   	 	echo "OK";
	  return;
	} 
	else {
		echo $mail->ErrorInfo;
	  return;
	}

?>