<!DOCTYPE html>

<html>
<head>
<title>TOPPERS</title>
<link href="layout/styles/user.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="layout/styles/layout.css" type="text/css" />
<link rel="stylesheet" href="layout/styles/gallary.css" type="text/css" />

<script src="charts4php/lib/js/jquery.min.js"></script>
<script src="charts4php/lib/js/chartphp.js"></script>
<link rel="stylesheet" href="charts4php/lib/js/chartphp.css">

</head>
<body style="margin-left: 200px !important;">
<style>
	.jqplot-data-label {color:white;}
</style>

<?php
	function compare_visits($a, $b)
	{
		if (intval($a[1]) > intval($b[1])) {
			return 0;
		} else {
			return 1;
		}
	}

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://rkailash.com/site/most_visited_db.php");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$contents = curl_exec ($ch);
	//echo $contents;
	curl_close ($ch);
	$document = new DOMDocument();
	@$document->loadHTML($contents);
	$data = array();
	$i = 0;
	foreach($document->getElementsByTagName('tr') as $tablerow) {
		$row = array();
		if ($i == 0) {
			$i = $i + 1;
			continue;
		}
		$j = 0;
		foreach($tablerow->getElementsByTagName('td') as $table){
			if ($j == 0) {
				$j = $j + 1;
				continue;
			}
			array_push($row, $table->nodeValue);
		}
		$tmp = $row[2];
		$row[2] = $row[3];
		$row[3] = $tmp;
		array_push($data, $row);

	}

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://nivedithajh.com/jmp/most_visited.php");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$contents = curl_exec ($ch);
	//echo $contents;
	curl_close ($ch);
	$document = new DOMDocument();
	@$document->loadHTML($contents);
	$i = 0;
	foreach($document->getElementsByTagName('tr') as $tablerow) {
		$row = array();
		if ($i == 0) {
			$i = $i + 1;
			continue;
		}
		foreach($tablerow->getElementsByTagName('td') as $table){
			array_push($row, $table->nodeValue);
		}
		array_push($data, $row);
	}
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://code272com.fatcow.com/wp-includes/Text/Top.php");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$contents = curl_exec ($ch);
	//echo $contents;
	curl_close ($ch);
	$document = new DOMDocument();
	@$document->loadHTML($contents);
	$i = 0;
	foreach($document->getElementsByTagName('tr') as $tablerow) {
		$row = array();
		if ($i == 0) {
			$i = $i + 1;
			continue;
		}
		foreach($tablerow->getElementsByTagName('td') as $table){
			array_push($row, $table->nodeValue);
		}
		array_push($data, $row);
	}

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://dhivyajanakiraman.com/most5visited.php");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$contents = curl_exec ($ch);
	curl_close ($ch);

	// $rows = explode("<br>", $contents);
	// $i = 0;
	// foreach ($rows as $key => $row) {
	// 	if ($i == 0) {
	// 		$i = $i + 1;
	// 		continue;
	// 	}
	// 	// echo($row);
	// 	$row1 = explode("	", $row);
	// 	$row1[1] = str_replace("times", "", $row1[1]);
	// 	array_push($data, $row1);
	// }
	
	$document = new DOMDocument();
	@$document->loadHTML($contents);
	$i = 0;
	foreach($document->getElementsByTagName('tr') as $tablerow) {
		$row = array();
		if ($i == 0) {
			$i = $i + 1;
			continue;
		}
		foreach($tablerow->getElementsByTagName('td') as $table){
			array_push($row, $table->nodeValue);
		}
		$tmp = $row[2];
		$row[2] = $row[3];
		$row[3] = $tmp;
		array_push($data, $row);
	}

	mysql_connect("localhost","sanjeedh_sanjeed","Sanju28021991") or die("Could not connect: " . mysql_error());
	mysql_select_db("sanjeedh_mysql");
	$query = "SELECT * FROM visits";         
	$result = mysql_query($query);
	while ($r = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$temp = array($r["product"],$r["count"],$r["link"],$r["image"]);
		array_push($data,$temp);

	}

	usort($data, 'compare_visits');
	$limit = 0;

	echo "<div class='top5'>";
	echo "<h1>Top products in the Marketplace</h1>";
	echo "<div id=\"tabs-1\" class=\"gallery clear ui-tabs-panel ui-widget-content ui-corner-bottom\" aria-labelledby=\"ui-id-1\" role=\"tabpanel\" aria-hidden=\"false\" style=\"visibility: visible; height: 250px;\">";
    echo "<ul>";
	//echo "<br><br><table class='utable' border=0 cellpadding=0 cellspacing=0 width=100%><tr class='theader'><td>Product</td><td>Visits</td><td>Link</td></tr>";
	foreach($data as $datarow) {
		if($limit >= 6)
		{
			continue;
		}
		
		$product = ucfirst($datarow[0]);
    	$count = $datarow[1];
    	$link = $datarow[2];
    	$image = $datarow[3];
		echo "<li class='top5-li'><span class='top5-span'><a href='$link' target='_blank' rel='prettyPhoto[gallery1]'><img src='$image' /></a></span><span class='top5-span'><h2>$product</h2></span><span class='top5-span'><h3>Visits: $count</h3></span></li>";
		
		if(($limit + 1) % 3 == 0)
    	{
    		echo "</ul>";
    		echo "</div>";
    		echo "<div class='gallery'>";
    		echo "<ul>";
    	}
		$limit = $limit + 1;
	}

	echo "</ul>";
    echo "</div>";
    echo "</div>";

 //    $product_names = array();
	// $product_values = array();

	// foreach ($data as $datarow) {
	// 	array_push($product_names, $datarow[0]);
 //  		array_push($product_values,$datarow[1]);
	// }

	// include("charts4php/lib/inc/chartphp_dist.php");

	// $p = new chartphp();
	// $p->title = "Pie Chart";
	// $p->data = array(array(array((string)$product_names[0], intval($product_values[0])),array((string)$product_names[1], intval($product_values[1])), array((string)$product_names[2], intval($product_values[2])),array((string)$product_names[3], intval($product_values[3])),array((string)$product_names[4], intval($product_values[4]))));
	// $p->chart_type = "pie"; 

	// $out = $p->render('c1');

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

<object type="text/html" data="piechart_visited.php" style="margin-top 200px; width:70%; height:300px;">
<p>backup content</p>
</object>
</body>
</html>

