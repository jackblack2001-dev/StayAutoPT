<?php

require_once("src/PHPMailer.php");
require_once("src/SMTP.php");
require_once("src/Exception.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function ShootMail($subject, $message, $Mail)
{
    try {
        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'StayAutoPortugal@gmail.com';
        $mail->Password = 'Something here :3';
        $mail->Port = 587;

        $mail->setFrom('StayAutoPortugal@gmail.com');
        $mail->addAddress($Mail);

        $mail->isHTML(true);

        $mail->Subject = $subject;
        $mail->Body    = nl2br($message);
        $mail->AltBody = nl2br(strip_tags($message));

        $_SESSION["Email"] = $Mail;

        if (!$mail->send()) {
            header('Location:' . ROOT_PATH . 'AfterRegister.php?isS=' . base64_encode(false));
        } else {
            header('Location:' . ROOT_PATH . 'AfterRegister.php?isS=' . base64_encode(true));
        }
    } catch (Exception $e) {
        echo "erro: {$mail->ErrorInfo}";
    }
}
