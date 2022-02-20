<?php 
	session_start();
	require_once('addUser.php');
	require_once('redirect.php');
	if(isset($_POST['register'])) {
		if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])) {
			$login = $_POST['login'];
			$password = $_POST['password'];
			$confirm_password = $_POST['confirm_password'];
				if ($password == $confirm_password) {
					addUser($login, $password);
					$_SESSION['login'] = $login;
					redirect();
				} else {
					$message = 'Пароли разные!';
				};
			};
		} else {
			$message = 'Все поля должны быть заполнены!';
		};
	if (!empty($message))
	{
		$message = htmlspecialchars($message);
		echo "<p class=\"error\">" . "MESSAGE: " . $message . "</p>";
	}
?>