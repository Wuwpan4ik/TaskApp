<?php 
	session_start();
	require_once 'redirect.php';
	function readyOnce($value, $id) {
		require_once 'connect.php';
		$db -> execute("UPDATE `tasks` SET `status` = '". $value ."' WHERE id = '". $id ."'");
	}
	if (substr((string)key($_POST),0, 7) == 'Unready') {
		readyOnce('Unready', substr((string)key($_POST), 7));
	} elseif (substr((string)key($_POST), 0, 5) == 'Ready') {
		readyOnce('Ready', substr((string)key($_POST), 5));
	}
	redirect();
?>