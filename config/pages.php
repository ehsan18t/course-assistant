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
        'stats' => DOMAIN . '/stats/',
        'trimesters' => DOMAIN . '/stats/',
        'courses' => DOMAIN . '/stats/courses.php',
        'assess' => DOMAIN . '/stats/assessments.php',
        'edit-profile' =>  DOMAIN . '/user/edit-profile.php',
        'change-profile-pic' =>  DOMAIN . '/user/change-profile-picture.php',
        'logout' => DOMAIN . '/user/logout.php',
        'add-post' => DOMAIN . '/post/addPost.php',
        'chat' => DOMAIN . '/chat/',
        'group' => DOMAIN . '/study-group/',
        'private-chat' => DOMAIN . '/chat/private.php',
        'group-chat' => DOMAIN . '/study-group/group.php',
        'request' => DOMAIN.'/request/all_request.php',
        'add_request' => DOMAIN.'/request/my_request.php',
        'rating' => DOMAIN.'/request/rating.php'
    );

    // Includes
    const INCLUDES = array(
        'connection' => INC_DOMAIN . '/include/connection.php',
        'main-function' => INC_DOMAIN . '/include/main-function.php',
        'addPost-function' => INC_DOMAIN . '/include/add-post-function.php',
        'addRequest-function' => INC_DOMAIN . '/include/add-request-function.php',// new added
        'view-post-function' => INC_DOMAIN . '/include/view-post-function.php',
        'signup-function' => INC_DOMAIN . '/include/signup-function.php',
        'result-calculation-function' => INC_DOMAIN . '/include/result-calculation-functions.php',
        'group-function' => INC_DOMAIN . '/include/group-functions.php',
        'edit-profile-function' => INC_DOMAIN . '/include/edit-profile-function.php',
        'nav-main-template' => INC_DOMAIN . '/template/nav-main.php',
        'nav-logged-template' => INC_DOMAIN . '/template/nav-menu-for-logged-user.php',
        'nav-non-logged-template' => INC_DOMAIN . '/template/nav-menu-for-non-logged-user.php'
    );

    // Resources
    const CSS = array(
        'styles.css' => DOMAIN . '/css/styles.css',
        'profile.css' => DOMAIN . '/css/profile.css',
        'post.css' => DOMAIN . '/css/post.css',
        'modal.css' => DOMAIN . '/css/modal.css',
        'stats.css' => DOMAIN . '/css/stats.css',
        'chat.css' => DOMAIN . '/css/chat.css'
    );

    const JS = array(
        'toggle-visibility.js' => DOMAIN . '/js/toggle-visibility.js'
    );

    const IMG = array(
        'avatar' =>  DOMAIN . '/img/avatar.png'
    );

    const DIR = array(
        'uploads' => DOMAIN . '/uploads/',
        'files' => DOMAIN . '/uploads/files/',
        'picture' => DOMAIN . '/uploads/picture/'
    );

    const INC_DIR = array(
        'uploads' => INC_DOMAIN . '/uploads/',
        'files' => INC_DOMAIN . '/uploads/files/',
        'picture' => INC_DOMAIN . '/uploads/picture/'
    );