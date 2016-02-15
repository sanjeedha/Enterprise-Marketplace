<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--
Template Name: PhotoFolio
Author: <a href="http://www.os-templates.com/">OS Templates</a>
Author URI: http://www.os-templates.com/
Licence: Free to use under our free template licence terms
Licence URI: http://www.os-templates.com/template-terms
-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Enterprise Online Market Place</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="layout/styles/layout.css" type="text/css" />
<script type="text/javascript" src="layout/scripts/jquery.min.js"></script>
<script type="text/javascript" src="layout/scripts/script.js"></script>
<meta name="google-signin-client_id" content="816556467724-p9np1ii9g94kh6tg41vujqvjqcfv19jl.apps.googleusercontent.com">
<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>

<!-- tabs -->
<script type="text/javascript" src="layout/scripts/jquery.ui.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    $("#tabcontainer").tabs({
        event: "click"
    });
});
</script>
<!-- / tabs -->
<script type="text/javascript" src="layout/scripts/jquery-photostack.js"></script>
<!-- coinslider -->
<script type="text/javascript" src="layout/scripts/jquery-coin-slider.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    $('#portfolioslider').coinslider({
        width: 480,
        height: 280,
        navigation: false,
        links: false,
        hoverPause: true
    });
});
</script>

<script>
    function signOut() {
      var auth2 = gapi.auth2.getAuthInstance();
      auth2.signOut().then(function () {
        console.log('User signed out.');
      });
    }

    function onLoad() {
      gapi.load('auth2', function() {
        // gapi.auth2.init();

        gapi.auth2.init({
          client_id: '816556467724-gmjthrm16ud30le4qd5noaj9h7astnv7.apps.googleusercontent.com',
          fetch_basic_profile: true,
          scope: 'profile email'
        });

        auth2 = gapi.auth2.getAuthInstance();
        console.log(auth2);
        console.log(auth2.currentUser.get());
        // alert(auth2.currentUser.get().getBasicProfile());
        if (auth2.isSignedIn.get()) {
          var profile = auth2.currentUser.get().getBasicProfile();
          // console.log(profile);
          $('#log-id').css("display", "none");
          $('#logged-in').html('<p>' + profile.getName() + ' logged in.</p>');
        }
      });
    }

    function post(path, params, method) {
      method = method || "post"; // Set method to post by default if not specified.

      // The rest of this code assumes you are not using a library.
      // It can be made less wordy if you use one.
      var form = document.createElement("form");
      form.setAttribute("method", method);
      form.setAttribute("action", path);

      for(var key in params) {
          if(params.hasOwnProperty(key)) {
              var hiddenField = document.createElement("input");
              hiddenField.setAttribute("type", "hidden");
              hiddenField.setAttribute("name", key);
              hiddenField.setAttribute("value", params[key]);

              form.appendChild(hiddenField);
           }
      }

      document.body.appendChild(form);
      form.submit();
    }

    function fbLogout() {
      alert("fb logout");
      post('/login_action/', {'logout': 'logout'});
    }
  </script>

<!-- / coinslider
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> -->
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#tags" ).autocomplete({
    source: "getproducts.php",
    minLength: 1,//search after 1 character
    select: function(event,ui){
    //do nothing
    }
    });
  });
  </script>
 <link rel="stylesheet" type="text/css" href="./css/Searchbox.css">
 <!-- Google Analytics -->

<!-- End Google Analytics -->
</head>
<body id="top" onload="onLoad()">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-70385353-1', 'auto');
  ga('send', 'pageview');

</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=1637518353190675";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

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
<div class="wrapper col1">
  <div id="header" class="clear">
    <div class="fl_left">
      <h1><a href="index.php">Enterprise Online Market Place</a></h1>
      
    </div>
    <?php
      session_start();
      $twitteruser = $_SESSION['twitteruser'];
      if (isset($_COOKIE["username"])) {
        $username = $_COOKIE["username"];
        echo("<span class=\"log-status\">$username logged in.</span><br><br>");
        echo "<form id='logout' method='post' action='login_action.php'>";
        echo "<input type='hidden' name='logout' value='logout' /> ";
        echo "<a class=\"login\" onclick=\"document.getElementById('logout').submit();\">LOGOUT</a>";
        echo "</form>";
      }
      else if (!empty($_POST) && isset($_POST["email"])) {
        $username = $_POST["email"];
        echo("<span class=\"log-status\">$username logged in.</span><br><br>");
        echo "<form id='logout' method='post' action='login_action.php'>";
        echo "<input type='hidden' name='logout' value='logout' /> ";
        echo "<a class=\"login\" onclick=\"document.getElementById('logout').submit();\">LOGOUT</a>";
        echo "</form>";
      }
      else if ($twitteruser) {
        $username = $twitteruser;
        echo("<span class=\"log-status\">$username logged in.</span><br><br>");
        echo "<form id='logout' method='post' action='login_action.php'>";
        echo "<input type='hidden' name='logout' value='logout' /> ";
        echo "<a class=\"login\" onclick=\"document.getElementById('logout').submit();\">LOGOUT</a>";
        echo "</form>";
      }
      else {
        echo "<div id=\"log-id\" class=\"fl_right\"><a href=\"login.php\" class=\"login\">Login</a></div>";
      }
    ?>

    <script type="text/javascript">
      var twitter_user = <?php echo($twitteruser) ?>;
      alert(twitter_user);
      if (twitter_user) {
        document.cookie = "username=" + twitter_user;
      } 
    </script>

    <div id="logged-in"></div>
    <br>
    <br>
    <div id="fb-button" style="display: none;" class="fb-login-button" data-max-rows="1" data-size="large" data-show-faces="false" data-auto-logout-link="true" onclick="fbLogout()">
      
    </div>

  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col1">
<form id="form1" action="gotoproduct.php" method="post">
<input id="tags" type="text" class="search_3" placeholder="Search here..." name="prod"/>
<input type="submit" class="submit_3" value="Search" />
</form>
  <div id="topbar" class="clear">
    <ul id="topnav">
      <li class="active"><a href="index.php">Home</a></li>
      <li><a href="listuser.php">List Users</a></li>
      <li><a href="history.php">User History</a></li>
      <li><a href="top5.php">Toppers </a></li>
      <li><a href="TopratedProducts.php">Top-Rated </a></li>
      <li class="last"><a href="most_5.php">Most visited</a></li>

    </ul>

    <ul style="margin:12px 0 0 15px; float: right;">
      <li>
        <a href="https://twitter.com/marketplace272" class="twitter-follow-button" data-show-count="false" data-show-screen-name="false">Follow @marketplace272</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        <!-- Place this tag in your head or just before your close body tag. -->
        <script src="https://apis.google.com/js/platform.js" async defer></script>
      </li>
      <li>
        <div class="g-follow" data-annotation="bubble" data-height="20" data-href="//plus.google.com/u/0/111312385111391389633" data-rel="author"></div>
      </li>
      <li>
        <div class="fb-like" data-href="https://www.facebook.com/sjsu272/" data-layout="standard" data-action="like" data-show-faces="true" data-share="true" style="width: 100px;"></div>
      </li>
    </ul>
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col1">
  <div id="featured_slide"> 
    <!-- ####################################################################################################### -->
    <div id="slider">
      <ul id="categories">
        <li class="category">
          <h2>Gifter</h2>
          <br>
          <?php
            if (isset($_COOKIE["username"])) {
              $username = $_COOKIE["username"];
              echo "<form id='sanju' method='post' action='http://www.sanjeedhasanofer.com/gifter/'>";
              echo "<input type='hidden' name='username' value='$username' /> ";
              echo "<div class=\"flip-container\" ontouchstart=\"this.classList.toggle('hover');\">";
              echo "<div class=\"flipper\">";
              echo "<div class=\"front\">";
              echo "<a onclick=\"document.getElementById('sanju').submit();\"><img src=\"/marketplace/images/giftbox.jpg\" width=\"150\" height=\"110\" /></a>";
              echo "</div>";
              echo "<div class=\"back\">";
              echo "<a onclick=\"document.getElementById('sanju').submit();\"><img src=\"/marketplace/images/sanQR.jpg\" width=\"150\" height=\"110\" /></a>";
              echo "</div>";
              echo "</div>";
              echo "</div>";
              echo "</form>";
            } else {
              echo "<a href=\"http://www.sanjeedhasanofer.com/gifter/\"><img src=\"/marketplace/images/giftbox.jpg\" width=\"150\" height=\"110\" /></a>";
            }
          ?>
          <p>If you are searching for the perfect gift for your loved one, you have come to the right place. At Gifter.com, you will find one-of-a-kind online gifts for every person in your life. </p>
        </li>

        <li class="category">
          <h2>Dance Academy</h2><br>
          <?php
            if (isset($_COOKIE["username"])) {
              $username = $_COOKIE["username"];
              echo "<form id='nivi' method='post' action='http://nivedithajh.com/jmp/index.php'>";
              echo "<input type='hidden' name='muser' value='$username' /> ";
              echo "<div class=\"flip-container\" ontouchstart=\"this.classList.toggle('hover');\">";
              echo "<div class=\"flipper\">";
              echo "<div class=\"front\">";
              echo "<a onclick=\"document.getElementById('nivi').submit();\"><img src=\"/marketplace/images/nivi.jpg\" width=\"150\" height=\"110\" /></a>";
              echo "</div>";
              echo "<div class=\"back\">";
              echo "<a onclick=\"document.getElementById('nivi').submit();\"><img src=\"/marketplace/images/niviQR.jpg\" width=\"150\" height=\"110\" /></a>";
              echo "</div>";
              echo "</div>";
              echo "</div>"; 
              echo "</form>";
            } else {
              echo "<a href=\"http://nivedithajh.com/jmp/index.php\"><img src=\"/marketplace/images/nivi.jpg\" width=\"150\" height=\"110\" /></a>";
            }
          ?>
          <p> Want to become confident on the dance floor? With our expert instructors, we are able to accommodate every level of dancer for every form of dance. Click here to get Started! </p>
        </li>
        <li class="category">
          <h2>Dhivya Music Shoppe</h2>
          <?php
            if (isset($_COOKIE["username"])) {
              $username = $_COOKIE["username"];
              echo "<form id='dhivya' method='post' action='http://dhivyajanakiraman.com'>";
              echo "<input type='hidden' name='username' value='$username' /> ";
              echo "<div class=\"flip-container\" ontouchstart=\"this.classList.toggle('hover');\">";
              echo "<div class=\"flipper\">";
              echo "<div class=\"front\">";
              echo "<a onclick=\"document.getElementById('dhivya').submit();\"><img src=\"/marketplace/images/Dhivya.jpg\" width=\"150\" height=\"110\" /></a>";
              echo "</div>";
              echo "<div class=\"back\">";
              echo "<a onclick=\"document.getElementById('dhivya').submit();\"><img src=\"/marketplace/images/dhivyaQR.jpg\" width=\"150\" height=\"110\" /></a>";
              echo "</div>";
              echo "</div>";
              echo "</div>"; 
              echo "</form>";
            } else {
              echo "<a href=\"http://dhivyajanakiraman.com\"><img src=\"/marketplace/images/Dhivya.jpg\" width=\"150\" height=\"110\" /></a>";
            }
          ?>
          
          <!-- <a href="http://dhivyajanakiraman.com"><img src="/marketplace/images/Dhivya.jpg" width="150" height="110" alt="" /></a> -->
          <p>Welcome to the Musician's friend online store - your destination for the best musical instruments, gear and exclusive content to help you get the sound you are after.</p>
          
        </li>
        <li class="category">
          <h2>Expressions Photography</h2>
          <?php
            if (isset($_COOKIE["username"])) {
              $username = $_COOKIE["username"];
              echo "<form id='roshni' method='post' action='http://rkailash.com/site/'>";
              echo "<input type='hidden' name='username' value='$username' /> ";
              echo "<div class=\"flip-container\" ontouchstart=\"this.classList.toggle('hover');\">";
              echo "<div class=\"flipper\">";
              echo "<div class=\"front\">";
              echo "<a onclick=\"document.getElementById('roshni').submit();\"><img src=\"/marketplace/images/roshni.jpg\" width=\"150\" height=\"110\" /></a>";
              echo "</div>";
              echo "<div class=\"back\">";
              echo "<a onclick=\"document.getElementById('roshni').submit();\"><img src=\"/marketplace/images/roshQR.jpg\" width=\"150\" height=\"110\" /></a>";
              echo "</div>";
              echo "</div>";
              echo "</div>"; 
              echo "</form>";
            } else {
              echo "<a href=\"http://rkailash.com/site/\"><img src=\"/marketplace/images/roshni.jpg\" width=\"150\" height=\"110\" /></a>";
            }
          ?>
          <p>Engagements - Weddings - get togethers - Portraits! You name it! And we'll shoot it! With a camera of course! Fossilize your memories here.</p>
         
        </li>
        <li class="category">
          <h2>GenNext Software Solutions</h2>
          <?php
            if (isset($_COOKIE["username"])) {
              $username = $_COOKIE["username"];
              echo "<form id='sachi' method='post' action='http://shachishah27.com/wordpress/index.php/about-us/'>";
              echo "<input type='hidden' name='username' value='$username' /> ";
              echo "<div class=\"flip-container\" ontouchstart=\"this.classList.toggle('hover');\">";
              echo "<div class=\"flipper\">";
              echo "<div class=\"front\">";
              echo "<a onclick=\"document.getElementById('sachi').submit();\"><img src=\"/marketplace/images/sachi.jpg\" width=\"150\" height=\"110\" /></a>";
              echo "</div>";
              echo "<div class=\"back\">";
              echo "<a onclick=\"document.getElementById('sachi').submit();\"><img src=\"/marketplace/images/sachiQR.jpg\" width=\"150\" height=\"110\" /></a>";
              echo "</div>";
              echo "</div>";
              echo "</div>";  
              echo "</form>";
            } else {
              echo "<a href=\"http://shachishah27.com/wordpress/index.php/about-us/\"><img src=\"/marketplace/images/sachi.jpg\" width=\"150\" height=\"110\" /></a>";
            }
          ?>
          <p> Welcome to the GenNext Software Solutions- your "goto tool" for software development,web-designing,mobile apps and many more in order to provide rich and highly scalable applications.</p>
         
        </li>
        <li class="category">
          <h2>Coderholi</h2><br>
          <?php
            if (isset($_COOKIE["username"])) {
              $username = $_COOKIE["username"];
              echo "<form id='shubhra' method='post' action='http://code272com.fatcow.com/wp-includes/Text/Coderholiusers.php'>";
              echo "<input type='hidden' name='username' value='$username' /> ";
              echo "<div class=\"flip-container\" ontouchstart=\"this.classList.toggle('hover');\">";
              echo "<div class=\"flipper\">";
              echo "<div class=\"front\">";
              echo "<a onclick=\"document.getElementById('shubhra').submit();\"><img src=\"/marketplace/images/shubhra.jpg\" width=\"150\" height=\"110\" /></a>";
              echo "</div>";
              echo "<div class=\"back\">";
              echo "<a onclick=\"document.getElementById('shubhra').submit();\"><img src=\"/marketplace/images/shubhraQR.jpg\" width=\"150\" height=\"110\" /></a>";
              echo "</div>";
              echo "</div>";
              echo "</div>";  
              echo "</form>";
            } else {
              echo "<a href=\"http://code272com.fatcow.com/wp-includes/Text/Coderholiusers.php\"><img src=\"/marketplace/images/shubhra.jpg\" width=\"150\" height=\"110\" /></a>";
            }
          ?>
          <p> Bored of working continuously? Need a break? At Coderholi we plan a perfect holiday for you making best use of your time. You just cant Skip our deals!!!</p>
         
        </li>
        </ul>
      <a class="prev disabled"></a> <a class="next disabled"></a>
      <div style="clear:both"></div>
    </div>
    <!-- ####################################################################################################### --> 
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col2">
  <div id="container" class="clear"> 
    <!-- ####################################################################################################### -->
    <div id="tabcontainer">
      <ul id="tabnav">
        <li><a href="#tabs-1">CUSTOMER REVIEWS</a></li>
        <li><a href="#tabs-2"></a></li>
        <li><a href="#tabs-3"></a></li>
        <li><a href="#tabs-4"></a></li>
        <li><a href="#tabs-5"></a></li>
      </ul>
      <div id="tabs-1" class="tabcontainer">
        <div id="hpage_services" class="clear">
          <div class="block"><img src="/marketplace/images/gift.jpeg"/><strong>Gifter</strong>
              <?php
                  mysql_connect("localhost","sanjeedh_sanjeed","Sanju28021991") or die("Could not connect: " . mysql_error());
                  mysql_select_db("sanjeedh_mysql");
                  $query1 = "SELECT * FROM site ORDER BY time DESC limit 1"; 
                            $result1 = mysql_query($query1);
                            if ($result1)
                            {
                              echo "<table class='mrev-table' border=0 cellpadding=0 cellspacing=0 width=100%>";
                              while ($r = mysql_fetch_array($result1, MYSQL_ASSOC)) {
                                echo "<tr>";
                                $tmp = $r["email"];
                                echo "<td style='display: block;font-style:italic'><b>$tmp</b></td>";
                                $tmp = $r["review"];
                                echo "<td style='display: block;font-style:italic'>$tmp</td>";
                                echo "</tr>";
                              }
                            echo "</table>";
                            }
                            else {
                                die('Invalid query: ' . mysql_error());
                            }
                         
              ?>
          </div>

          <div class="block"><img src="/marketplace/images/music.png" alt="" /><strong>Dhivya Music Shoppe</strong>
          
            <?php

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "http://www.dhivyajanakiraman.com/review.php");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $contents = curl_exec ($ch);
  //echo $contents;
  curl_close ($ch);
  $document = new DOMDocument();
  @$document->loadHTML($contents);
  
  $i = 0;
  
  foreach($document->getElementsByTagName('tr') as $tablerow) {
    if ($i == 0) {
      $i = $i + 1;
      continue;
    }

echo "<table class='mrev-table' border=0 cellpadding=0 cellspacing=0 width=100%>";
    $elements = $tablerow->getElementsByTagName('td');
    $review = $elements->item(0)->textContent;
    $email = $elements->item(1)->textContent;
      echo "<br>";
      echo "<tr>";
      
      echo "<td style='display: block;font-style:italic'><b>$email</b></td>";
      echo "<br>";
      echo "<td style='display: block;font-style:italic'>$review</td>";
                                echo "</tr>";
  }
  echo "</table>";
  ?>
          </div>
          <div class="block last"><img src="/marketplace/images/dance.jpg" alt="" /><strong>Dance Academy</strong>

            <?php

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "http://nivedithajh.com/jmp/review.php");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $contents = curl_exec ($ch);
  //echo $contents;
  curl_close ($ch);
  $document = new DOMDocument();
  @$document->loadHTML($contents);
  
  $i = 0;
  
  foreach($document->getElementsByTagName('tr') as $tablerow) {
    if ($i == 0) {
      $i = $i + 1;
      continue;
    }

echo "<table class='mrev-table' border=0 cellpadding=0 cellspacing=0 width=100%>";
    $elements = $tablerow->getElementsByTagName('td');
    $review = $elements->item(0)->textContent;
    $email = $elements->item(1)->textContent;
      echo "<br>";
      echo "<tr>";
      
      echo "<td style='display: block;font-style:italic'><b>$email</b></td>";
      echo "<br>";
      echo "<td style='display: block;font-style:italic'>$review</td>";
                                echo "</tr>";
  }
  echo "</table>";

  ?>
          </div>
          <div class="spacer">&nbsp;</div>
          <div class="block"><img src="/marketplace/images/camera.jpg" alt="" /><strong>Expressions</strong>
         <?php

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "http://rkailash.com/site/websitereviewtable.php");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $contents = curl_exec ($ch);
  //echo $contents;
  curl_close ($ch);
  $document = new DOMDocument();
  @$document->loadHTML($contents);
  
  $i = 0;
  
  foreach($document->getElementsByTagName('tr') as $tablerow) {
    if ($i == 0) {
      $i = $i + 1;
      continue;
    }

echo "<table class='mrev-table' border=0 cellpadding=0 cellspacing=0 width=100%>";
    $elements = $tablerow->getElementsByTagName('td');
    $review = $elements->item(1)->textContent;
    $email = $elements->item(0)->textContent;
      echo "<br>";
      echo "<tr>";
      
      echo "<td style='display: block;font-style:italic'><b>$email</b></td>";
      echo "<br>";
      echo "<td style='display: block;font-style:italic'>$review</td>";
                                echo "</tr>";
  }
  echo "</table>";

  ?>
          </div>
          <div class="block"><img src="/marketplace/images/flight.jpg" alt="" /><strong>Coderholi</strong>
           <?php

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "http://code272com.fatcow.com/wp-includes/Text/LatestSiteReview.php");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $contents = curl_exec ($ch);
  //echo $contents;
  curl_close ($ch);
  $document = new DOMDocument();
  @$document->loadHTML($contents);
  
  $i = 0;
  
  foreach($document->getElementsByTagName('tr') as $tablerow) {
    if ($i == 0) {
      $i = $i + 1;
      continue;
    }

echo "<table class='mrev-table' border=0 cellpadding=0 cellspacing=0 width=100%>";
    $elements = $tablerow->getElementsByTagName('td');
    $review = $elements->item(0)->textContent;
    $email = $elements->item(1)->textContent;
      echo "<br>";
      echo "<tr>";
      
      echo "<td style='display: block;font-style:italic'><b>$email</b></td>";
      echo "<br>";
      echo "<td style='display: block;font-style:italic'>$review</td>";
                                echo "</tr>";
  }
  echo "</table>";

  ?>
          </div>
          <div class="block last"><img src="/marketplace/images/software.jpg" alt="" /><strong>GenNext Software</strong>
            <?php

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "http://www.shachishah27.com/phpfiles/reviewweb.php");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $contents = curl_exec ($ch);
  //echo $contents;
  curl_close ($ch);
  $document = new DOMDocument();
  @$document->loadHTML($contents);
  
  $i = 0;
  
  foreach($document->getElementsByTagName('tr') as $tablerow) {
    if ($i == 0) {
      $i = $i + 1;
      continue;
    }

echo "<table class='mrev-table' border=0 cellpadding=0 cellspacing=0 width=100%>";
    $elements = $tablerow->getElementsByTagName('td');
    $review = $elements->item(1)->textContent;
    $email = $elements->item(0)->textContent;
      echo "<br>";
      echo "<tr>";
      
      echo "<td style='display: block;font-style:italic'><b>$email</b></td>";
      echo "<br>";
      echo "<td style='display: block;font-style:italic'>$review</td>";
                                echo "</tr>";
  }
  echo "</table>";

  ?>
          </div>
        </div>
      </div>
      <!-- ########### -->
      <div id="tabs-2" class="tabcontainer">
        <h2 class="title">Latest projects at mattis vol utpat gravida nunc.</h2>
        <ul class="line clear">
          <li>
            <div class="imgholder"><a href="#"><img src="images/demo/280x160.gif" alt="" /></a></div>
            <p class="name">Metuervestas mus lacinia</p>
            <p class="readmore"><a href="#">View This Project &raquo;</a></p>
          </li>
          <li>
            <div class="imgholder"><a href="#"><img src="images/demo/280x160.gif" alt="" /></a></div>
            <p class="name">Metuervestas mus lacinia</p>
            <p class="readmore"><a href="#">View This Project &raquo;</a></p>
          </li>
          <li class="last">
            <div class="imgholder"><a href="#"><img src="images/demo/280x160.gif" alt="" /></a></div>
            <p class="name">Metuervestas mus lacinia</p>
            <p class="readmore"><a href="#">View This Project &raquo;</a></p>
          </li>
        </ul>
      </div>
      <!-- ########### -->
      <div id="tabs-3" class="tabcontainer">
        <div id="hpage_portfolio" class="clear">
          <div class="fl_left">
            <div id="portfolioslider">
              <ul>
                <li><img src="images/demo/portfolioslider/1.gif" alt="" /></li>
                <li><img src="images/demo/portfolioslider/2.gif" alt="" /></li>
                <li><img src="images/demo/portfolioslider/3.gif" alt="" /></li>
                <li><img src="images/demo/portfolioslider/4.gif" alt="" /></li>
                <li><img src="images/demo/portfolioslider/5.gif" alt="" /></li>
              </ul>
            </div>
          </div>
          <div class="fl_right">
            <h2>Metuervestas mus lacinia</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sollici tudin elementum nulla, quis pellentesque nisi ullamcorper non.</p>
            <ul>
              <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
              <li>Aliquam vestibulum dui eget augue mattis eget posuere.</li>
              <li>Integer vel enim nisl, non malesuada nibh.</li>
            </ul>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sollici tudin elementum nulla, quis pellentesque nisi ullamcorper non.</p>
            <p class="readmore"><a href="#">View The Full Project &raquo;</a></p>
          </div>
        </div>
      </div>
      <!-- ########### -->
      <div id="tabs-4" class="tabcontainer">
        <h2>Full Width Content</h2>
        <p>Lornunc tincidunt nec nequat risus convallisis elit vestiquat justo et volutpat. Urnanec monterdum turistibus semportis non vivamus justo pellus ac integestiquat eros. Turet cursuspend ero nulla dapienteger quisque nullamcorper lorem in ut pellus. Auctortorvel habitudin laorem commodo tincidunt eget habitur vitae aenec sentesque maecenasce. Nibhvivamus pretra cursuspendrerit pede ligula leo quismod condimentesque aenean ligula ipsum.</p>
        <p>Atmaecenas nec non nam nullamcorper magna id id nisl ac in. Sedfauctortis fuscetus estibus gravida id dui curabitur commodo facilisi loborttitorttitor vitae. Tortortissagittitortis diam vel hac nibh justo sed semper eget vitassa mattis. Aliquerhoncus tempus vest ulla justo pellus in aliquet in sed aucibulum. Odioelit tincidunt laorem venean tris vitae magna ut vel urnar vestibulus.</p>
      </div>
      <!-- ########### -->
      <div id="tabs-5" class="tabcontainer">
        <div id="content">
          <h1>This uses the 2 column layout found in the style demo</h1>
          <img class="imgr" src="images/demo/imgr.gif" alt="" width="125" height="125" />
          <p>Aliquatjusto quisque nam consequat doloreet vest orna partur scetur portortis nam. Metadipiscing eget facilis elit sagittis felisi eger id justo maurisus convallicitur.</p>
          <p>Dapiensociis <a href="#">temper donec auctortortis cumsan</a> et curabitur condis lorem loborttis leo. Ipsumcommodo libero nunc at in velis tincidunt pellentum tincidunt vel lorem.</p>
          <img class="imgl" src="images/demo/imgl.gif" alt="" width="125" height="125" />
          <p>Temperinte interdum sempus odio urna eget curabitur semper convallis nunc laoreet. Nullain convallis ris <a href="#"><strong>elis vest liberos nis diculis</strong></a> feugiat in rutrum. Suspendreristibulumfaucibulum lobortor quis tortortor ris sapien sce enim et volutpat sus.</p>
          <p>Urnaretiumorci orci <strong>fauctor leo justo nulla cras ridiculum</strong> eu id vitae. Etnon et dolor auctor eu loreet fring temper pend pede integestibus.</p>
          <p>Portortornec condimenterdum eget consectetuer condis consequam pretium pellus sed mauris enim. Puruselit mauris nulla hendimentesque elit semper nam a sapien urna sempus.</p>
        </div>
        <div id="column">
          <div id="featured">
            <ul>
              <li>
                <h2>Indonectetus facilis leonib</h2>
                <p class="imgholder"><img src="images/demo/240x90.gif" alt="" /></p>
                <p>Nullamlacus dui ipsum conseque loborttis non euisque morbi penas dapibulum orna. Urnaultrices quis curabitur phasellentesque congue magnis vestibulum quismodo nulla et feugiat. Adipisciniapellentum leo ut consequam ris felit elit id nibh sociis malesuada.</p>
                <p class="readmore"><a href="#">Continue Reading &raquo;</a></p>
              </li>
            </ul>
          </div>
        </div>
        <div class="clear"></div>
      </div>
      <!-- ########### --> 
    </div>
    <!-- ####################################################################################################### --> 
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper">
  <div id="footer" class="clear">
    <div class="footbox">
      <h2>About Us</h2>
       <p>Online Enterprise marketplace is a hub where people around the world connect, both online and offline, to make, sell and buy unique goods and services.</p>
      <p>The heart and soul of our marketplace is our global community: the creative entrepreneurs who use our site to sell what they make or curate, the shoppers looking for things they cannot find anywhere else.</p>
    </div>
    <div class="footbox">
      <h2>Our Founders</h2>
      <ul>
        <li>Dhivya Janakiraman</li>
        <li>Niveditha Jain</li>
        <li>Roshni Kailash</li>
        <li>Sachi Shah</li>
        <li>Sanjeedha Sanofer</li>
        <li>Shubhra Gupta</li>
      </ul>
    </div>
    <div class="footbox">
      <h2>Our Policy</h2>
      <ul>
        <li><a href="privacy.php">Privacy Policy</a></li>
        <li><a href="infringement.php">Infringement Policy</a></li>
        <li><a href="FAQ.php">FAQ</a></li>
        <li><a href="ga.php">Site Statistics</a></li>
        <li><a href="newsletter.php">NewsLetter</a></li>
      </ul>
    </div>
    <div class="footbox last">
      <h2>Keep in Touch</h2>
      <ul>
        <li><a href="https://www.facebook.com/sjsu272/">Check out our Facebook page</a></li>
        <li><a href="https://twitter.com/marketplace272">Get the latest Tweets</a></li>
        <li><a href="https://plus.google.com/u/2/111312385111391389633/posts">View our g+ page</a></li>
        <li><a href="https://www.linkedin.com/in/sjsu-enterprise-91366410a">View our LinkedIn profile</a></li>
      </ul>
      <h2>Contact Us</h2>
      <ul>
        <li><strong class="title">Tel:</strong><br />
          4085679485</li>
        <li><strong class="title">Email:</strong><br />
          <a href="#">contact@mydomain.com</a></li>
      </ul>
    </div>
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper">
  <div id="copyright" class="clear">
    <p class="fl_left">Copyright &copy; 2014 - All Rights Reserved - <a href="#">sanjeedhasanofer.com/gifter</a></p>
   
  </div>
</div>
</body>
</html>