$(document).ready(function () {
  $("#child_parent button").on("click", function(){
    postComment($("#idreport").text(), 0, $("#child_parent textarea").val());
    return false;
  });
  $(".fa-reply").on("click", function(){
    if ($($($(this).parents("div").parents("div")).children('.commentarea')).has('form').length == 0)
      $($($(this).parents("div").parents("div")).children('.commentarea')).append($("#commenttemp").html());
  });
  $(".commentarea").on("click", "button", function(){
    var treport = $("#idreport").text();
    var tparent = $(this).parents("form").parents("div").children('p').text();
    var treply = $(this).parents("form").children('.topwrap').children('.posttext').children('.textwraper').children('textarea').val();
    postComment(treport, tparent, treply);
    return false;
  });
});

function postComment(report, parent, reply)
{
  console.log(report);
  console.log(parent);
  console.log(reply);
  if (reply == "") {
    alert("Write something");
    return false;
  }
  $.ajax({
    type:"post",
    url: "../../report/reply",
    data:
    {
      report : report,
      parent : parent,
      reply : reply
    },
    success:function(response)
    {
      $("#comments").html(response);
      var parag = document.getElementsByClassName("p_comments");
      for (var i = 0; i < parag.length; i++) {
        if (parag[i].innerHTML == "'" + reply + "'") {
          window.scrollTo(0, parag[i].offsetTop - 100);
        }
      }

      return false;
    },
    error: function(e, a, z)
    {
      console.log(e);
      console.log(a);
      console.log(z);
      return false;
    }
  });
}

function voteComment(comment, up)
{
  var votes = 'VOTEDOWN';
  if (up) votes = 'VOTEUP';
  console.log(comment);
  console.log(up);
  console.log(votes);
  $.ajax({
    type: "post",
    url: "../../report/voteComment",
    data:
    {
      comment : comment,
      vote : votes
    },
    success:function(response)
    {
      alert(response);
      if (response == 'poster')
        alert("You aren't allowed to vote because you submited this");
      else if (response == false)
        alert("you already voted!");
      else {
        if (up)
          $("#up_" + comment).html(response);
        else
          $("#down_" + comment).html(response);
      }
      return false;
    },
    error: function(e, a, z)
    {
      console.log(e);
      console.log(a);
      console.log(z);
      alert("something is wrong, try again!");
      return false;
    }
  });
}
