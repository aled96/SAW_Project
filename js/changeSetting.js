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

function removeError(){
    document.getElementById("errorSettingsBox").innerHTML = "<br>";
}

function checkSettings(){
    var user = document.getElementById("userChange").value;
    var email = document.getElementById("emailChange").value;
    var date = document.getElementById("dateChange").value;
    var name = document.getElementById("nameChange").value;
    var surname = document.getElementById("surnameChange").value;
    var gender = document.getElementById("gender").value;
    var province = document.getElementById("province").value;
    var city = document.getElementById("cityChange").value;

    var checks = 0;

  /*  if(user.length == 0 ) {
        document.getElementById("userChange").style.borderColor = "red";
        checks = 1;
    }*/
	//Check empty field
    if(email.length == 0 ) {
        document.getElementById("emailChange").style.borderColor = "red";
        checks = 1;
    }
    if(name.length == 0 ) {
        document.getElementById("nameChange").style.borderColor = "red";
        checks = 1;
    }
    if(surname.length == 0 ) {
        document.getElementById("surnameChange").style.borderColor = "red";
        checks = 1;
    }
    if(date == "") {
        document.getElementById("dateChange").style.borderColor = "red";
        checks = 1;
    }
    if(gender == "not-selected") {
        document.getElementById("gender").style.borderColor = "red";
        checks = 1;
    }
    if(province == "not-selected") {
        document.getElementById("province").style.borderColor = "red";
        checks = 1;
    }
    if(city == "not-selected") {
        document.getElementById("cityChange").style.borderColor = "red";
        checks = 1;
    }
	
    if(checks >= 1){
        document.getElementById("errorSettingsBox").innerHTML = "Some Data are missing!";
        return;
    }
    
	
    xmlreq = getXMLHttpRequestObject();

    url = encodeURI("./script/async_checkemailModify.php" + "?email=" + email+"&username=" + user);
    xmlreq.onreadystatechange = asyncEmail;
    xmlreq.open("GET", url, true);
    xmlreq.send();
}

function asyncEmail() {
    if (xmlreq.readyState == 4) {
        if (xmlreq.status == 200) {
            if (xmlreq.responseText != null)
            {
                if (xmlreq.responseText == "ok"){
					document.settingsForm.submit();
				}
                else if(xmlreq.responseText == "email")
                    document.getElementById("errorSignupBox").innerHTML = "Email Already Taken!";
            }
            else alert("Ajax error: no data received");
        }
        else
            alert("Ajax error: " + xmlreq.statusText);
    }
}

function selectCity(){
    var province = document.getElementById("province").value;

    if(province == "not-selected")
        return;

    xmlreq = getXMLHttpRequestObject();

    url = encodeURI("./script/async_select_city.php" + "?province=" + province);

    xmlreq.onreadystatechange = asyncSelCity;
    xmlreq.open("GET", url, true);
    xmlreq.send();
}

function asyncSelCity() {
    if (xmlreq.readyState == 4) {
        if (xmlreq.status == 200) {
            if (xmlreq.responseText != null)
            {
                document.getElementById("cityChange").innerHTML = xmlreq.responseText;
            }
            else alert("Ajax error: no data received");
        }
        else
            alert("Ajax error: " + xmlreq.statusText);
    }
}

function removeErrorSignup(){
    document.getElementById("errorSettingsBox").innerHTML = "<br>";
    document.getElementById("emailChange").style.borderColor = "white";
    document.getElementById("nameChange").style.borderColor = "white";
    document.getElementById("surnameChange").style.borderColor = "white";
    document.getElementById("dateChange").style.borderColor = "white";
    document.getElementById("gender").style.borderColor = "white";
    document.getElementById("province").style.borderColor = "white";
    document.getElementById("cityChange").style.borderColor = "white";
}

document.addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode === 13) {
            checkSettings();
    }
});
