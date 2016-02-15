
<?php


  define('DB_HOST', 'localhost');
  define('DB_NAME','sanjeedh_marketplace');
  define('DB_USER','sanjeedh_sanjeed');
  define('DB_PASSWORD','Sanju28021991');
  $link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

  if(!$link)
  {
    die('Could not connect:'.mysql_error());
  }
  

  $db_selected = mysql_select_db(DB_NAME, $link);

  if(!$db_selected)
  {
    die('cannot use'. DB_NAME.mysql_error());
  }
  

  


  $send_email_query = mysql_query("SELECT * FROM subscribers") or die(mysql_error());
  echo $send_email_query."<br>";

  if(!$send_email_query) {
    echo "send email failure <br>";
  }
  else {
    echo "send email success <br>";
  }
  
   $num_rows = mysql_num_rows($send_email_query);
   echo $num_rows."<br>";
   require("class.phpmailer.php");

   while ($row = mysql_fetch_assoc($send_email_query)) {
    //echo "goes here <br>";
    echo $row[email]."<br>";
    $safe_email = mysql_real_escape_string($row[email]);
    
    
    $bodytext = "Welcome to MarketPlace. Have fun reading our newsletter";

    $email = new PHPMailer();
    $email->From      = 'webmaster@enterprisemarketplace.com';
    $email->FromName  = 'MarketPlace';
    $email->Subject   = 'Welcome to MarketPlace';
    $email->Body      = $bodytext;
    $email->AddAddress($safe_email);
    $email->AddAttachment("newsletter.pdf");

    if(!$email->Send())
    {
      echo "Message could not be sent. <p>";
      echo "Mailer Error: " . $email->ErrorInfo;
      exit;
    }


   }


?>

