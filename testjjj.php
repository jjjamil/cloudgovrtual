<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

// Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 2;                 //Enable verbose debug output
    $mail->isSMTP();                       //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';  //Set the SMTP server to send through
    $mail->SMTPAuth   = true;              //Enable SMTP authentication
    $mail->Username   = 'josephjamil0325@gmail.com';  //SMTP username (your Gmail email)
    $mail->Password   = 'jxdcysbftdhbywig';           //SMTP password (your Gmail password)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;   //Enable implicit TLS encryption
    $mail->Port       = 465;                          // TCP port to connect to

    // This is your reCAPTCHA secret key
    $recaptchaSecretKey = "6LfEntYpAAAAANSEzvP1hBogotGXwm4sQrO3HC9w";

    // Verify reCAPTCHA
    $recaptchaResponse = $_POST['g-recaptcha-response'];
    $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptchaData = array(
        'secret' => $recaptchaSecretKey,
        'response' => $recaptchaResponse
    );

    $recaptchaOptions = array(
        'http' => array(
            'method' => 'POST',
            'content' => http_build_query($recaptchaData)
        )
    );

    $recaptchaContext = stream_context_create($recaptchaOptions);
    $recaptchaResult = file_get_contents($recaptchaUrl, false, $recaptchaContext);
    $recaptchaJson = json_decode($recaptchaResult);

    if (!$recaptchaJson->success) {
        throw new Exception("reCAPTCHA verification failed");
    }

    // Get form data
    $email = $_POST['email'];
    $message = $_POST['message'];

    //Recipients
    $mail->setFrom('josephjamil0325@gmail.com', 'Mailer');
    $mail->addAddress($email);     //Add a recipient

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Test';  //Set email subject
    $mail->Body    = $message; //Set email body

    // Send email
    $mail->send();
    echo "<script>alert('Email sent successfully'); window.location.href='index.html';</script>";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
