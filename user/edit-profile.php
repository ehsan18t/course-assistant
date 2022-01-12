<!DOCTYPE html>

<html lang="en">
<?php
    require_once '../header.php';
    $user_data = check_login($conn);
    require_once INCLUDES['edit-profile-function'];
    edit_profile($conn, $_POST, $user_data['email']);
?>

<title>Home Page</title>
</head>

<body style="
  --tw-bg-opacity: 1;
  background-color: rgb(229 231 235 / var(--tw-bg-opacity));">
<?php require_once INCLUDES['nav-main-template']; ?>
<?php require_once INCLUDES['nav-logged-template']; ?>

<div class="container" style="min-height: auto">
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
        <h3 class="title-login-bar">Edit Profile</h3>
        <form method="post">
            <!-- Name -->
            <div class="content-block">
                <div class="first-of-two">
                    <label class="block-label" for="firstName">First Name<label>
                            <input type="text" name="firstName" placeholder="First Name" class="input-login">
                </div>
                <div class="second-of-two">
                    <label class="block-label" for="lastName">Last Name<label>
                            <input type="text" name="lastName" placeholder="Last Name" class="input-login">
                </div>
            </div>
            <div class="login-container"><button type="submit" name="save" class="btn-register">save</button>
            </div>
    </div>
    </form>
</div>
</div>
</body>

</html>