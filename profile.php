<?php
session_start();
	require_once './config/config.php';
	require_once './config/pages.php';
require_once INC_CONNECTION;
require_once INC_FUNCTION;
//if user is already login then this index page will be shown in browser
$user_data = check_login($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Hello <?php 
    echo ", ".$user_data['f_name'];
    ?>
</body>
</html>