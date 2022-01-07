<!DOCTYPE html>

<html lang="en">
<?php 
    require_once 'header.php';     
    //if user is already login then this index page will be shown in browser
    $user_data = check_login($con);
?>

<title>Home Page</title>
</head>

<body>
    <?php require_once 'template/nav-main.php'; ?>
    <?php require_once 'template/nav-menu-for-logged-user.php'; ?>
</body>

</html>