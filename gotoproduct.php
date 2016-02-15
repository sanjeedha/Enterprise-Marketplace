<?php
	function connect_db(){
		/* Returns an object which represents the connection to a MySQL Server. */

		// Change these fields to your credentials
		$servername ="" ;
		$username = "";
		$password ="" ;
		$db ="";
		
		$link = mysqli_connect("localhost", "sanjeedh_sanjeed", "Sanju28021991", "sanjeedh_marketplace");

		if (!$link) {
			die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
		}
		return $link;
	}
	
	function run_query($sql){
		$link = connect_db();
		return mysqli_query($link, $sql);
	}
	
	function fetch_url($product){
		$sql = "SELECT link FROM product WHERE prod_name= '".$product."'";
		$result = run_query($sql);
		while($row = mysqli_fetch_assoc($result)) {
			$url = $row['link'];
		}
		return $url;
	}
	
	$url = fetch_url($_POST['prod']);
	if($url){
		header( 'Location: ' . $url );
	}
	else{
		echo '<script>alert("No product to display!"); window.location.href = "index.php";</script>';
	}
?>