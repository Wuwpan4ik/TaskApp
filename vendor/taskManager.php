<?php 
	session_start();
	require_once 'connect.php';
	require_once 'redirect.php';
	class Task {
		public function addTask($db) {
			$text = $_POST['task__text'];
			$db -> execute("INSERT INTO `tasks` (`user_id`, `description`) VALUES ('". $_SESSION['id'] ."', '". $text ."')");
			redirect();
		}

		public function deleteTask($id_task, $db) {
			$db -> execute("DELETE FROM `tasks` WHERE id = '". $id_task ."'");
			redirect();
		}

		public function readyTask($id_task, $db) {
			$db -> execute("UPDATE `tasks` SET `status` = 'Ready' WHERE id = '". $id_task ."'");
			redirect();
		}

		public function unReadyTask($id_task, $db) {
			$db -> execute("UPDATE `tasks` SET `status` = 'Unready' WHERE id = '". $id_task ."'");
			redirect();
		}

		public function readyAll($db) {
			$tasks = ($db -> query("SELECT * FROM `tasks` WHERE user_id = '". $_SESSION['id'] ."'"));
			foreach ($tasks as $task) {
				$db -> execute("UPDATE `tasks` SET `status` = 'Ready' WHERE id = '". $task['id'] ."'");
			}
			redirect();
		}

		public function deleteAll($db) {
			$tasks = ($db -> query("SELECT * FROM `tasks` WHERE user_id = '". $_SESSION['id'] ."'"));
			foreach ($tasks as $task) {
				$db -> execute("DELETE FROM `tasks` WHERE id = '". $task['id'] ."'");
			}
			redirect();
		}
	}
	if (isset($_POST)) {
		$task = new Task();
		if (in_array('addTask', array_keys($_POST))) {
			$task->addTask($db);
		} elseif (in_array('deleteAll', array_keys($_POST))) {
			$task->deleteAll($db);
		} elseif (in_array('readyAll', array_keys($_POST))) {
			$task->readyAll($db);
		} else {
			if (substr(array_keys($_POST)[0], 0, 5) == 'Ready') {
				$id_task = substr(array_keys($_POST)[0], 5);
				$task->readyTask($id_task, $db);
			} elseif (substr(array_keys($_POST)[0], 0, 6) == 'delete') {
				$id_task = substr(array_keys($_POST)[0], 6);
				$task->deleteTask($id_task, $db);
			} elseif (substr(array_keys($_POST)[0], 0, 7) == 'Unready') {
				$id_task = substr(array_keys($_POST)[0], 7);
				$task->unReadyTask($id_task, $db);
			}
		}
	}
?>