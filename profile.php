<?php 
session_start();
include 'connection.php';

if (isset($_SESSION['id_user']))

detailsUser($_SESSION['id_user'], $connect);
?>
