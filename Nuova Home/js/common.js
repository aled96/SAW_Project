function autoHeight() {
	document.getElementById("autoHeight").style.height = 'auto';
};

function goToPageBook(id){
	window.location.href = "pageBook.php?Id="+id;
}

function getXMLHttpRequestObject() {
	var request = null;
	if (window.XMLHttpRequest) {
	    request = new XMLHttpRequest();
	} else if (window.ActiveXObject) { // Older IE.
	    request = new ActiveXObject("MSXML2.XMLHTTP.3.0");
	}
	return request;
}

function preferite(id){
	xmlreq = getXMLHttpRequestObject();

	url = encodeURI("./script/add_favourite.php" + "?Book=" + id);
	xmlreq.onreadystatechange = ajax_pref;
	xmlreq.open("GET", url, true);
	xmlreq.send();
}

function ajax_pref() {
	if (xmlreq.readyState == 4) {
		if (xmlreq.status == 200) {
			if (xmlreq.responseText != null)
			{
				var updates = xmlreq.responseText.split(';');
				var idspan = "heart-preferite"+updates[0];
				var content = updates[1];
				var list = document.getElementById(idspan);
				list.removeChild(list.childNodes[0]);
                document.getElementById(idspan).insertAdjacentHTML('beforeend', content);
				    
			}
			else alert("Ajax error: no data received");
		}
		else
		alert("Ajax error: " + xmlreq.statusText);
	}
}

function preferite2(id){
	xmlreq = getXMLHttpRequestObject();

	url = encodeURI("./script/add_favourite.php" + "?Book=" + id);
	xmlreq.onreadystatechange = ajax_pref2;
	xmlreq.open("GET", url, true);
	xmlreq.send();
}

function ajax_pref2() {
	if (xmlreq.readyState == 4) {
		if (xmlreq.status == 200) {
			if (xmlreq.responseText != null)
			{
				location.reload();
				    
			}
			else alert("Ajax error: no data received");
		}
		else
		alert("Ajax error: " + xmlreq.statusText);
	}
}

window.onresize = function(event) {
    document.getElementById("minimenu").style.visibility = "hidden";
    document.getElementById("minimenu").style.height = "0px";
	document.getElementById("submenu").style.visibility = "hidden";
	document.getElementById("submenu").style.height = "0px";
};

function submenu(){
	if(document.getElementById("submenu").style.visibility == "visible")
	{
		document.getElementById("submenu").style.visibility = "hidden";
		document.getElementById("submenu").style.height = "0px";
	}
	else{
		document.getElementById("submenu").style.visibility = "visible";
		document.getElementById("submenu").style.height = "auto";
    }
}
