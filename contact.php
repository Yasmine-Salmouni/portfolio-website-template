<?php
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = htmlspecialchars($_POST['fname']);
    $lname = htmlspecialchars($_POST['lname']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);
    try {
        // Configurations du serveur SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Serveur SMTP de Gmail
        $mail->SMTPAuth = true;
        $mail->Username = 'yasminesalmouni81@gmail.com';  // Remplacez par votre adresse email Gmail
        $mail->Password = 'MinesMoFaLYa.03';  // Remplacez par votre mot de passe Gmail
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Destinataires
        $mail->setFrom($email, "$fname $lname");
        $mail->addAddress('yasminesalmouni81@gmail.com');  // Votre adresse email de réception

        // Contenu de l'email
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body    = "Name: $fname $lname<br>Email: $email<br>Message:<br>$message";
        $mail->AltBody = "Name: $fname $lname\nEmail: $email\nMessage:\n$message";

        $mail->send();
        header("Location: thank_you.html");
        exit();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
