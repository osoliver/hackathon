<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css"  href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"  href="css/style2.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="http://www.parsecdn.com/js/parse-1.3.5.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
<div class="container">

</div>

<script>
  // Initialize Parse
 Parse.initialize("bY3Q4qk0UvoosqDZYZO9bKAKO6ujVoH15QSlMtdK", "g2Xz6r0VFXfdUPSjsmlbrLVsoJRBpOed6NLzMyO2");
 
  window.fbAsyncInit = function() {
    Parse.FacebookUtils.init({ // this line replaces FB.init({
      appId      : '426357014187708', // Facebook App ID
      status     : false,  // check Facebook Login status
      cookie     : true,  // enable cookies to allow Parse to access the session
      xfbml      : true,  // initialize Facebook social plugins on the page
      version    : 'v2.2' // point to the latest Facebook Graph API version
    });
 
    // Run code after the Facebook SDK is loaded.
    checkIsConnected();
    // FB.logout(function(response) {
    //     console.log("loooooolll");
    // });
  };
 

  (function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
  function checkIsConnected(){
    FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
            // the user is logged in and has authenticated your
            // app, and response.authResponse supplies
            // the user's ID, a valid access token, a signed
            // request, and the time the access token 
            // and signed request each expire

            var uid = response.authResponse.userID;
            var accessToken = response.authResponse.accessToken;
            FB.api(
                "/"+uid,
                function (response) {

                  if (response && !response.error) {
                    console.log(response);
                    var currentUser = Parse.User.current();
                    console.log(currentUser);
                    if (!currentUser.get("level")){
                        currentUser.set("level", 3);
                        currentUser.save(null, {
                            success: function(currentUser) {
                              // Execute any logic that should take place after the object is saved.
                              alert('New object created with objectId: ' + currentUser.id);
                            },
                            error: function(currentUser, error) {
                              // Execute any logic that should take place if the save fails.
                              // error is a Parse.Error with an error code and message.
                              alert('Failed to create new object, with error code: ' + error.message);
                            }
                        });
                    }
                        // var user = new Parse.User();
                        // user.set("username", response.first_name + response.last_name);
                        // user.set("password", "my pass");
                        // user.set("email", "email@example.com");

                    }
                    else{
                    }                    
                }
            );
            var currentUser = Parse.User.current();
            currentUser.fetch();
            console.log(currentUser, "currentuser");
            $(".container").html('' +
                        '<p> You are logged in :) and your level is '+ currentUser.get("level") + ' </p>' +
                        '<button id="level">Increment</button>' +
                        '<button id="logout">Log out</button>');
        } else if (response.status === 'not_authorized') {
            $(".container").html('<div class="row"><div class="main">'+
                        '<h3>BABARr <a href="signup.html">Sign Up</a></h3>'+
                        '<div class="row"><div class="col-xs-6 col-sm-6 col-md-6">'+
                        '<a id="facebook" class="btn btn-lg btn-primary btn-block">Facebook</a>'+
                        '</div><div></div>');
        } else {
           $(".container").html('<div class="row"><div class="main">'+
                        '<h3>Please Log In, or <a href="signup.html">Sign Up</a></h3>'+
                        '<div class="row"><div class="col-xs-6 col-sm-6 col-md-6">'+
                        '<a id="facebook" class="btn btn-lg btn-primary btn-block">Facebook</a>'+
                        '</div><div></div>');
        }
        $("#facebook").click( function() {
            Parse.FacebookUtils.logIn(null, {
                success: function(user) {
                    if (!user.existed()) {
                      location.reload(true);
                    } else {
                        location.reload(true);
                    }
                },
                error: function(user, error) {
                }
            })
        });
        $("#logout").click( function() {
            console.log('ok or not');
            FB.logout(function(response) {
                console.log(response);
                location.reload(true);
            });
        });
        $("#level").on("click",function() {
                console.log('plop');
                    var currentUser = Parse.User.current();
                    var num = currentUser.get("level");
                    num++;
                    currentUser.set("level", num);
                    console.log(num++);
                    currentUser.save(null, {
                        success: function(currentUser) {
                          // Execute any logic that should take place after the object is saved.
                          //alert('New object created with objectId: ' + currentUser.id);
                          location.reload(true);
                        },
                        error: function(currentUser, error) {
                          // Execute any logic that should take place if the save fails.
                          // error is a Parse.Error with an error code and message.
                          alert('Failed to create new object, with error code: ' + error.message);
    
                    }
                });
                
            });
    });
}










//     if (FB.getLoginStatus()) {
//     console.log(currentUser);


// //    var name = currentUser.get("name");
//     $(".container").html('' +
//                         '<p> You are logged in :)</p>' +
//                         '<button id="logout">Log out</button>');


//     } else {
//     console.log("nope");
//     $(".container").html('<div class="row"><div class="main">'+
//                         '<h3>Please Log In, or <a href="signup.html">Sign Up</a></h3>'+
//                         '<div class="row"><div class="col-xs-6 col-sm-6 col-md-6">'+
//                         '<a id="facebook" class="btn btn-lg btn-primary btn-block">Facebook</a>'+
//                         '</div><div></div>');
//         }
//     };



</script>


        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
