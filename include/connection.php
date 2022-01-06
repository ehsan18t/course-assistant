<?php

$dbhost ="localhost";
$dbuser ="root";
$dbpass ="";
$dbname ="course_assistant";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname)){
    die("failed to connect!");
}