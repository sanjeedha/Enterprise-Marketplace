<!DOCTYPE html>

<html>
<head>
<title>Most five visited products</title>
<link href="layout/styles/user.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="layout/styles/layout.css" type="text/css" />
<link rel="stylesheet" href="layout/styles/gallary.css" type="text/css" />

</head>
<body style="margin-left: 300px !important;">

<?php

	$ch = curl_init();
	echo "<h2 class='most-5-header'>Expressions Photography</h2>";
	curl_setopt($ch, CURLOPT_URL, "http://rkailash.com/site/most_visited_db.php");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$contents = curl_exec ($ch);
	//echo $contents;
	curl_close ($ch);
	$document = new DOMDocument();
	@$document->loadHTML($contents);
	
	$i = 0;
	
	echo "<div id=\"tabs-1\" class=\"gallery clear ui-tabs-panel ui-widget-content ui-corner-bottom\" aria-labelledby=\"ui-id-1\" role=\"tabpanel\" aria-hidden=\"false\" style=\"visibility: visible; height: 250px;\">";
    echo "<ul>";

	foreach($document->getElementsByTagName('tr') as $tablerow) {
		if ($i == 0) {
			$i = $i + 1;
			continue;
		}
		$j = 0;

		$elements = $tablerow->getElementsByTagName('td');
		$product = ucfirst($elements->item(1)->textContent);
    	$count = $elements->item(2)->textContent;
    	$link = $elements->item(3)->textContent;
    	//$image = 'http://rkailash.com/blog/wp-content/uploads/2015/09/CakeSmash1.jpg';
    	$image = $elements->item(3)->textContent;

    	// echo "<li><a href='$link' target='_blank' rel='prettyPhoto[gallery1]'><img src='$image' /></a></li>";
		echo "<li class='top5-li'><span class='top5-span'><a href='$link' target='_blank' rel='prettyPhoto[gallery1]'><img src='$image' /></a></span><span class='top5-span'><h2>$product</h2></span><span class='top5-span'><h3>Visits: $count</h3></span></li>";
	}
	echo "</ul>";
    echo "</div>";

	$ch = curl_init();
	echo "<h2 class='most-5-header'>Dance Academy</h2>";
	curl_setopt($ch, CURLOPT_URL, "http://nivedithajh.com/jmp/most_visited.php");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$contents = curl_exec ($ch);
	//echo $contents;
	curl_close ($ch);
	$document = new DOMDocument();
	@$document->loadHTML($contents);
	$i = 0;
	
	echo "<div id=\"tabs-1\" class=\"gallery clear ui-tabs-panel ui-widget-content ui-corner-bottom\" aria-labelledby=\"ui-id-1\" role=\"tabpanel\" aria-hidden=\"false\" style=\"visibility: visible; height: 250px;\">";
    echo "<ul>";

    foreach($document->getElementsByTagName('tr') as $tablerow) {
		if ($i == 0) {
			$i = $i + 1;
			continue;
		}

		$elements = $tablerow->getElementsByTagName('td');
		$product = ucfirst($elements->item(0)->textContent);
    	$count = $elements->item(1)->textContent;
    	$link = $elements->item(2)->textContent;
    	//$image = 'http://nivedithajh.com/jmp/images/hop.jpg';
    	 $image = $elements->item(3)->textContent;

    	 echo "<li class='top5-li'><span class='top5-span'><a href='$link' target='_blank' rel='prettyPhoto[gallery1]'><img src='$image' /></a></span><span class='top5-span'><h2>$product</h2></span><span class='top5-span'><h3>Visits: $count</h3></span></li>";
	}
	echo "</ul>";
    echo "</div>";
	
	$ch = curl_init();
	echo "<h2 class='most-5-header'>Dhivya Music Shoppe</h2>";
	curl_setopt($ch, CURLOPT_URL, "http://dhivyajanakiraman.com/most5visited.php");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$contents = curl_exec ($ch);
	//echo $contents;
	curl_close ($ch);
	$document = new DOMDocument();
	@$document->loadHTML($contents);
	$i = 0;
	
	echo "<div id=\"tabs-1\" class=\"gallery clear ui-tabs-panel ui-widget-content ui-corner-bottom\" aria-labelledby=\"ui-id-1\" role=\"tabpanel\" aria-hidden=\"false\" style=\"visibility: visible; height: 250px;\">";
    echo "<ul>";

    foreach($document->getElementsByTagName('tr') as $tablerow) {
		if ($i == 0) {
			$i = $i + 1;
			continue;
		}

		$elements = $tablerow->getElementsByTagName('td');
		$product = ucfirst($elements->item(0)->textContent);
    	$count = $elements->item(1)->textContent;
    	$link = $elements->item(3)->textContent;
    	 $image = $elements->item(2)->textContent;

		echo "<li class='top5-li'><span class='top5-span'><a href='$link' target='_blank' rel='prettyPhoto[gallery1]'><img src='$image' /></a></span><span class='top5-span'><h2>$product</h2></span><span class='top5-span'><h3>Visits: $count</h3></span></li>";
	}
	echo "</ul>";
    echo "</div>";

    echo "<h2 class='most-5-header'>Gifter</h2>"; 
    /* echo "<br><br><table class='utable' border=0 cellpadding=0 cellspacing=0 width=100%><tr class='theader'><td>Product</td><td>Visits</td><td>Link</td><td>Image</td></tr>";*/
	
	echo "<div id=\"tabs-1\" class=\"gallery clear ui-tabs-panel ui-widget-content ui-corner-bottom\" aria-labelledby=\"ui-id-1\" role=\"tabpanel\" aria-hidden=\"false\" style=\"visibility: visible; height: 250px;\">";
    echo "<ul>";

	mysql_connect("localhost","sanjeedh_sanjeed","Sanju28021991") or die("Could not connect: " . mysql_error());
	mysql_select_db("sanjeedh_mysql");
	$query = "SELECT * FROM visits ORDER BY count DESC LIMIT 5";         
	$result = mysql_query($query);
	
    while ($r = mysql_fetch_array($result, MYSQL_ASSOC)) {
    	$product = ucfirst($r["product"]);
    	$count = $r["count"];
    	$link = $r["link"];
    	$image = $r["image"];
    	echo "<li class='top5-li'><span class='top5-span'><a href='$link' target='_blank' rel='prettyPhoto[gallery1]'><img src='$image' /></a></span><span class='top5-span'><h2>$product</h2></span><span class='top5-span'><h3>Visits: $count</h3></span></li>";
    }
    echo "</ul>";
    echo "</div>";

	$ch = curl_init();
	echo "<h2 class='most-5-header'>Coderholi</h2>";
	curl_setopt($ch, CURLOPT_URL, "http://code272com.fatcow.com/wp-includes/Text/Top.php");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$contents = curl_exec ($ch);
	//echo $contents;
	curl_close ($ch);
	$document = new DOMDocument();
	@$document->loadHTML($contents);
	$i = 0;
	
	echo "<div id=\"tabs-1\" class=\"gallery clear ui-tabs-panel ui-widget-content ui-corner-bottom\" aria-labelledby=\"ui-id-1\" role=\"tabpanel\" aria-hidden=\"false\" style=\"visibility: visible; height: 250px;\">";
    echo "<ul>";

	foreach($document->getElementsByTagName('tr') as $tablerow) {
		if ($i == 0) {
			$i = $i + 1;
			continue;
		}
		echo "<tr>";

		$elements = $tablerow->getElementsByTagName('td');
		$product = ucfirst($elements->item(0)->textContent);
    	$count = $elements->item(1)->textContent;
    	$link = $elements->item(2)->textContent;
    	$image = $elements->item(3)->textContent;
    	//$image = 'http://code272com.fatcow.com/wp-content/uploads/2015/09/Mauritius.png.jpg';
   		echo "<li class='top5-li'><span class='top5-span'><a href='$link' target='_blank' rel='prettyPhoto[gallery1]'><img src='$image' /></a></span><span class='top5-span'><h2>$product</h2></span><span class='top5-span'><h3>Visits: $count</h3></span></li>";
	}
	echo "</ul>";
    echo "</div>";

$ch = curl_init();
	echo "<h2 class='most-5-header'>GenNext Software Solutions</h2>";
	curl_setopt($ch, CURLOPT_URL, "http://www.shachishah27.com/phpfiles/mostvisited.php");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$contents = curl_exec ($ch);
	//echo $contents;
	curl_close ($ch);
	$document = new DOMDocument();
	@$document->loadHTML($contents);
	$i = 0;
	
	echo "<div id=\"tabs-1\" class=\"gallery clear ui-tabs-panel ui-widget-content ui-corner-bottom\" aria-labelledby=\"ui-id-1\" role=\"tabpanel\" aria-hidden=\"false\" style=\"visibility: visible; height: 250px;\">";
    echo "<ul>";

	foreach($document->getElementsByTagName('tr') as $tablerow) {
		if ($i == 0) {
			$i = $i + 1;
			continue;
		}
		echo "<tr>";

		$elements = $tablerow->getElementsByTagName('td');
		$product = ucfirst($elements->item(0)->textContent);
    	$count = $elements->item(1)->textContent;
    	$link = $elements->item(2)->textContent;
    	$image = $elements->item(3)->textContent;
    	//$image = 'http://code272com.fatcow.com/wp-content/uploads/2015/09/Mauritius.png.jpg';
    	
		echo "<li class='top5-li'><span class='top5-span'><a href='$link' target='_blank' rel='prettyPhoto[gallery1]'><img src='$image' /></a></span><span class='top5-span'><h2>$product</h2></span><span class='top5-span'><h3>Visits: $count</h3></span></li>";
	}
	echo "</ul>";
    echo "</div>";

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
