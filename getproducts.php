<?php
    //update according to your credential
	$servername = "";
	$username = "";
	$password = "";
	$db ="";
	
	$link = mysqli_connect("localhost", "sanjeedh_sanjeed","Sanju28021991","sanjeedh_marketplace");

	if (!$link) {
		die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
	}
	
	$term = trim(strip_tags($_GET['term']));//retrieve the search term that autocomplete sends
	$sql = "SELECT prod_name FROM product WHERE prod_name LIKE '%".$term."%'";
	$result = mysqli_query($link, $sql);

	while($row = mysqli_fetch_assoc($result))
	{
			$row_set[] = $row['prod_name'];
	}
	echo json_encode($row_set);
?>