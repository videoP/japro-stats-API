<?php

	if (isset($_POST['type'])) {
   		$type = $_POST['type'];  
		$type = htmlentities(strip_tags($type));
		if (strlen($type) > 16)
            exit();
	}
	if (isset($_POST['last_update'])) {
        $last_update = $_POST['last_update'];
        if ($last_update == null)
        	$last_update = 0;
        $last_update = htmlentities(strip_tags($last_update));
        if (strlen($last_update) > 16)
            exit();
	}
	if (isset($_POST['username'])) {
          $username = $_POST['username'];  
          $username = htmlentities(strip_tags($username));
          if (strlen($username) > 16)
            exit();
	}		  
	if (isset($_POST['password'])) {
          $password = $_POST['password'];  
          $password = htmlentities(strip_tags($password));
          if (strlen($password) > 16)
            exit();
	}

	require_once('logins.php');

	if (!isset($logins[$username]) or $logins[$username] != $password) {
		echo "Bad credentials";
		exit();
	}

	require_once('db_connection.php');
          
	switch ($type) {
		case "races":
			$newArray = null;

			$stmt = $db->prepare("SELECT username, coursename, style, duration_ms, topspeed, average, end_time, rank, entries FROM LocalRun WHERE last_update > :last_update ORDER BY end_time DESC");
			$stmt->bindValue(":last_update", $last_update, SQLITE3_TEXT);
			$result = $stmt->execute();
			$exists = sql2arr2($result);
			$result->finalize();

			if($exists){
			    foreach ($exists as $key => $value) {
			    	$newArray[]=array(0=>$value["username"],1=>$value["coursename"],2=>$value["style"],3=>$value["duration_ms"],4=>$value["topspeed"],5=>$value["average"],6=>$value["end_time"],7=>$value["rank"],8=>$value["entries"]); 
			    }
			}
			$json = json_encode($newArray);
		break;

		case "duels":
		 	$newArray = null;

			$stmt = $db->prepare("SELECT winner, loser, type, duration, winner_hp, winner_shield, end_time, winner_elo, loser_elo, odds FROM LocalDuel WHERE end_time > :end_time ORDER BY end_time DESC");
			$stmt->bindValue(":end_time", $last_update, SQLITE3_TEXT);
			$result = $stmt->execute();
			$exists = sql2arr2($result);
			$result->finalize();

			if($exists){
			    foreach ($exists as $key => $value) {
			    	$newArray[]=array(0=>$value["winner"],1=>$value["loser"],2=>$value["type"],3=>$value["duration"],4=>$value["winner_hp"],5=>$value["winner_shield"],6=>$value["end_time"],7=>$value["winner_elo"],8=>$value["loser_elo"],9=>$value["odds"]); 
			    }
			}
			$json = json_encode($newArray);
		break;

		case "accounts":
		 	$newArray = null;

			$stmt = $db->prepare("SELECT username, kills, deaths, suicides, captures, returns, lastlogin, created FROM LocalAccount WHERE lastlogin > :lastlogin ORDER BY lastlogin DESC");
			$stmt->bindValue(":lastlogin", $last_update, SQLITE3_TEXT);
			$result = $stmt->execute();
			$exists = sql2arr2($result);
			$result->finalize();

			if($exists){
			    foreach ($exists as $key => $value) {
			    	$newArray[]=array(0=>$value["username"],1=>$value["kills"],2=>$value["deaths"],3=>$value["suicides"],4=>$value["captures"],5=>$value["returns"],6=>$value["lastlogin"],7=>$value["created"]); 
			    }
			}
			$json = json_encode($newArray);
		break;
	}

	ob_start('ob_gzhandler'); //Compress json
	echo $json;
	$db->close();

?>