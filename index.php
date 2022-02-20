<?php 
	session_start();
	if (!isset($_SESSION['login'])) {
		header('Location: menuRegistation.php');
	}
	echo $_SESSION['login'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="slurp" content="noydir" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./assets/css/node_modules/normalize.css/normalize.css">
	<link rel="stylesheet" href="./assets/css/main.css">
	<title>TaskApp</title>
</head>
<body>
	<div class="container">
		<div class="task">
			<div class="task__title">Task list</div>
			<div class="task__main">
				<div class="task__form">
					<form action="vendor/addTask.php" method='POST'>
						<div class="form__block">
							<input class='form__input' name='task__text' type="text" placeholder='Enter text...'>
							<button type="submit" class="form__btn form__btn-black">Add task</button>
						</div>
					</form>
					<div class="form__block">
						<form action="vendor/deleteAll.php" method='POST'>
							<button type="submit" name='2' class="form__btn btn ">Remove all</button>
						</form>
						<form action="vendor/readyAll.php" method='POST'>
							<button type="submit" class="form__btn btn ">Ready all</button>
					</form>
					</div>
				</div>
				<ul class="task__list">
					<?php 
						// Вывод task
						function addTask($desc, $status, $id) {
							//Замена текста для кнопки
							$status == 'Ready' ? $statusForText = 'Unready' :  $statusForText = 'Ready';

							//Вывод текста
							$task = "<li class=\"task__item\">
										<div class=\"task__item-main\">
											<div class=\"task__item-info\">
												<div class=\"task__item-info-text\">{$desc}</div>
												<form style='display: inline-block;' action=\"./vendor/readyOnce.php\" method='POST'>
													<button name='{$statusForText}{$id}' class=\"form__btn\">{$statusForText}</button>
												</form>
												<form style='display: inline-block;' action=\"./vendor/deleteOnce.php\" method='POST'>
													<button name='delete{$id}' class=\"form__btn\">Delete</inp>
												</form>
											</div>
											<div class=\"task__item-circle {$status}\"></div>
										</div>
									</li>";

							echo $task;
						}

						//Находим id пользователя и его tasks
						require_once('./vendor/connect.php');
						$user_id = ($db -> query("SELECT * FROM `users` WHERE login = '" . $_SESSION['login'] . "'"))[0]['id'];
						$tasks = ($db -> query("SELECT `description`, `status`, `id` FROM `tasks` WHERE user_id = '". $user_id ."'"));

						if ($tasks) {
							foreach($tasks as $task) {
								addTask(htmlspecialchars($task['description']), htmlspecialchars($task['status']), htmlspecialchars($task['id']));
							}
						}
					?>	
				</ul>
			</div>
		</div>
	</div>
</body>

</html>