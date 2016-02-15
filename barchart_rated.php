<?php

define('DB_HOST', 'mysql');
define('DB_NAME','sample');
define('DB_USER','dbadmin');
define('DB_PASSWORD','password');
$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);


$db_selected = mysql_select_db(DB_NAME, $link);
$output = mysql_query("SELECT product,avgcount FROM average ORDER BY avgcount DESC LIMIT 5");

$product_names = array();
$product_values = array();
while($row = mysql_fetch_array($output))
{
  //echo $row[product]."\t".$row[count]."times"."<br>";
  array_push($product_names, $row[product]);
  array_push($product_values,$row[avgcount]);
}




/**
 * Charts 4 PHP
 *
 * @author Shani <support@chartphp.com> - http://www.chartphp.com
 * @version 1.2.3
 * @license: see license.txt included in package
 */
 
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
?>
<!DOCTYPE html>
<html>
    <head>
        <script src="charts4php/lib/js/jquery.min.js"></script>
        <script src="charts4php/lib/js/chartphp.js"></script>
        <link rel="stylesheet" href="charts4php/lib/js/chartphp.css">
    </head>
    <body>
        <div style=" height: 55%; width:20%; min-width:350px;">
            <?php echo $out; ?>
        </div>
    </body>
</html>



