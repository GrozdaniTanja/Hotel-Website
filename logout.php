<?php

// --------------------------------------------------------LOG OUT PAGE------------------------------------------------//
require('includes/config.inc.php');
$page_title = 'Hotel Grozdani';
include('includes/header2.php');

// If the username is not stored in the session, redirect the user
if (!isset($_SESSION['username'])) {

	$url = BASE_URL . 'index.php';
	header("Location: $url");
	exit();

} else { // Otherwise, log out the user

	$_SESSION = array(); // Clear session variables
	session_destroy(); // Destroy the session
	setcookie(session_name(), '', time() - 3600); // Delete cookies

	sleep(1.7);
	$url = BASE_URL . 'index.php';
	header("Location: $url");
	exit();
}

// Print message
?>