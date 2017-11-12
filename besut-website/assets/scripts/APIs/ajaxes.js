function markNotif(idnotif)
{
  $.ajax({
    type:"post",
    url: baseurl + "report/markNotif",
    data:
    {
      id : idnotif
    },
    function(response)
    {
      setTimeout(function(){
          return TRUE;
      }, 200);
    }
  });
}

function postUser(uid, uname, photo, uemail)
{
  $.ajax({
    type:"post",
    url: "user",
    data:
    {
      id : uid,
      name : uname,
      image : photo,
      email : uemail,
      position : getCurrentPosition()
    },
    success:function(response)
    {
      // alert(response);
      if (response == "blocked")
        alert("You are Blocked from Good Area!");
      else if (response == "failed")
        alert("your account isn't provided enough data!");
      location.reload();
    },
    error: function(e, a, z)
    {
      console.log(e);
      console.log(a);
      console.log(z);
      alert("something is wrong, try again!");
      location.reload();
    }
  });
}

function postVote(report, up)
{
  var votes = 'VOTESHOAX';
  if (up) votes = 'VOTESNOT';
  // console.log(baseurl);
  //     console.log(report);
  //     console.log(votes);
  $.ajax({
    type:"post",
    url: baseurl + "report/vote",
    data:
    {
      indexReport : report,
      vote : votes
    },
    success:function(response)
    {
      if (response == 'poster')
        alert("You aren't allowed to vote because you submited this");
      else if (response == false)
        alert("you already voted!");
      else {
        if (up)
          $("#ctrnot").html(response + " VOTE not Hoax");
        else
          $("#ctrhoax").html(response + " VOTE Hoax");
      }
    },
    error: function(e, a, z)
    {
      console.log(e);
      console.log(a);
      console.log(z);
      alert("something is wrong, try again!");
      location.reload();
    }
  });
}

function signOut()
{
  FB.getLoginStatus(function(response) {
    if (response.status === 'connected') {
      FB.logout(function(response) {
        $.get("user/logout", function(data, status) {
          setTimeout(function(){
              location.reload();
          }, 200);
          // window.location = "http://158.140.171.145";
        });
      });
    }
  });
  var auth2 = gapi.auth2.getAuthInstance();
      auth2.signOut().then(function () {
        $.get("user/logout", function(data, status){
          auth2.disconnect();
          setTimeout(function(){
              location.reload();
          }, 200);
          // alert(data);
          // alert(status);
          // window.location = "http://158.140.171.145";
        });
  });
}

function checkGuide()
{
  if ($('#title').val().length == 0) {
    alert("Put a Title");
    return false;
  }
  else if ($('#desc').val().length == 0) {
    alert("give some good description");
    return false;
  }
  else if (!$('#note').is(':checked')) {
    alert("make sure you've read the guide");
    return false;
  }
}

$(document).ready(function () {
  $( "#link" ).keyup(function() {
    if ($( "#link" ).val().length == 0)
      $('#web').hide(1000);
    else
      $('#web').show(1000);
  });
});
