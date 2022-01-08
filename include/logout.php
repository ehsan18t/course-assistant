<?php
	session_start();
	session_destroy();
	require_once '../config/pages.php';

	if(isset($_SESSION['user_id']))
	{
		unset($_SESSION['user_id']);
	}

    ob_start();
	header('Location: .'.LOGIN_PAGE);
    ob_end_flush();
    die();
