<!DOCTYPE html>
<html>
<head>
<title>Facebook Login JavaScript Example</title>
<meta charset="UTF-8">
<meta name="google-signin-client_id" content="540463499518-ns8njfhs138fvrg1blfagmgq6vpl2d7m.apps.googleusercontent.com">
</head>
<body>
<div id="profile"></div>
<li><a id="logout" href="#" onclick="logout()">Logout</a></li>
<div
    scope="public_profile,email,user_location"
    class="fb-login-button"
    data-max-rows="1"
    data-size="large"
    data-button-type="continue_with" onlogin="checkLoginState();"></div>
<div id="status"></div>
<div class="g-signin2" data-onsuccess="onSignIn"></div>
<a href="https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=http://localhost/benangkusut" onclick="signOut();">Sign out</a>
</body>
<script src="assets/scripts/APIs/facebookAPI.js"></script>
<script src="assets/scripts/APIs/googleAPI.js"></script>
<script src="https://apis.google.com/js/platform.js" async defer></script>
</html>
