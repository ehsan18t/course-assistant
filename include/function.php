<?php


function check_login($con)
{

	if(isset($_SESSION['user_name']))
	{

		$id = $_SESSION['user_name'];
		$query = "select * from users where user_name = '$id' limit 1";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{

			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}

	header("Location: login.php");
	die;

}

function random_num($length)
{
   //this is for user_id
	$text = "";
	if($length < 5)
	{
		$length = 5;
	}

	$len = rand(4,$length);

	for ($i=0; $i < $len; $i++) { 
		$text .= rand(0,9);
	}

	return $text;
}

function find_domain($user_name){
	$start = strripos($user_name,"@");
    $length = strlen($user_name);
    $domain = substr($user_name,$start+1,$length);
    return $domain;
}