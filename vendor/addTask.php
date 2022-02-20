<?php 
	session_start();
	$text = $_POST['task__text'];
	addTask($text);
	function addTask($text) {
		require_once 'connect.php';
		require_once 'redirect.php';
		$login = $_SESSION['login'];
		//Нахождение человека с этим же логином
		$user_id = $db -> query("SELECT * FROM `users` WHERE `login` =" .'\''. $login . '\'');
		if  (count($user_id) == 1) {
			// Экспорт в базу данных
			$text = "INSERT INTO `tasks` (`user_id`, `description`) VALUES ('". $user_id[0]['id'] ."', '". $text ."')";
			$db -> execute($text);
			redirect();
		} else {
			return $message = 'Произошла ошибка';
		}
		if (!empty($message))
		{
			$message = htmlspecialchars($message);
			echo "<p class=\"error\">" . "MESSAGE: " . $message . "</p>";
		}
	}
	
?>