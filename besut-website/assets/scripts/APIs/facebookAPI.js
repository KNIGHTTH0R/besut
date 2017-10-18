window.fbAsyncInit = function() {
  FB.init({
    appId      : '517776231890588',
    cookie     : true,
    xfbml      : true,
    version    : 'v2.8'
  });

  FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
  });
};

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

function statusChangeCallback(response){
  if (response.status === 'connected') {
    console.log('logged in and authenticated');
    testAPI();
  }
  else {
    console.log('not authenticated');
  }
}


function checkLoginState() {
  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });
}

function testAPI(){
  FB.api('/me?fields=id,name,gender,location,email', function(response){
    if(response && !response.error){
      //console.log(response);
      buildProfile(response);
    }
  })
}

function buildProfile(user){
  var photo = "http://graph.facebook.com/" + user.id + "/picture?type=large&redirect=true&width=500&height=500";
  postUser(user.id, user.name, photo, user.email);
}
