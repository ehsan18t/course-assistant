<?php
    if (DB_HOST == "localhost")
    {
        define("DOMAIN", SITE_DOMAIN.SITE_DIR);
        define("INC_DOMAIN", $_SERVER['DOCUMENT_ROOT'] . SITE_DIR);
    }
    else
    {
        define("DOMAIN", $_SERVER['DOCUMENT_ROOT']);
        define("INC_DOMAIN", $_SERVER['DOCUMENT_ROOT']);
    }

    // Link / Pages
    const PAGES = array(
        'home' => DOMAIN . '/index.php',
        'login' => DOMAIN . '/login.php',
        'signup' => DOMAIN . '/signup.php',
        'profile' => DOMAIN . '/user/profile.php',
        'edit-profile' =>  DOMAIN . '/user/edit-profile.php',
        'logout' => DOMAIN . '/user/logout.php',
        'add_post' => DOMAIN . '/post/addPost.php'
    );

    // Includes
    const INCLUDES = array(
        'connection' => INC_DOMAIN . '/include/connection.php',
        'main-function' => INC_DOMAIN . '/include/function.php',
        'addPost-function' => INC_DOMAIN . '/include/addPost_Function.php',
        'view-post-function' => INC_DOMAIN . '/include/view-post-function',
        'signup-function' => INC_DOMAIN . '/include/signup_function.php',
        'edit-profile-function' => INC_DOMAIN . '/include/edit-profile-function.php',
        'nav-main-template' => INC_DOMAIN . '/template/nav-main.php',
        'nav-logged-template' => INC_DOMAIN . '/template/nav-menu-for-logged-user.php',
        'nav-non-logged-template' => INC_DOMAIN . '/template/nav-menu-for-non-logged-user.php'
    );

    // Resources
    const CSS = array(
        'styles.css' => DOMAIN . '/css/styles.css',
        'style.css' => DOMAIN . '/css/style.css'
    );

    const IMG = array(
        'avatar' =>  DOMAIN . '/img/avatar.png'
    );

    const DIR = array(
        'uploads' => DOMAIN . '/uploads/'
    );

    const INC_DIR = array(
        'uploads' => INC_DOMAIN . '/uploads/'
    );