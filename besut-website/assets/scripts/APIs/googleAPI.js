
function onSignIn(googleUser) {
  var profile = googleUser.getBasicProfile();
  postUser(profile.getId(), profile.getName(), profile.getImageUrl(), profile.getEmail());
}
