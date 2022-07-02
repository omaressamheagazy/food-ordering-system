<?php
session_start(); //start session
session_destroy(); // distroy all the current sessions
$url = 'login5.php';
// header('Location: ' . $url); // redireted to login page
header('Location: index.php'); // redireted to login page

?>