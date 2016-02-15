<?php
if (isset ($_COOKIE['username']))
{
	setcookie('username',$_COOKIE['username']);
	echo $_COOKIE['username'];
}
?>