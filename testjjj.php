<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 2;                 //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                      //Set the SMTP server to send through
    $mail->SMTPAuth   = true;               
    $mail->SMTPSecure = 'ssl';               //Enable SMTP authentication
    $mail->Username   = 'josephjamil0325@gmail.com';                //SMTP username (your Gmail email)
    $mail->Password   = 'jxdcysbftdhbywig';                        //SMTP password (your Gmail password)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    // TCP port to connect to
              
    
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );



    $email = $_POST['email'];
    $message = $_POST['message'];
    //Recipients
    $mail->setFrom('josephjamil0325@gmail.com', 'Mailer');
    $mail->addAddress($email);     //Add a recipient



    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Test';                                  //Set email format to HTML
    $mail->Body    = $message;
 

    $mail->send();
    echo "<script>alert('Email sent successfully'); window.location.href='index.html';</script>";

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}