<?php
use PHPMailer\PHPMailer\PHPMailer;

require_once 'phpmailer/Exception.php';
require_once 'phpmailer/PHPMailer.php';
require_once 'phpmailer/SMTP.php';

$mail = new PHPMailer(true);

$alert = '';

if(isset($_POST['submit'])){


  $subject = $_POST['subject'];
  $inquiry_email = $_POST['inquiry_email'];
  $message = $_POST['message'];

  try{
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'jewellsalongcong09@gmail.com'; // Gmail address which you want to use as SMTP server
    $mail->Password = 'qtvg fecm oroc fbik'; // Gmail address Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = '587';

    $mail->setFrom('donotreply@gmail.com', 'Arnold TV Motoshop'); // Gmail address which you used as SMTP server
    $mail->addAddress($_POST['inquiry_email']); // Email address where you want to receive emails (you can use any of your gmail address including the gmail address which you used as SMTP server)

    $mail->isHTML(true);
    $mail->Subject = 'Message Received (Contact Page)';
    $mail->Body = "<h2> $subject </h3> <br><small>Reply: $message" ;

    $mail->send();
    $alert = '<div class="alert-success">
                 <span>Message Reply Sent!.</span>
                </div>';
  } catch (Exception $e){
    $alert = '<div class="alert-error">
                <span>'.$e->getMessage().'</span>
              </div>';
  }
}
?>
      