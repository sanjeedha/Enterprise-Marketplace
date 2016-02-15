<!DOCTYPE html>

<html>
<head>
<title>Create User</title>
<link href="layout/styles/user.css"  rel="stylesheet" type="text/css" media="all" />

</head>
<body>
<?php

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

<div class="user">
	<div class="container">
		<div class="user-header">
			<h3 class="tittle">New User</h3>
		</div>
		<div class="user-gds">
			<div class="col-md-6 user-top">
				<form method="POST" action = "">
					<div class="con-text">
					 	<span>First Name </span>		
						<input name="f_name" type="text" value="" >						
					</div>
					<div class="con-text">
						<span>Last Name </span>		
						<input name="l_name" type="text" value="" >						
					</div>
					<div class="con-text">
					  <span>Email </span>		
					  <input name="mail" type="text" value="" >						
					</div>
					<div class="con-text">
					  <span>Address </span>		
					  <input name="h_address" type="text" value="" >						
					</div>
					<div class="con-text">
					  <span>Home Phone </span>		
					  <input name="h_phone" type="text" value="" >						
					</div>
					<div class="con-text">
					  <span>Cell Phone </span>		
					  <input name="c_phone" type="text" value="" autocomplete="off">						
					</div>
					<div class="con-text">
					  <span>Password </span><br>	
					  <input name="password" type="password" value="" autocomplete="off" >						
					</div><br>

					<input type="submit" value="SEND" >
				</form>
				<br>
				<br>
				
			</div>
		</div>
	</div>
</div>
</body>
<?php
if(!empty($_POST))
	{
	$f_name = "";
	$l_name = "";
	$mail = "";
	$h_address = "";
	$h_phone = "";
	$c_phone = "";

	if(isset($_POST["f_name"])) {
		$f_name = $_POST["f_name"];
		if($f_name)
		{
			if(!preg_match("/^[a-z_]+$/i", $f_name))
			{
				echo "<p class='errormsg'> Invalid First Name!</p>";
				die();
			}
		}
	}

	if(isset($_POST["l_name"])) {
		$l_name = $_POST["l_name"];
		if($l_name)
		{
			if(!preg_match("/^[a-z_]+$/i", $l_name))
			{
				echo "<p class='errormsg'> Invalid Last Name!</p>";
				die();
			}
		}
	}

	if(isset($_POST["mail"])) {
		$mail = $_POST["mail"];
		if($mail){
			$reg = '/^([\w\.-]+)@([\w\.-]+)\.([a-z\.]{2,6})$/';

			if (!preg_match($reg, $mail))
			{
				echo "<p class='errormsg'> Invalid E-mail Address!</p>";
				die();
			}
		}
		
	}
	
	if(isset($_POST["h_address"])) {
		$h_address = $_POST["h_address"];
	}

	if(isset($_POST["h_phone"])) {
		$h_phone = $_POST["h_phone"];
		if($h_phone) {
			$reg = '/^(?:\+?1[-. ]?)?\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/';
		
			if (!preg_match($reg, $h_phone))
			{
				echo "<p class='errormsg'> Invalid Home-phone Number!</p>";
				die();
			}
			$h_phone = str_replace("-", "", $h_phone);
			$h_phone = str_replace(".", "", $h_phone);
			$h_phone = str_replace("(", "", $h_phone);
			$h_phone = str_replace(")", "", $h_phone);
			$h_phone = str_replace(" ", "", $h_phone);
		}
	}

	if(isset($_POST["c_phone"])) {
		$c_phone = $_POST["c_phone"];
		if($c_phone) {
			$reg = '/^(?:\+?1[-. ]?)?\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/';
			
			if (!preg_match($reg, $c_phone))
			{
				echo "<p class='errormsg'> Invalid Cell-phone Number!</p>";
				die();
			}
			$c_phone = str_replace("-", "", $c_phone);
			$c_phone = str_replace(".", "", $c_phone);
			$c_phone = str_replace("(", "", $c_phone);
			$c_phone = str_replace(")", "", $c_phone);
			$c_phone = str_replace(" ", "", $c_phone);
		}
	}

	if(isset($_POST["password"])){
		$password = $_POST["password"];
	}

	if ($f_name or $l_name) {
		$dbh3 = mysql_connect("localhost","sanjeedh_sanjeed","Sanju28021991");
		//echo "Connected to market"."<br>";
	    mysql_select_db("sanjeedh_marketplace",$dbh3);
	    $query = "INSERT INTO `market_users` (`first_name`, `last_name`, `email`, `address`, `h_phone`, `c_phone`,`password`) 
	             VALUES ('$f_name', '$l_name', '$mail', '$h_address', '$h_phone', '$c_phone','$password')";
	    $result = mysql_query($query);

	    if ($result) {
	    	echo "<p class='acceptmsg'> User $f_name added !</p>"; 
	    	header('Location: index.php');
	    } else {
	        die('Invalid query: ' . mysql_error());
	    }
	   }
mysql_close();
		
if ($f_name or $l_name) {
	    $dbh2 = mysql_connect("localhost","sanjeedh_sanjeed","Sanju28021991",TRUE);
		//echo "conncted to sanjeedha db"."<br>";
		mysql_select_db('sanjeedh_mysql',$dbh2);
		//echo "This line worked";

		$query = "INSERT INTO `users` (`fname`, `lname`, `email`, `address`, `hphone`, `cphone`, `password`) 
	             VALUES ('$f_name', '$l_name', '$mail', '$h_address', '$h_phone', '$c_phone', '$password')";
	    $result = mysql_query($query);

	    if ($result) {
	    	echo "success"; 
	    } else {
	        die('Invalid query: ' . mysql_error());
	    }
	    mysql_close();

	    // Niveditha
	    $ch = curl_init();

		curl_setopt($ch, CURLOPT_URL,"http://nivedithajh.com/jmp/index.php/index.php?option=com_content&view=article&id=30");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,
		            "firstname=$f_name&lastname=$l_name&email=$mail&address=$h_address&home_phone=$h_phone&cell_phone=$c_phone");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec ($ch);
		curl_close ($ch);
		if ($server_output == "OK") { echo "Nivi success";  } else { "Nivi connection failed."; }

		// Dhivya
		$ch1 = curl_init();

		curl_setopt($ch1, CURLOPT_URL,"http://dhivyajanakiraman.com/addintodb.php");
		curl_setopt($ch1, CURLOPT_POST, 1);
		curl_setopt($ch1, CURLOPT_POSTFIELDS,
		            "first=$f_name&last=$l_name&email=$mail&address=$h_address&homenum=$h_phone&cellnum=$c_phone");
		curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
		$server_output1 = curl_exec ($ch1);
		curl_close ($ch1);
		if ($server_output1 == "OK") { echo "Dhivya success";  } else { "Dhivya connection failed."; }


		$ch2 = curl_init();

		curl_setopt($ch2, CURLOPT_URL,"http://rkailash.com/site/create.php");
		curl_setopt($ch2, CURLOPT_POST, 1);
		curl_setopt($ch2, CURLOPT_POSTFIELDS,
		            "FIRSTNAME=$f_name&LASTNAME=$l_name&EMAIL=$mail&HOMEADDRESS=$h_address&HOMEPHONE=$h_phone&CELLPHONE=$c_phone");
		curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
		$server_output1 = curl_exec ($ch2);
		curl_close ($ch2);
		if ($server_output1 == "OK") { echo "roshni success";  } else { "Roshni connection failed."; }

		$ch3 = curl_init();

		curl_setopt($ch3, CURLOPT_URL,"http://www.shachishah27.com/phpfiles/adduser.php");
		curl_setopt($ch3, CURLOPT_POST, 1);
		curl_setopt($ch3, CURLOPT_POSTFIELDS,
		            "fn=$f_name&ln=$l_name&email=$mail&addr=$h_address&phn=$h_phone&cell=$c_phone");
		curl_setopt($ch3, CURLOPT_RETURNTRANSFER, true);
		$server_output1 = curl_exec ($ch3);
		curl_close ($ch3);
		if ($server_output1 == "OK") { echo "sachi success";  } else { "sachi connection failed."; }

	    

        $ch4 = curl_init();

		curl_setopt($ch4, CURLOPT_URL,"http://code272com.fatcow.com/wp-includes/Text/form.php");
		curl_setopt($ch4, CURLOPT_POST, 1);
		curl_setopt($ch4, CURLOPT_POSTFIELDS,
		            "FIRSTNAME=$f_name&LASTNAME=$l_name&EMAIL=$mail&ADDRESS=$h_address&HOMEPHONE=$h_phone&CELLPHONE=$c_phone");
		curl_setopt($ch4, CURLOPT_RETURNTRANSFER, true);
		$server_output1 = curl_exec ($ch4);
		curl_close ($ch4);
		if ($server_output1 == "OK") { echo "shubra success";  } else { "shubra connection failed."; }



	}
}
?>
</html>