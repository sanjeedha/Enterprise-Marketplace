<!DOCTYPE html>	    				
<html>
<head>
<title>List User History</title>
<link href="layout/styles/user.css" rel="stylesheet" type="text/css" media="all" />

</head>
<body>
<?php
	function compare_timestamp($a, $b)
	{
		if ($a[1] > $b[1]) {
			return 0;
		} else {
			return 1;
		}
	}

	// function sortArray($a1, $a2)
	// {
 //    	if ($a1[1] == $a2[1]) return 0;
 //    	return ($a1[2] > $a2[2]) ? -1 : 1;
	// }

	mysql_connect("localhost","sanjeedh_sanjeed","Sanju28021991") or die("Could not connect: " . mysql_error());
	mysql_select_db("sanjeedh_marketplace");
	mysql_select_db("sanjeedh_mysql");
	$history = array();
	if(isset($_COOKIE["username"]))
	{
		 $username = $_COOKIE["username"];
	}

	$query = "SELECT * FROM sanjeedh_marketplace.event WHERE user = '$username' UNION
			 SELECT * FROM sanjeedh_mysql.event WHERE user = '$username'";		 
	$result = mysql_query($query);
	if ($result)
	{
		//echo "<br><br><table class='utable' border=0 cellpadding=0 cellspacing=0 width=100%><tr class='theader'><td>History</td><td>time</td></tr>";
		while ($r = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$event = $r["event_name"];
		$timestamp = $r["timestamp"];
		$temp = array();
		array_push($temp, $event);
		array_push($temp, $timestamp);
		array_push($history, $temp);
		
	}
	}
	else {
	    die('Invalid query: ' . mysql_error());
	}

	$ch1 = curl_init();
	curl_setopt($ch1, CURLOPT_URL,"nivedithajh.com/jmp/history.php");
	curl_setopt($ch1, CURLOPT_POST, 1);
	curl_setopt($ch1, CURLOPT_POSTFIELDS, "username = $username");
	curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
	$server_output1 = curl_exec ($ch1);
	curl_close ($ch1);


	$ch2 = curl_init();
	curl_setopt($ch2, CURLOPT_URL,"http://dhivyajanakiraman.com/history.php");
	curl_setopt($ch2, CURLOPT_POST, 1);
	curl_setopt($ch2, CURLOPT_POSTFIELDS, "username = $username");
	curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
	$server_output2 = curl_exec ($ch2);
	curl_close ($ch2);
	
	$ch3 = curl_init();
	curl_setopt($ch3, CURLOPT_URL,"http://code272com.fatcow.com/wp-includes/Text/history.php");
	curl_setopt($ch3, CURLOPT_POST, 1);
	curl_setopt($ch3, CURLOPT_POSTFIELDS, "username = $username");
	curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);
	$server_output3 = curl_exec ($ch3);
	curl_close ($ch3);
    
    $ch4 = curl_init();
	curl_setopt($ch4, CURLOPT_URL,"http://shachishah27.com/phpfiles/history.php");
	curl_setopt($ch4, CURLOPT_POST, 1);
	curl_setopt($ch4, CURLOPT_POSTFIELDS, "username = $username");
	curl_setopt($ch4, CURLOPT_RETURNTRANSFER, true);
	$server_output4 = curl_exec ($ch4);
	curl_close ($ch4); 

	$ch5 = curl_init();
	curl_setopt($ch5, CURLOPT_URL,"http://rkailash.com/site/history.php");
	curl_setopt($ch5, CURLOPT_POST, 1);
	curl_setopt($ch5, CURLOPT_POSTFIELDS, "username = $username");
	curl_setopt($ch5, CURLOPT_RETURNTRANSFER, true);
	$server_output5 = curl_exec ($ch5);
	curl_close ($ch5); 
 	 
 	
	if ($server_output1)
	{
		//echo "<br><br><table class='utable' border=0 cellpadding=0 cellspacing=0 width=100%><tr class='theader'><td>History</td><td>time</td></tr>";

		$records1 = unserialize($server_output1);
		foreach ($records1 as $value) {
			$event = $value["event_name"];
			$timestamp = $value["timestamp"];	
			$temp = array();
			array_push($temp, $event);
			array_push($temp, $timestamp);
			array_push($history, $temp);
		}


	}
	if ($server_output2)
	{
		//echo "<br><br><table class='utable' border=0 cellpadding=0 cellspacing=0 width=100%><tr class='theader'><td>History</td><td>time</td></tr>";

		$records2 = unserialize($server_output2);
		foreach ($records2 as $value) {
			$event = $value["event_name"];
			$timestamp = $value["timestamp"];	
			$temp = array();
			array_push($temp, $event);
			array_push($temp, $timestamp);
			array_push($history, $temp);
		}


	}
	if ($server_output3)
	{
		//echo "<br><br><table class='utable' border=0 cellpadding=0 cellspacing=0 width=100%><tr class='theader'><td>History</td><td>time</td></tr>";

		$records3 = unserialize($server_output3);
		foreach ($records3 as $value) {
			$event = $value["event_name"];
			$timestamp = $value["timestamp"];	
			$temp = array();
			array_push($temp, $event);
			array_push($temp, $timestamp);
			array_push($history, $temp);
		}


	}
	if ($server_output4)
	{
		

		$records4 = unserialize($server_output4);
		foreach ($records4 as $value) {
			$event = $value["event_name"];
			$timestamp = $value["timestamp"];	
			$temp = array();
			array_push($temp, $event);
			array_push($temp, $timestamp);
			array_push($history, $temp);
		}


	}
	if ($server_output5)
	{
		//echo "<br><br><table class='utable' border=0 cellpadding=0 cellspacing=0 width=100%><tr class='theader'><td>History</td><td>time</td></tr>";

		$records5 = unserialize($server_output5);
		foreach ($records5 as $value) {
			$event = $value["event_name"];
			$timestamp = $value["timestamp"];	
			$temp = array();
			array_push($temp, $event);
			array_push($temp, $timestamp);
			array_push($history, $temp);
		}


	}
    usort($history, 'compare_timestamp'); 
    echo "<br><br><table class='utable' border=0 cellpadding=0 cellspacing=0 width=100%><tr class='theader'><td>History</td><td>time</td></tr>";
	
	foreach($history as $datarow) {
		echo "<tr>";
		$event = $datarow[0];
    	$timestamp = $datarow[1];
    	echo "<td>$event</td>";
		echo "<td>$timestamp</td>";
    	echo "</tr>";
    }
    echo "</table>";

	mysql_connect("localhost","sanjeedh_sanjeed","Sanju28021991") or die("Could not connect: " . mysql_error());
    mysql_select_db("sanjeedh_marketplace");
    if (isset($_COOKIE["username"])) {
		$username = $_COOKIE["username"];
		if ($username) {
			$query = "INSERT INTO `event` (`user`, `event_name`, `timestamp`) 
			   VALUES ('$username', 'http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]', UTC_TIMESTAMP())";
			$result = mysql_query($query);
		}
	}

?>
</body>
</html>