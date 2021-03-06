<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>Login with Twitter</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css">
      img {border-width: 0}
      * {font-family:'Lucida Grande', sans-serif;}
    body,td,th {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 14px;
	color: #333;
}
body {
	margin-left: 50px;
	margin-top: 50px;
}
    </style>
  </head>
  <body>
    <div>
      <h2>Twitter OAuth PHP Login Demo.</h2>

      <p>This demo show you the Login with Twitter for your Websites</a>.</p>

      <hr />
<?php	
	if(is_object(@$content))
	{
echo '<p><b><h1>You have successfully logged in with Twitter.</h1></b>     <br />';
echo '<b style="color:red;">Important: Twitter OAuth never return user Email ID</b>, <br />Instead of Email id we will get the ID: ';
//print_r($content); 
echo $content->id;
echo "<br /><br />";
echo "Twitter Account Name :";
echo $content->name;
echo "<br />";
echo "<br />";
echo "<img src='$content->profile_image_url_https' />";	
echo "<br />";
echo "<br />";
echo '<a href="logout.php">Logout</a></p>';
	}else
	{
		if(isset($_SESSION['access_token']))
		{
			/* Build a Link to Goto to account home. */		
			echo '<a href="./redirect.php">Goto My Account</a>';	
		}else
		{
			/* Build an image link to start the redirect process. */
			echo '<a href="./redirect.php"><img src="./images/darker.png" alt="Sign in with Twitter"/></a>';		
		}
	}
	?>
      
    </p>

  </body>
</html>
