<?php 
	session_start();
	require_once 'connect.php';
	require_once 'redirect.php';
	$idTask = substr((string)key($_POST), 6);
	$db -> execute("DELETE FROM `tasks` WHERE id = '". $idTask ."'");
	redirect();
?>