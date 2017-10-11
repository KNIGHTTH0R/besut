$(document).ready(function(){
	chrome.runtime.sendMessage({state : "getEnable"}, function(response) {
		$("#opt1").prop('checked', response.isEnabled);
		if (response.isEnabled)
			$("#status").html("Hoax Blocker is Running");
		else
			$("#status").html("Hoax Blocker is disabled");
	});
	
    $("#opt1").change(function(){
		chrome.runtime.sendMessage({state : "setEnable", enabled: this.checked}, function() {
		});
    });
});

