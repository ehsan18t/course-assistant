<?php
    require_once './header.php';
    require_once INCLUDES['sendmail-function'];

function sendOTP($user, $otp) {
    $uid = $user['u_id']; 
    $subject = "EduShareHub Activation OTP";
    $sender = "edusharehub33@gmail.com";
    $receiver = $user['email'];
    $body = "Your OTP: ".$otp."<br> Activation Page: http://localhost/edusharehub/otp.php?u=".$uid."<br>";

    $result = sendMail($subject, $sender, $receiver, $body);

    if ($result === true) {
        echo "OTP sent successfully!";
    } else {
        echo $result;
    }       
}
