<?php
try {

	$db = new PDO("mysql:host=localhost;dbname=muhadefter_81;charset=utf8", 'muhadefter', 'eKknTQFTuT');
	// echo 'baglandı Basarılı';
} catch (PDOException $e) {

	echo $e->getMessage();
}
