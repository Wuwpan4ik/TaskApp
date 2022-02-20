<?php 
	//Моментальный редирект
	require_once('redirect.php');
	require_once ('connect.php');
	if(isset($_POST['auth'])) {
		if (!empty($_POST['login']) && !empty($_POST['password'])) {
			$login = (string) $_POST['login'];
			$password = (string) $_POST['password'];
			if (count($db -> query("SELECT * FROM `users` WHERE `login` =" . '\'' . $login . '\'' . " AND `password` =" . '\'' .$password .'\'')) > 0) {
				$message = 'Вы успешно авторизовались!';
				$_SESSION['login'] = $login;
				redirect();
			} else { 
				$message = 'Неправильный пароль';
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