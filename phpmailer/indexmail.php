<?php
require 'include/PHPMailer.php';
require 'include/SMTP.php';
require 'include/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail=new PHPMailer();
$mail->isSMTP();
// $mail->SMTPDebug=3;
$mail->isHTML(true);
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->SMTPOptions = array(
    'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
    )
    );
$mail->Username = "laptopcomputer171@gmail.com";
$mail->Password = "Aqzx@123";
$mail->Subject = "Password Reset";
$mail->setFrom("laptopcomputer171@gmail.com");

if(isset($_GET['crreset'])){
$mail->Body = "Hii, $username. 
Click Hear To Reset Password http://localhost/final-project/mymechanic/Reset_password.php?crmail=$email";
}
else{
    $mail->Body = "Hii, $username. 
Click Hear To Reset Password http://localhost/final-project/mymechanic/Reset_password.php?grmail=$email";
}

$mail->addAddress($email);
if($mail->Send()){
    $alertsuccess = "check Your mail box for reset password!!";

}else{
    $alerterror = "Sending mail failed!!!";

}
$mail->smtpClose();
?>
