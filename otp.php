<?php
    require_once './header.php';
    require_once './sendOTP.php';

    if (!isset($_GET['u'])) {
        header("Location: " . PAGES['login']);
    }

    $uid = $_GET['u'];
    $otp = mysqli_query($conn, "SELECT * FROM otp WHERE uid=$uid");
    $user  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE u_id=$uid"));
    $isSuccess = false;

    if(mysqli_num_rows($otp) > 0){
        $otp=mysqli_fetch_assoc($otp)['otp'];
    } else {
        header("Location: " . PAGES['login']);     
    }

    if(isset($_POST['otp']))
    {
        $u_otp = $_POST['otp'];
        unset($_POST['otp']);

        if ($otp == $u_otp) {
            mysqli_query($conn, "UPDATE users SET isActive = '1' WHERE u_id='$uid'");
            mysqli_query($conn, "DELETE FROM otp WHERE uid='$uid'");
            $isSuccess = true;
        } else {
            echo "<div class='otp-warning'>OTP not matched!</div>";
        }
    }

    if (isset($_POST['resend'])) {
        unset($_POST['resend']);
        sendOTP($user, $otp);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <link rel="stylesheet" href="<?php echo CSS['otp.css']."?".time(); ?>">
</head>
<body>
    <?php
    if ($isSuccess) { ?>
    <div class="otp-success">
        <p>OTP varification complete! </p>
        <p> You can <a href="<?php echo PAGES['login']; ?>"> login now </a> </p>
    </div>
    <?php } else { ?>
    <div class="otp-field">
        <form method="post" class="otp-form">
            <input type="number" name="otp" id="otp" placeholder="Enter Your OTP">
            <button class="btn-otp-submit" type="submit">Submit</button>
        </form>
        
        <form method="post">
            <input type="hidden" name="resend" id="resend">
            <button class="btn-otp-resend" type="submit">Resend OTP</button>
        </form>
    </div>
    <?php } ?>
</body>
</html>