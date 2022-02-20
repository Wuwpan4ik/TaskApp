<?php 
	function CheckUser($login) {
		require_once 'c.php';
		// Проверка на наличие человека с таким же loginом
		$user = $db -> query("SELECT * FROM `users` WHERE `login` =". $login);
		if  (count($user) == 0) {
			return True;
		} else {
			return False;
		}
	}
?>