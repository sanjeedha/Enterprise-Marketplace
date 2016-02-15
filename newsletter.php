<!DOCTYPE html>
<html>
<head>
  <title>Newsletter</title>
  <link href="/marketplace/layout/styles/layout.css"  rel="stylesheet" type="text/css" media="all" />
</head>
<body>
  <?php

    function doDB() {
      define('DB_HOST', 'localhost');
      define('DB_NAME','sanjeedh_marketplace');
      define('DB_USER','sanjeedh_sanjeed');
      define('DB_PASSWORD','Sanju28021991');
      $link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
      $db_selected = mysql_select_db(DB_NAME, $link);

      if(!$db_selected)
      {
          die('cannot use'. DB_NAME.':'.mysql_error());
      }
      
    }

    function emailChecker($email) {
      global $safe_email, $check_sql;

      //echo "comes into email checker"."<br>";

      //check that email is not already in list
      $safe_email = mysql_real_escape_string($email);

      //echo "safe email is ".$safe_email."<br>";

      $check_sql = mysql_query("SELECT * FROM subscribers
         WHERE email = '$safe_email'");
      //echo $check_sql."<br>";
      if (!$check_sql) {
        echo "something wrong in check_sql";
      }
    }  

    if (($_POST) && ($_POST['action'] == "sub") && $_POST['email'] != "") {
      //connect to database
      doDB();
      //echo "check post value".$_POST['email'];
      //call email checker
      
      emailChecker($_POST['email']);

      //get number of results and do action
      if (mysql_num_rows($check_sql) < 1) {
       //free result
        mysql_free_result($check_sql);

        //echo "safe email in main is". $safe_email."<br>";

        //add record
        $add_sql = "INSERT INTO subscribers (email)
                     VALUES('$safe_email')";
        $add_res = mysql_query($add_sql)
                     or die(mysql_error());
        echo "<p>Thanks for signing up!</p>";

            // the message
        $msg = "Welcome To Our Website\n Stay Tuned for regular updates";

        // use wordwrap() if lines are longer than 70 characters
        $msg = wordwrap($msg,70);

        // send email
        mail($safe_email, "Welcome", $msg); 
       //close connection to MySQL
        mysql_close();
      } else {
          //print failure message
          $display_block = "<p>You're already subscribed!</p>";
      }


    } 
    else if (($_POST) && ($_POST['action'] == "unsub")) {
      //trying to unsubscribe; validate email address
      if ($_POST['email'] == "") {
          header("Location: newsletter.php");
          exit;
      } else {
        //connect to database
        doDB();

        //check that email is in list
        emailChecker($_POST['email']);

        //get number of results and do action
        if (mysql_num_rows($check_sql) < 1) {
          //free result
          mysql_free_result($check_sql);

          //print failure message
          $display_block = "<p>Couldn't find your address!</p>
         <p>No action was taken.</p>";
        } else {
          //get value of ID from result
          while ($row = mysql_fetch_array($check_sql)) {
              $id = $row['id'];
          }

          //unsubscribe the address
          $del_sql = mysql_query("DELETE FROM subscribers
                      WHERE id = '$id'");
          if(!$del_sql) {
            echo "del sql failure <br>";
          }
          
          $display_block = "<p>You're unsubscribed!</p>";
      }
      mysql_close();
     }
  }
  ?>
  <form class="news-letter" method="POST" action="newsletter.php">
    <h1 class="news-letter-title">Newsletter Signup</h1>
    <input type="email" id="email" name="email" class="news-letter-input" size="40" maxlength="150" placeholder="Email Address" autofocus />
    Action:<br/>
    <input type="radio" id="action_sub" name="action" value="sub" checked />
    <label for="action_sub">subscribe</label><br/>
    <input type="radio" id="action_unsub" name="action" value="unsub" />
    <label for="action_unsub">unsubscribe</label>

    <input type="submit" value="Submit" class="news-letter-button">
  </form>
</body>
</html> 
  