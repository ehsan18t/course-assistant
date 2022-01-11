<?php
	session_start();
	session_destroy();
	require_once '../config/config.php';

	if(isset($_SESSION['email']))
	{
		unset($_SESSION['email']);
	}

    ob_start();
	header('Location: ' . PAGES['login']);
    ob_end_flush();
    die();
