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
    // Deprecated   -- start
    const HOME_PAGE = DOMAIN . '/index.php';
    const LOGIN_PAGE = DOMAIN . '/login.php';
    const SIGNUP_PAGE = DOMAIN . '/signup.php';
    const PROFILE_PAGE = DOMAIN . '/user/profile.php';
    //const CHANGE_PASSWORD_PAGE = DOMAIN . '/change_password.php'; // not used
    // Deprecated   -- End

    const PAGES = array(
        'home' => DOMAIN . '/index.php',
        'login' => DOMAIN . '/login.php',
        'signup' => DOMAIN . '/signup.php',
        'profile' => DOMAIN . '/user/profile.php',
        'edit-profile' =>  DOMAIN . '/user/edit-profile.php'
    );

    // Includes
    // Deprecated   -- start
    const INC_CONNECTION = INC_DOMAIN . '/include/connection.php';
    const INC_FUNCTION = INC_DOMAIN . '/include/function.php';
    const INC_SIGNUP_FUNCTION = INC_DOMAIN . '/include/signup_function.php';
    const INC_LOGOUT = DOMAIN . '/user/logout.php';
    const TEM_NAV_MAIN = INC_DOMAIN . '/template/nav-main.php';
    const TEM_NAV_LOGGED = INC_DOMAIN . '/template/nav-menu-for-logged-user.php';
    const TEM_NAV_NON_LOGGED = INC_DOMAIN . '/template/nav-menu-for-non-logged-user.php';
    // Deprecated   -- End

    const INCLUDES = array(
       'connection' => INC_DOMAIN . '/include/connection.php',
        'main-function' => INC_DOMAIN . '/include/function.php',
        'signup-function' => INC_DOMAIN . '/include/signup_function.php',
        'logout' => DOMAIN . '/user/logout.php',
        'nav-main' => INC_DOMAIN . '/template/nav-main.php',
        'nav-logged' => INC_DOMAIN . '/template/nav-menu-for-logged-user.php',
        'nav-non-logged' => INC_DOMAIN . '/template/nav-menu-for-non-logged-user.php'
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