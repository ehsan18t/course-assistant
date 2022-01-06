<?php
session_start();
include("connection.php");
include("function.php");


if($_SERVER['REQUEST_METHOD'] == "POST")
{
  
  $user_name = $_POST['user_name'];
  $password = $_POST['password'];

  if(!empty($user_name) && !empty($password) )
  {

    //here we read from database and verify the username and password
    $query = "select * from users where user_name = '$user_name' limit 1";
    $result = mysqli_query($con, $query);

    if($result)
    {
      if($result && mysqli_num_rows($result) > 0)
      {

        $user_data = mysqli_fetch_assoc($result);
        
        if($user_data['password'] === $password)
        {

          $_SESSION['user_name'] = $user_data['user_name'];
          header("Location: index.php");
          die;
        }
      }
    }
    
    echo "wrong username or password!";
  }else
  {
    echo "wrong username or password!";
  }
}

  
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
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
		width: 300px;
		padding: 20px;
	}

	</style>

<div id="box">
		
		<form method="post">
			<div style="font-size: 20px;margin: 10px;color: white;">Login</div>

			<input id="text" type="text" placeholder="Enter Your email" name="user_name"><br><br>
			<input id="text" type="password" placeholder="Enter Your Password" name="password"><br><br>

			<input id="button" type="submit" value="Login"><br><br>

			<a href="signup.php">Click to Signup</a><br><br>
		</form>
	</div>
</body>
</html>