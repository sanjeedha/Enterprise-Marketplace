<!DOCTYPE html>

<html>
<head>
<title>List User</title>
<link href="layout/styles/user.css" rel="stylesheet" type="text/css" media="all" />

</head>
<body>
<?php

	mysql_connect("localhost","sanjeedh_sanjeed","Sanju28021991") or die("Could not connect: " . mysql_error());
	mysql_select_db("sanjeedh_marketplace");
	$query = "SELECT * FROM market_users";         
	$result = mysql_query($query);
	//echo $result;
	if ($result)
	{
		echo "<br><br><table class='utable' border=0 cellpadding=0 cellspacing=0 width=100%><tr class='theader'><td>First Name</td><td>Last Name</td><td>E-Mail</td><td>Address</td><td>Home Phone</td><td>Cell Phone</td></tr>";
		while ($r = mysql_fetch_array($result, MYSQL_ASSOC)) {
		echo "<tr>";
		$tmp = $r["first_name"];
		echo "<td>$tmp</td>";
		$tmp = $r["last_name"];
		echo "<td>$tmp</td>";
		$tmp = $r["email"];
		echo "<td>$tmp</td>";
		$tmp = $r["address"];
		echo "<td>$tmp</td>";
		$tmp = $r["h_phone"];
		echo "<td>$tmp</td>";
		$tmp = $r["c_phone"];
		echo "<td>$tmp</td>";
		echo "</tr>";
	}
	echo "</table>";
	}
	else {
	    die('Invalid query: ' . mysql_error());
	}

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