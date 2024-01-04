<?php
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Username   = 'tankrevive@gmail.com';
        $mail->Password   = 'tqkysskhiglatcdx';
        $mail->Port       = 587;

        // Sender and recipient settings
        $clienteMail = $_POST['email'];
        $assunto = $_POST['conteudo'];

        $mail->setFrom($clienteMail);
        $mail->addAddress('tankrevive@gmail.com');

        // Content
        $mail->isHTML(true);
        $mail->Subject = $clienteMail;
        $mail->Body    = nl2br($assunto);

        $mail->send();
        header("Location: ../html/specialRequest.html");
        exit();
    } catch (Exception $e) {
        echo "error: " . $mail->ErrorInfo;
    }
} else {
    echo "Invalid request method";
}
?>
