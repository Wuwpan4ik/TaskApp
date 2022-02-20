<?php  
	function redirect() {
		header($_SERVER['DOCUMENT__ROOT']. 'index.php');
		exit();
	}
?>