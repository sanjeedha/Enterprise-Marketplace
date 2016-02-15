<html>
<head>
  <title> Login </title>
  <link href="/marketplace/layout/styles/login.css"  rel="stylesheet" type="text/css" media="all" />
  <!-- <link href="/marketplace/layout/styles/font-awesome.min.css"  rel="stylesheet"> -->
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
  <script type="text/javascript" src="layout/scripts/jquery.min.js"></script>
  <script type="text/javascript" src="layout/scripts/script.js"></script>
 <meta name="google-signin-client_id" content="816556467724-p9np1ii9g94kh6tg41vujqvjqcfv19jl.apps.googleusercontent.com">
</head>
<body>

<div id="fb-root"></div>
<!-- <script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=1637518353190675";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script> -->
<!-- <script src="https://apis.google.com/js/platform.js" async defer></script> -->
<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '1637518353190675',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.2' // use version 2.2
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }
</script>

<form action="login_action.php" class="login-form" method="POST">
  <div class="heading">Login</div>
  <div class="left">
    <label for="email">Email</label> <br />
    <input type="email" name="email" id="email" /> <br />
    <label for="password">Password</label> <br />
    <input type="password" name="password" id="pass" /> <br />
    <input type="submit" value="Login" />
    <button><a href="adduser.php">New User</a></button>
  </div>
  <div class="right">
    <div class="connect">Connect with</div>

    <!-- <a href="#" onclick="fb_login();" class="facebook">
      <i class="fa fa-facebook"></i>
    </a> -->  

    <div class="fb-login-button" data-max-rows="1" data-size="xlarge" data-show-faces="true" data-auto-logout-link="true">
      
    </div>

    <?php

      /* Include HTML to display on the page. */
      include('twitter-index.php');
    ?>

    <!-- <a class="g-signin2 google-plus" data-onsuccess="onSignIn"><i class="fa fa-google-plus"></i></a> -->

    <!-- <div class="g-signin2" data-width="230" data-height="60" data-longtitle="true" data-onsuccess="onSuccess" data-onfailure="onFailure" data-theme="light" onclick="googleOnClick()"> -->
    <!-- <script>
      var gName = "";
      var gEmail = "";
      var isClick = false;
      function onSuccess(googleUser) {
        var profile = googleUser.getBasicProfile();
        // console.log("ID: " + profile.getId()); // Don't send this directly to your server!
        console.log("Name: " + profile.getName());
        gName = profile.getName();
        // console.log("Image URL: " + profile.getImageUrl());
        console.log("Email: " + profile.getEmail());
        gEmail = profile.getEmail();

        if (isClick == false) {
          alert(gName);
          alert(gEmail);
          isClick = true
          window.location = '/marketplace';
        }

        // $(".g-signin2").click(function () {
        //   isClick = true;
        // });

      }
      function onFailure(error) {
        console.log(error);
      }
    </script>
    <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script> -->

    <script>
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

    function onSignIn(googleUser) {
      var profile = googleUser.getBasicProfile();
      var user_name = profile.getName();
      var emailID = profile.getEmail();
      document.cookie = "username=" + emailID;
      post('/marketplace/', {'email': emailID});
    }

    function onLoad() {
      gapi.load('auth2,signin2', function() {
        var auth2 = gapi.auth2.init();
        auth2.then(function() {
          // Current values
          var isSignedIn = auth2.isSignedIn.get();
          var currentUser = auth2.currentUser.get();

          if (!isSignedIn) {
            // Rendering g-signin2 button.
            gapi.signin2.render('google-signin-button', {
              'onsuccess': 'onSignIn',
              'scope': 'email',
              'width': 200,
              'height': 50,
              'longtitle': false,
              'theme': 'light'
            });
          }
        });
      });
    }
  </script>

  <div id="google-signin-button" data-width="230" data-height="60" data-longtitle="true"></div>

  <script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script>
  
  </div>
</form>  

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