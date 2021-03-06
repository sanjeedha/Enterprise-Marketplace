<!DOCTYPE html>

<html>
<head>
    <title>Top 5 Products </title>
    <meta charset="utf-8">
    <link href='http://fonts.googleapis.com/css?family=Cabin+Sketch:400,700' rel='stylesheet' type='text/css'>
    <script src="js/jquery-1.10.2.min.js"></script
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="charts4php/lib/js/jquery.min.js"></script>
    <script src="charts4php/lib/js/chartphp.js"></script>
    <link rel="stylesheet" href="charts4php/lib/js/chartphp.css">
	<style>
  .rating_bar {
    /*this class creats 5 stars bar with empty stars */
    /*each star is 16 px, it means 5 stars will make 80px together */
    width: 80px;
    /*height of empty star*/
    height: 16px;
    /*background image with stars */
    background: url("images/stars.png");
    /*which will be repeated horizontally */
    background-repeat: repeat-x;
    /* as we are using sprite image, we need to position it to use right star, 
    //0 0 is for empty */
    background-position: 0 0;
    /* align inner div to the left */
    text-align: left;
}
.rating {
    /* height of full star is the same, we won't specify width here */
    height: 16px;
    /* background image with stars */
    background: url("images/stars.png");
    /* now we will position background image to use 16px from top, 
    //which means use full stars */
    background-position: 0 -16px;
    /* and repeat them horizontally */
    background-repeat: repeat-x;
}
</style>
</head>
<body>
<?php

	$nivi_page = "http://nivedithajh.com/jmp/top_five.php";
	$shubra_page = "http://code272com.fatcow.com/wp-includes/Text/TopRated.php";
	$roshni_page = "http://rkailash.com/site/top_rated_db.php";
	$sanju_page = "http://sanjeedhasanofer.com/gifter/toprated.php";
	$shachi_page = "http://www.shachishah27.com/phpfiles/top5review.php";
	$dhivya_page = "http://www.dhivyajanakiraman.com/top5rated.php";
	
	function get_html($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$contents = curl_exec ($ch);
		// echo $contents;
		curl_close ($ch);
		return $contents;
	}
	
	function fetch_data_from_html($remote_page){
		// Returns an array of products and ratings
		
		$product_rating_arr = array();
		
		$html = get_html($remote_page);
		
		$dom = new domDocument; 
		$dom->loadHTML($html);
		$dom->preserveWhiteSpace = false;
		
		$tables = $dom->getElementsByTagName('table');
		$table = $tables->item(0);
		$rows = $table->getElementsByTagName('tr');
		$i = 0;
		foreach ($rows as $row){
			if ($i != 0){
			$columns = $row->getElementsByTagName('td');
			$product = $columns->item(0)->textContent;
			$rating = $columns->item(1)->textContent;
			$image = $columns->item(2)->textContent;
			$var = $product."__".$image;
			$product_rating_arr[$var]=$rating;
			}
			$i += 1;
		}
		return $product_rating_arr;
}

	function get_top_rated($nivi_page, $shubra_page, $roshni_page,$sanju_page,$shachi_page,$dhivya_page){
		$nivi = fetch_data_from_html($nivi_page);
		$shubra = fetch_data_from_html($shubra_page);
		$roshni = fetch_data_from_html($roshni_page);
		$sanju = fetch_data_from_html($sanju_page);
		$shachi = fetch_data_from_html($shachi_page);
		$dhivya = fetch_data_from_html($dhivya_page);
		$products_and_ratings = array_merge($nivi,$shubra,$roshni,$sanju,$shachi,$dhivya);
		arsort($products_and_ratings);
		return array_slice($products_and_ratings, 0,5);
	}
	
		$top_rated_pages = get_top_rated($nivi_page, $shubra_page, $roshni_page,$sanju_page,$shachi_page,$dhivya_page);
	
		echo "<h3>Here are the Top rated products on this Marketplace</h3>";
		echo "<table style='border: 1px solid #ffffff; border-collapse: collapse'>";
		echo "<tr style='border: 1px solid #ffffff;'>";
		echo "<td style='border: 1px solid #ffffff; width: 16.33%' >";
		echo "<font face='Arial, Helvetica, sans-serif'><h4 style='color:orange'><b>Product/Service</b></h4></font>";
		echo "</td>";
		echo "<td style='border: 1px solid #ffffff; width: 16.33%' >";
		echo "<font face='Arial, Helvetica, sans-serif'><h4 style='color:orange'><b>Product/Service name</b></h4></font>";
		echo "</td>";
		echo "<td style='border: 1px solid #ffffff; width: 16.33%' >";
		echo "<font face='Arial, Helvetica, sans-serif'><h4 style='color:orange'><b>Rating</b></h4></font>";
		echo "</td>";
		echo "</tr>";
      // output data of each row
	  $content = file_get_contents('star_template.html');
	  $product_names = array();
	  $product_values = array();
      foreach ($top_rated_pages as $product_and_image=>$rating) {
		  $var = explode("__", $product_and_image);
		  $product = $var[0];
		  $image_url = $var[1];
		  echo "<tr style='border: 1px solid #ffffff'>";
		  echo "<td style='border: 1px solid #ffffff; width: 16.33%' >";
          echo '<img src='.$image_url.' style="width:100px;height:80px;" alt="Coming Soon">';
		  echo "</td>";		  
		  echo "<td style='border: 1px solid #ffffff; width: 16.33%' >";
          echo $product;
		  echo "</td>";
		  echo "<td style='border: 1px solid #ffffff; width: 16.33%' >";
		  $percent = $rating*100/5;
		  echo str_replace('_percent',$percent,$content);
		  echo "</td>";
		  echo "</tr>";
		  array_push($product_names, $product);
      	  array_push($product_values,$percent);
      }
	  echo "</table>";

		  

	      

			include("charts4php/lib/inc/chartphp_dist.php");
			echo "<br><br>";
			$p = new chartphp();

			$p->data = array(array(array((string)$product_names[0], floatval($product_values[0])),array((string)$product_names[1], floatval($product_values[1])), array((string)$product_names[2], floatval($product_values[2])),array((string)$product_names[3], floatval($product_values[3])),array((string)$product_names[4], floatval($product_values[4]))));
			$p->chart_type = "bar";

			// Common Options
			$p->title = "Bar Chart";
			$p->xlabel = "My X Axis";
			$p->ylabel = "My Y Axis";
			$p->export = false;
			$p->options["legend"]["show"] = true;
			$p->series_label = array('Q1','Q2','Q3'); 

			$out = $p->render('c1');


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
	          <div style=" height: 55%; width:20%; min-width:350px;">
            <?php echo $out; ?>
        </div>
</body>
</html>