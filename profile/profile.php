<!DOCTYPE html>

<html lang="en">
<?php
require_once '../header.php';
//if user is already login then this index page will be shown in browser
$user_data = check_login($con);
?>

    <title>Home Page</title>
    <link rel="stylesheet" href="../style.css">
<link rel="stylesheet" href="../css/styles.css">
<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>

<body>
<?php require_once TEM_NAV_MAIN; ?>
<?php require_once TEM_NAV_LOGGED; ?>

    <div class="wrapper">
        <div class="left">
            <img src="../img/avatar.png" alt="user" width="100">
            <h4><?php echo $user_data['f_name']." ".$user_data['l_name'];?></h4>
        </div>
        <div class="right">
            <div class="info">
                <h3>Information</h3>
                <div class="info_data">
                    <div class="data">
                        <h4>Email : </h4>
                        <p><?php echo $user_data['user_name'];?></p>
                        <br>
                        <h4>Phone</h4>
                        <p><?php echo "NOT GIVEN";?></p>
                    </div>

                </div>
            </div>

            <div class="projects">
                <h3>University</h3>
                <div class="projects_data">
                    <div class="data">
                        <h4>Name : </h4>
                        <p><?php echo $user_data['u_name'];?></p>
                    </div>
                    <div class="data">
                        <h4>Department</h4>
                        <p><?php echo $user_data['d_name'];?></p>
                    </div>
                </div>
            </div>

            <div class="social_media">
                <ul>
                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
    </div>

</body>

</html>




<!-- <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Hello <?php 
      // echo ", ".$user_data['f_name'];
    ?>
</body>
</html> -->