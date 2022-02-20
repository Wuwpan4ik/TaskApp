<?php 
	require_once 'connect.php';
	$a = $db -> query("SELECT * FROM `users` WHERE `password` =".$password);
	print_r($a);
	if(isset($_POST['auth'])) {
		if (!empty($_POST['login']) && !empty($_POST['password'])) {
			$login = $_POST['login'];
			$password = $_POST['password'];
			if (count($db -> query("SELECT * FROM `users` WHERE `login` =". $login . "AND `password` =".$password)) > 0) {
				$message = 'Вы успешно авторизовались!';
			} else {
				echo count($db -> query("SELECT * FROM `users` WHERE `login` =". $login));
				$message = 'Не';
			}
		} else {
			$message = 'Все поля должны быть заполнены!';
		};
	}
	if (!empty($message))
	{
		$message = htmlspecialchars($message);
		echo "<p class=\"error\">" . "MESSAGE: " . $message . "</p>";
	}
?>
