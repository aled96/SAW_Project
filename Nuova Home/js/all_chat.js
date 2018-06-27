'use strict';

window.onload = function() {
	websocketallchat();
};

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

function websocketallchat(){
    xmlreq = getXMLHttpRequestObject();

    var url = encodeURI("./script/async_socket_all_chat.php");
    xmlreq.onreadystatechange = check_socket_all_chat;
    xmlreq.open("GET", url, true);
    xmlreq.send();
}

function check_socket_all_chat() {
    if (xmlreq.readyState == 4) {
        if (xmlreq.status == 200) {
            if (xmlreq.responseText != null)
            {
                if (xmlreq.responseText != "0")
                {
                    var updates = xmlreq.responseText.split(',');
					for(var i = 0; i < updates.length; i++)
					{
						var fields = updates[i].split(" ");
                        for(var j = 0; j < fields.length; j+=2)
                        {
                        	if(fields[j+1] != null) {
                                var statName = "status" + fields[j];
                                if(document.getElementById(statName) == null)
                                {
                                    var now = new Date();
                                    var d = now.getFullYear()  + "-" + (now.getMonth()+1) + "-" + now.getDate() + " " +
                                    now.getHours() + ":" + now.getMinutes() + ":" + now.getSeconds();
                                    var html_to_insert = '<tr><td><img class="mini-image" src="https://bootdey.com/img/Content/user_1.jpg" alt=""><a class="name" href="view_chat.php?user_to='+fields[j]+'">'+fields[j]+'</a></td>'+ '<td>'+d+'</td><td id=status'+fields[j]+' class="text-center"><span class="label label-warning">Unread ('+fields[j+1]+')</span></td></tr>';
                                    document.getElementById("tbody_chat").insertAdjacentHTML('afterbegin', html_to_insert);
                                }
                                else {
                                    document.getElementById(statName).innerHTML = '';
                                    document.getElementById(statName).insertAdjacentHTML('beforeend', '<span class="label label-warning">Unread (' + fields[j + 1] + ')</span>');
                                }
                            }
                            else{
                                document.getElementById("all_messages").innerHTML = '';
                                document.getElementById("all_messages").insertAdjacentHTML('beforeend', "<li><a href='chat.php'>Messages<i class='fa fa-exclamation-circle red-message' id='message-alert' name='message-alert'></i></a></li>");
							}
                        }
					}
                    setTimeout(function() { websocketallchat(); }, 5000);
                }
                else{
                    setTimeout(function() { websocketallchat(); }, 5000);
                }
            }
            else setTimeout(function() { websocketallchat(); }, 10000);
        }
        else
            setTimeout(function() { websocketallchat(); }, 10000);
    }
}
