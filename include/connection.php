<?php
require_once './config/config.php';

if(!$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)){
    die("failed to connect!");
}