<?php
	$username = $_POST["username"];
	mysql_connect("localhost","sanjeedh_sanjeed","Sanju28021991") or die("Could not connect: " . mysql_error());
	mysql_select_db("sanjeedh_marketplace");
	mysql_select_db("sanjeedh_mysql");

	$query = "SELECT * FROM sanjeedh_mysql.event WHERE user='$username'";		 
	$result = mysql_query($query);

	$res_arr_values = array();
	while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		array_push($res_arr_values, $row);
	}

	echo serialize($res_arr_values);
?>