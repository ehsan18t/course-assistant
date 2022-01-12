<!DOCTYPE html>

<html lang="en">
<?php
    require_once './header.php';

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(!empty($email) && !empty($password) )
        {
            //here we read from database and verify the username and password
            $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
            $result = mysqli_query($conn, $query);

            if($result)
            {
                if(mysqli_num_rows($result) > 0)
                {
                    $_SESSION['email'] = $email;
                    header("Location: ". PAGES['home']);
                    die;
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo CSS['styles.css'] ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>Sign In</title>
</head>

<body>
    <?php require_once INCLUDES['nav-main-template']; ?>
    <?php require_once INCLUDES['nav-non-logged-template']; ?>
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
            <form action="<?php echo PAGES['login']; ?>" method="post">
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
                    <button type="submit" class="btn-login">Login</button>
                    <a href="#" class="forgot-password">Forgot password?</a>
                </div>
                <a href="<?php echo PAGES['signup']; ?>">
                    <div class="btn-new-acc">Create new account</div>
                </a>
        </div>
        </form>
    </div>
    </div>
</body>

</html>