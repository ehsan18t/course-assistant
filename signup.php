<?php
	session_start();
	require_once '/config/config.php';
	require_once '/config/pages.php';
	require_once INC_CONNECTION;
	require_once INC_FUNCTION;

	if($_SERVER['REQUEST_METHOD'] == "POST"){

    //Here we are insert in the database 
    //we take inputs from user and push them in the table 
	$f_name = $_POST['f_name'];
	$l_name = $_POST['l_name'];
	$u_name = $_POST['u_name'];
	$d_name = $_POST['d_name'];
	$user_name = $_POST['user_name'];
	$password = $_POST['password'];
	$domain = find_domain($user_name);
	if(!empty($user_name) && !empty(password)){
        //$user_id = random_num(20);    
        $query = "insert into users(f_name,l_name,u_name,d_name,user_name,password,domain) 
				values('$f_name','$l_name','$u_name','$d_name','$user_name','$password','$domain')";
		mysqli_query($con,$query);

		header("Location: login.php");
		die;
	}
	else{
		echo "user name or password is wrong";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Create Account</title>
</head>
<body>

	<style type="text/css">
	
	#text{

		height: 25px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
		width: 100%;
	}

	#button{

		padding: 10px;
		width: 100px;
		color: white;
		background-color: lightblue;
		border: none;
	}

	#box{

		background-color: grey;
		margin: auto;
		width: 600px;
		padding: 80px;
	}

	</style>

	<div id="box">
		
		<form method="post">
			<div style="font-size: 20px;margin: 10px;color: white;">Create Account</div>
			<input id="text" type="text" placeholder="Enter Your First Name" name="f_name"><br><br>
			<input id="text" type="text" placeholder="Enter Your Last Name" name="l_name"><br><br>
			<input id="text" type="text" placeholder="Enter Your University Name" name="u_name"><br><br>
			<input id="text" type="text" placeholder="Enter Your Department Name" name="d_name"><br><br>
			<input id="text" type="email" placeholder="Enter Your University email" name="user_name"><br><br>
			<input id="text" type="password" placeholder="Enter Your Password" name="password"><br><br>
			<input id="button" type="submit" value="Signup"><br><br>

			<a href="login.php">Click to Login</a><br><br>
		</form>
	</div>
</body>
</html>