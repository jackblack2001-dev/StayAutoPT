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
        $mail->Password = 'SRGDT.R1H235Y24.656755.74.567K5686467LI6,5O4_869678._4,678U,Y.L6T45_6J3,6.,H.E,G6_3W46,F4,5,6.34.64';
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
