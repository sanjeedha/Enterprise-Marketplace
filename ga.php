<!DOCTYPE html>
<html>
<head>
  <title>Embed API Demo</title>
  <link rel="stylesheet" href="layout/styles/layout.css" type="text/css" />
</head>
<body class="ga-body">

<?PHP

  // $client_id = '816556467724-gmjthrm16ud30le4qd5noaj9h7astnv7.apps.googleusercontent.com';
  // $client_secret = '69-zLA8_GQOaESquQZAQ_LGH';
  // $redirect_uri = 'http://sanjeedhasanofer.com/marketplace/';


  // $client = new Google_Client();
  // $client->setClientId($client_id);
  // $client->setClientSecret($client_secret);
  // $client->setRedirectUri($redirect_uri);
  // $client->addScope("https://www.googleapis.com/auth/analytics.readonly");
  // $client->setAccessType('offline');

  // $service = new Google_Service_Urlshortener($client);

  // if (isset($_GET['code'])) {

  //   $client->authenticate($_GET['code']);
  //   $googleToken = $client->getAccessToken();   
  //   $objGoogleToken= json_decode($googleToken);
  //   $_SESSION['access_token'] = $objGoogleToken->access_token;
  //   $_SESSION['refress_access_token'] = $objGoogleToken->refresh_token;

    
  // }

?>

<div class="ga-left">
  <h2>Sessions</h2>
  <section id="sessions"></section>

  <h2>Users</h2>
  <section id="users"></section>

  <h2>Page Views</h2>
  <section id="pageviews"></section>

  <h2>Operating System</h2>
  <section id="os"></section>
</div>

<div class="ga-right">
  <h2>New Vs Return Users</h2>
  <section id="nvr"></section>

  <h2>Geography</h2>
  <section id="geo"></section>

  <h2>Top Cities</h2>
  <section id="cities"></section>

  <h2>Top Browsers</h2>
  <section id="browser"></section>
</div>
  
<script>
(function(w,d,s,g,js,fjs){
  g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(cb){this.q.push(cb)}};
  js=d.createElement(s);fjs=d.getElementsByTagName(s)[0];
  js.src='https://apis.google.com/js/platform.js';
  fjs.parentNode.insertBefore(js,fjs);js.onload=function(){g.load('analytics')};
}(window,document,'script'));
</script>

<script>
gapi.analytics.ready(function() {

  var IDS = 'ga:112087365'; // e.g. 'ga:1174'
  var ACCESS_TOKEN = 'ya29.NgKEONPfMZqMRFCDxWlLjDuUXbbjlY9JnTwE2TODqlJ0QP44-1Aw7pp6kRSXTCEKengyVw'; // obtained from your service account

  gapi.analytics.auth.authorize({
    serverAuth: {
      access_token: ACCESS_TOKEN
    }
  });

  var sessions = new gapi.analytics.googleCharts.DataChart({
    reportType: 'ga',
    query: {
      'ids': IDS,
      'dimensions': 'ga:date',
      'metrics': 'ga:sessions',
      'start-date': '30daysAgo',
      'end-date': 'yesterday',
    },
    chart: {
      type: 'LINE',
      container: 'sessions'
    }
  }).execute();

  var users = new gapi.analytics.googleCharts.DataChart({
    reportType: 'ga',
    query: {
      'ids': IDS,
      'dimensions': 'ga:date',
      'metrics': 'ga:users',
      'start-date': '30daysAgo',
      'end-date': 'yesterday',
    },
    chart: {
      type: 'LINE',
      container: 'users'
    }
  }).execute();

  var pageviews = new gapi.analytics.googleCharts.DataChart({
    reportType: 'ga',
    query: {
      'ids': IDS,
      'dimensions': 'ga:date',
      'metrics': 'ga:pageviews',
      'start-date': '30daysAgo',
      'end-date': 'yesterday',
    },
    chart: {
      type: 'LINE',
      container: 'pageviews'
    }
  }).execute();

  var geo = new gapi.analytics.googleCharts.DataChart({
    reportType: 'ga',
    query: {
      'ids': IDS,
      'dimensions': 'ga:country',
      'metrics': 'ga:sessions',
      'start-date': '30daysAgo',
      'end-date': 'yesterday',
    },
    chart: {
      type: 'GEO',
      container: 'geo',
      options: {
        region: 'world',
        displayMode: 'markers'
      }
    }
  }).execute();

  var browser = new gapi.analytics.googleCharts.DataChart({
    query: {
      'ids': IDS,
      'dimensions': 'ga:browser',
      'metrics': 'ga:sessions',
      'sort': '-ga:sessions',
      'max-results': '10'
    },
    chart: {
      type: 'TABLE',
      container: 'browser',
      options: {
        width: '100%'
      }
    }
  }).execute();

  var city = new gapi.analytics.googleCharts.DataChart({
    query: {
      'ids': IDS,
      'dimensions': 'ga:city',
      'metrics': 'ga:sessions',
      'sort': '-ga:sessions',
      'max-results': '10'
    },
    chart: {
      type: 'TABLE',
      container: 'cities',
      options: {
        width: '100%'
      }
    }
  }).execute();

  var os = new gapi.analytics.googleCharts.DataChart({
    query: {
      'ids': IDS,
      'dimensions': 'ga:operatingSystem',
      'metrics': 'ga:sessions',
      'sort': '-ga:sessions',
      'max-results': '10'
    },
    chart: {
      type: 'TABLE',
      container: 'os',
      options: {
        width: '100%'
      }
    }
  }).execute();

  var nvr = new gapi.analytics.googleCharts.DataChart({
    query: {
      'ids': IDS,
      'dimensions': 'ga:userType',
      'metrics': 'ga:sessions',
      'sort': '-ga:sessions',
      'max-results': '10'
    },
    chart: {
      type: 'PIE',
      container: 'nvr',
      options: {
        width: '100%'
      }
    }
  }).execute();

});

</script>

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
</body>
</html>