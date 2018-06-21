var xmlreq;

function getXMLHttpRequestObject() {
	var request = null;
	if (window.XMLHttpRequest) {
	    request = new XMLHttpRequest();
	} else if (window.ActiveXObject) { // Older IE.
	    request = new ActiveXObject("MSXML2.XMLHTTP.3.0");
	}
	return request;
}

function async_send_message(){
	var message = document.getElementById("input-message").value;
    var user_to = document.getElementById("user_to").value;

    if(message.length == 0 || user_to.length == 0) {
        alert("Write a message!");
        return;
    }

	xmlreq = getXMLHttpRequestObject();

	url = encodeURI("./script/async_send_message.php" + "?message=" + message + "&user_to=" + user_to);
	xmlreq.onreadystatechange = send;
	xmlreq.open("GET", url, true);
	xmlreq.send();
}

function send() {
	if (xmlreq.readyState == 4) {
		if (xmlreq.status == 200) {
            if (xmlreq.responseText != null)
            {
                document.getElementById("message-panel-body").insertAdjacentHTML('beforeend', xmlreq.responseText);
                var div = document.querySelector('#message-panel-body');
                div.scrollTop = div.scrollHeight;
                document.getElementById("input-message").value = "";
            }
			else alert("Ajax error: no data received");
		}
		else
		alert("Ajax error: " + xmlreq.statusText);
	}
}

function removeError(){
    document.getElementById("errorLoginBox").innerHTML = "<br>";
}

document.addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode === 13) {
        async_send_message();

    }
});

//when page is loaded
window.addEventListener('load',function(){
    //jump to bottom of the div
    var div = document.querySelector('#message-panel-body');
    div.scrollTop = div.scrollHeight;
});

function webchat(){
    xmlreq = getXMLHttpRequestObject();

    var user_to = document.getElementById("user_to").value;
    url = encodeURI("./script/async_chat.php?user_to=" + user_to);
    xmlreq.onreadystatechange = check_socket;
    xmlreq.open("GET", url, true);
    xmlreq.send();
}

function check_socket() {
    if (xmlreq.readyState == 4) {
        if (xmlreq.status == 200) {
            if (xmlreq.responseText != null)
            {
                if (xmlreq.responseText != "")
                {
					var updates = xmlreq.responseText.split('§§§');
                    document.getElementById("message-panel-body").insertAdjacentHTML('beforeend', updates[0]);
                    var div = document.querySelector('#message-panel-body');
                    if(updates[0] != ""){
						div.scrollTop = div.scrollHeight;
					}
                    if(updates[1] == "new"){
						document.getElementById("all_messages").innerHTML = '';
						document.getElementById("all_messages").insertAdjacentHTML('beforeend', "<li><a href='chat.php'>Messages<i class='fa fa-exclamation-circle red-message' id='message-alert' name='message-alert'></i></a></li>");
					}
                    setTimeout(function() { webchat(); }, 5000);
                }
                else{
                    setTimeout(function() { webchat(); }, 5000);
                }
            }
            else alert("Ajax error: no data received");
        }
        else
            alert("Ajax error: " + xmlreq.statusText);
    }
}

window.onload = function() {
    webchat();
};
