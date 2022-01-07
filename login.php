<?php
	session_start();
	require_once './config/config.php';
	require_once './config/pages.php';
	require_once INC_CONNECTION;
	require_once INC_FUNCTION;


if($_SERVER['REQUEST_METHOD'] == "POST")
{
	$user_name = $_POST['email'];
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
	}
	else
	{
		echo "Email or password cannot be empty!";
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="content">
            <div class="icon-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon-color" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path d="M12 14l9-5-9-5-9 5 9 5z" />
                    <path
                        d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                </svg>
            </div>
            <h3 class="title-login-bar">Login to your account</h3>
            <form method="post">
                <div class="margin-top-1-rem">
                    <label class="block-label" for="email">Email<label>
                            <input type="text" placeholder="Email" class="input-login" name="email">
                            <!-- <span class="empty-email">Email field is required </span> -->
                </div>
                <div class="margin-top-1-rem">
                    <label class="block-label">Password<label>
                            <input type="password" placeholder="Password" class="input-login" name="password">
                </div>
                <div class="login-container">
                    <button class="btn-login">Login</button>
                    <a href="#" class="forgot-password">Forgot password?</a>
                </div>
                <button type="submit" class="btn-new-acc">Create new account</button>
        </div>
        </form>
    </div>
    </div>
</body>

</html>