var enabled = true;

chrome.runtime.onMessage.addListener(
	function(request, sender, sendResponse) {
		if (request.state == "checkUrl" && enabled) {
			var data = getArrayInLocalStorage('sites');
			var index = checkExistingSite(data, request.url);
			if (index > -1)
				sendResponse({isBlocked : true, reports : data[index].REPORTED, description : data[index].WEBDESC});
			else
				sendResponse({isBlocked : false});
		}
		else if (request.state == "setEnable") 
			enabled = request.enabled;
		else if (request.state == "getEnable") 
			sendResponse({isEnabled : enabled});
});

chrome.runtime.onStartup.addListener(function() {
    requestData();
});

chrome.runtime.onInstalled.addListener(function() {
    requestData();
});

function requestData()
{
	$.get("http://www.besut.info/requests/blockedsites", function(data, status){
		if (status == "success") {
			setArrayInLocalStorage('sites', data);
		}
    });
}

function setArrayInLocalStorage(key, array) 
{
    localStorage.setItem(key, array);
}

function getArrayInLocalStorage(key) 
{
    return JSON.parse(localStorage.getItem(key));
}

function checkExistingSite(data, url)
{
	var index = data.findIndex(function(item, i){
	  return item.DOMAIN === url
	});
	return index;
}