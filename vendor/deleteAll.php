<?php 
	session_start();
	//Находим id пользователя и его tasks
	require_once 'connect.php';
	require_once 'redirect.php';
	$user_id = ($db -> query("SELECT * FROM `users` WHERE login = '" . $_SESSION['login'] . "'"))[0]['id'];
	$tasks = ($db -> query("SELECT * FROM `tasks` WHERE user_id = '". $user_id ."'"));

	foreach ($tasks as $task) {
		$db -> execute("DELETE FROM `tasks` WHERE id = '". $task['id'] ."'");
	}
	redirect();
?>