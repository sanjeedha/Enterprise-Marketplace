<?php

if(!empty($_POST))
	{
	$password = "";
	$email = "";
	

	if(isset($_POST["email"])) {
		$email = $_POST["email"];
		if($email){
			$reg = '/^([\w\.-]+)@([\w\.-]+)\.([a-z\.]{2,6})$/';

			if (!preg_match($reg, $email))
			{
				//echo "<p class='errormsg'> Invalid E-mail Address!</p>";
				die();
			}
		}
		
	}
	
	if(isset($_POST["password"])) {
		$password = $_POST["password"];
	}

	
	
	if ($email and $password) {
		mysql_connect("localhost","sanjeedh_sanjeed","Sanju28021991") or die("Could not connect: " . mysql_error());
	    mysql_select_db("sanjeedh_marketplace");
	    $query = sprintf("SELECT COUNT(*) as c FROM market_users WHERE email = '%s'",
			    mysql_real_escape_string($email));
	    $result = mysql_query($query);

	    if ($result) {
	    	
	    	$value = mysql_fetch_object($result);
	    	if (intval($value->c) == 1)
	    	{
	    		$query1 = sprintf("SELECT COUNT(*) as c FROM market_users WHERE email = '%s' AND password = '%s'",
			    mysql_real_escape_string($email),
			    mysql_real_escape_string($password));
	    		$result1 = mysql_query($query1);

	    		if(result1)
	    		{
	    			$value1 = mysql_fetch_object($result1);
	    			if(intval($value1->c) == 1)
	    			{
	    				
	    				if(!isset($_COOKIE["username"]))
	    				{
	    					setcookie("username",$email);
	    				}
	    				header('Location: index.php');
	    				
	    			}
	    			else
	    			{
	    				echo("password not valid");
	    			}
	    		}
	    		else
	    		{
	    			die('Invalid query: ' . mysql_error());
	    		}
	    	}

	    	else
	    	{
	    		echo("Username not valid");
	    	}
		}
		else
		{
			die('Invalid query: ' . mysql_error());
		}

	}
	elseif (isset($_POST["logout"])) {
		session_start();
		// unset($_COOKIE['username']);
		setcookie("username", "", time() - 3600);
		unset( $_SESSION['twitteruser'] );
		header('Location: index.php');
	}
	else {
		echo '<script>alert("Please enter username and password!"); window.location.href = "login.php";</script>';
	}
}
?>