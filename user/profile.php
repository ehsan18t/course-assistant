<!DOCTYPE html>

<html lang="en">
<?php
require_once '../header.php';
//if user is already login then this index page will be shown in browser
$user_data = check_login($conn);
?>

    <title>Home Page</title>
    <link rel="stylesheet" href="<?php echo CSS['style.css'] ?>">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>

<body>
<?php //require_once INCLUDES['nav-main-template']; ?>
<?php //require_once INCLUDES['nav-logged-template']; ?>

    <div class="wrapper">
        <div class="left">
            <img src="<?php echo $user_data['profile_pic_url']; ?>" alt="user" width="100px" height="100px">
            <h4><?php echo $user_data['f_name']." ".$user_data['l_name'];?></h4>
        </div>
        <div class="right">
            <div class="info">
                <h3>Information</h3>
                <div class="info_data">
                    <div class="data">
                        <h4>Email : </h4>
                        <p><?php echo $user_data['email'];?></p>
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
                        <p><?php echo $user_data['university'];?></p>
                    </div>
                    <div class="data">
                        <h4>Department</h4>
                        <p><?php echo $user_data['department'];?></p>
                    </div>
                </div>
            </div>

            <div class="social_media">
                <ul>
                    <li><a href="edit-profile.php"><i class="#">Edit</i></a></li>
                    <li><a href="change-profile-picture.php"><i class="#"></i>Change Picture</a></li>
                    <!-- <li><a href="#"><i class="fab fa-instagram"></i></a></li> -->
                    <!-- <a class="btn btn-success" href="edit-profile.php">Edit</a>
                    <a class="btn btn-success" href="change-profile-picture.php">Change Picture</a> -->
                </ul>
            </div>
        </div>
    </div>

</body>

</html>
