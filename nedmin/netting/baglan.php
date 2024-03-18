<?php
try {

	$db = new PDO("mysql:host=localhost;dbname=DbName;charset=utf8", 'userName', 'pass');
} catch (PDOException $e) {

	echo $e->getMessage();
}
