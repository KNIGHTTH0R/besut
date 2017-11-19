chrome.runtime.sendMessage({state : "checkUrl", url: window.location.hostname}, function(response) {
	if (response.isBlocked) {
		window.stop();
		document.write('<div style="color: #989c9e; margin: auto; box-shadow: 0 1px 2px #c9cccd; background-color: #ecf0f1; width: 50%;">');
		document.write('<h2 style="color: #363838; padding-top: 20px; text-align: center;">Besut - Hoax Blocker</h2>');
		document.write('<div style="height: 1px; line-height: 1px; border-bottom: solid 2px #989c9e;"></div>');
		document.write('<h3 style="background-color: red; padding: 15px 0; margin: 0; color: #ffffff; text-align: center;">' + window.location.hostname + '</h3>');
		document.write('<div style="height: 1px; line-height: 1px; border-bottom: solid 2px #989c9e;"></div><h3 style="text-align: center; margin-bottom: 0px; color: #000000;">Hoax Terlapor Sebanyak ' + response.reports + " Laporan</h3>");
		document.write('<div style=" color: #000000; white-space: pre-wrap; padding: 30px;">' + response.description + '</div>');
	}
});