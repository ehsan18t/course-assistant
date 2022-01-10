<!DOCTYPE html>

<html lang="en">
<?php
    require_once './header.php';
    //if user is already login then this index page will be shown in browser
    $user_data = check_login($conn);
?>

<title>Home Page</title>
</head>

<body>
    <?php require_once TEM_NAV_MAIN; ?>
    <?php require_once TEM_NAV_LOGGED; ?>
</body>

</html>