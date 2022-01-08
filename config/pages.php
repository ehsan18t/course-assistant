<?php
    if (DB_HOST == "localhost")
    {
        define("DOMAIN", LOCAL_DOMAIN);
        define("INC_DOMAIN", $_SERVER['DOCUMENT_ROOT'] . '/course-assistant');
    }
    else
    {
        define("DOMAIN", $_SERVER['DOCUMENT_ROOT']);
        define("INC_DOMAIN", $_SERVER['DOCUMENT_ROOT']);
    }



    // Link / Pages
    const HOME_PAGE = DOMAIN . '/index.php';
    const LOGIN_PAGE = DOMAIN . '/login.php';
    const SIGNUP_PAGE = DOMAIN . '/signup.php';
    const PROFILE_PAGE = DOMAIN . '/profile/profile.php';
    const INC_LOGOUT = DOMAIN . '/include/logout.php';
    //const CHANGE_PASSWORD_PAGE = DOMAIN . '/change_password.php'; // not used

    // Includes
    const INC_CONNECTION = INC_DOMAIN . '/include/connection.php';
    const INC_FUNCTION = INC_DOMAIN . '/include/function.php';
    const TEM_NAV_MAIN = INC_DOMAIN . '/template/nav-main.php';
    const TEM_NAV_LOGGED = INC_DOMAIN . '/template/nav-menu-for-logged-user.php';
    const TEM_NAV_NON_LOGGED = INC_DOMAIN . '/template/nav-menu-for-non-logged-user.php';
