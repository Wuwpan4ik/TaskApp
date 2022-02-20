<?php 
	function addUser($login, $password) {
		require_once 'connect.php';
		// Проверка на наличие человека с таким же loginом
		$user = $db -> query("SELECT * FROM `users` WHERE `login` =". $login);
		if  (count($user) == 0) {
			// Экспорт в базу данных
			$text = "INSERT INTO `users` (`login`, `password`) VALUES ('". $login ."', '". $password ."')";
			$db -> execute($text);
			return True;
		} else {
			return $message = 'Логин занят!';
		}
	}
	
?>