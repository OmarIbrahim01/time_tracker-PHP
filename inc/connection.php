<?php

try{
	$db = new PDO('mysql:dbname=time_tracker;location=localhost', 'root','');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (Exception $e){
	echo $e->getMessage();
	exit;
}