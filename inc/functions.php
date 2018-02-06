<?php

function get_project_list (){
	include 'connection.php';
	try{
		return $db->query("SELECT project_id, title, category FROM projects");
	}catch (Exception $e){
		echo "Error: ". $e->getMessage()."</br>";
		return array('');
	}
}


function add_project($title, $category){
	include 'connection.php';

	$sql = 'INSERT INTO projects (title, category) VALUE (?, ?)';
	try{
		$results = $db->prepare($sql);
		$results-> bindValue(1, $title, PDO::PARAM_STR);
		$results-> bindValue(2, $category, PDO::PARAM_STR);
		$results->execute();
	}catch(Exception $e){
		echo "Error: ". $e->getMessage() ."<br />";
		return false;
	}
	return true;
}

function edit_project($project_id, $title, $category){
	include 'connection.php';

	$sql = 'UPDATE projects SET title=?, category=? WHERE project_id = ?';
	try{
		$results = $db->prepare($sql);
		$results-> bindValue(1, $title, PDO::PARAM_STR);
		$results-> bindValue(2, $category, PDO::PARAM_STR);
		$results-> bindValue(3, $project_id, PDO::PARAM_INT);
		$results->execute();
	}catch(Exception $e){
		echo "Error: ". $e->getMessage() ."<br />";
		return false;
	}
	return true;
}


function get_task_list ($filter = null){
	include 'connection.php';
	try{
		$sql = 'SELECT tasks.*, projects.title AS project from tasks JOIN projects ON tasks.project_id = projects.project_id';
		$orderby = ' ORDER BY date DESC';
		if($orderby){
			$orderby = ' ORDER BY projects.title ASC, date DESC';
		}
		$results =  $db->prepare($sql . $orderby);
		$results->execute();
		return $results->fetchAll(PDO::FETCH_ASSOC);
	}catch (Exception $e){
		echo "Error: ". $e->getMessage()."</br>";
		return array('');
	}
}

function add_task($project_id, $title, $date, $time){
	include 'connection.php';

	$sql = 'INSERT INTO tasks (project_id, title, date, time) VALUE (?, ?, ?, ?)';
	try{
		$results = $db->prepare($sql);
		$results-> bindValue(1, $project_id, PDO::PARAM_INT);
		$results-> bindValue(2, $title, PDO::PARAM_STR);
		$results-> bindValue(3, $date, PDO::PARAM_STR);
		$results-> bindValue(4, $time, PDO::PARAM_INT);
		$results->execute();
	}catch(Exception $e){
		echo "Error: ". $e->getMessage() ."<br />";
		return false;
	}
	return true;
}


function edit_task($task_id, $project_id, $title, $date, $time){
	include 'connection.php';

	$sql = 'UPDATE tasks SET project_id = ?, title = ?, date = ?, time = ? WHERE task_id = ? ';
	try{
		$results = $db->prepare($sql);
		$results-> bindValue(1, $project_id, PDO::PARAM_INT);
		$results-> bindValue(2, $title, PDO::PARAM_STR);
		$results-> bindValue(3, $date, PDO::PARAM_STR);
		$results-> bindValue(4, $time, PDO::PARAM_INT);
		$results-> bindValue(5, $task_id, PDO::PARAM_INT);
		$results->execute();
	}catch(Exception $e){
		echo "Error: ". $e->getMessage() ."<br />";
		return false;
	}
	return true;
}

function delete_task($task_id){
	include 'connection.php';

	$sql = 'DELETE FROM tasks WHERE task_id = ?';
	try{
		
		$results = $db->prepare($sql);
		$results->bindValue(1, $task_id, PDO::PARAM_INT);
		$results->execute();
	}catch(Exception $e){
		echo "Error: ".$e;
		return false;
	}
	return true;
}