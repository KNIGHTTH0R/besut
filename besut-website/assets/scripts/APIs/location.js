$( document ).ready(function() {
  if (navigator.geolocation)
      navigator.geolocation.getCurrentPosition(setLocation);
});

var positionString = "";

function setLocation(position)
{
  var url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=" + position.coords.latitude + "," + position.coords.longitude + "&sensor=true";
  $.get(url, function(data){
    positionString = data["results"][data["results"].length - 3]["formatted_address"];
  });
}

function getCurrentPosition()
{
  return positionString;
}
