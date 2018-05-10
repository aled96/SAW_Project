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

function ajaxcheckPassword(){
	var user = document.getElementById("usernameLog").value;
    var password = document.getElementById("pswLog").value;

    if(user.length == 0 || password.length == 0) {
        document.getElementById("errorLoginBox").innerHTML = "Username or Password Missing!";
        return;
    }

	xmlreq = getXMLHttpRequestObject();

	url = encodeURI("async_login.php" + "?username=" + user + "&password=" + password);
	xmlreq.onreadystatechange = ajaxCheck;
	xmlreq.open("GET", url, true);
	xmlreq.send();
}

function ajaxCheck() {
	if (xmlreq.readyState == 4) {
		if (xmlreq.status == 200) {
			if (xmlreq.responseText != null)
			{
				if (xmlreq.responseText == "ok")
					document.login.submit();
				else
				    document.getElementById("errorLoginBox").innerHTML = "Wrong Username or Password!";
			}
			else alert("Ajax error: no data received");
		}
		else
		alert("Ajax error: " + xmlreq.statusText);
	}
}

function checkSettings(){






    document.settings.submit();
}

function removeError(){
    document.getElementById("errorLoginBox").innerHTML = "<br>";
}


document.addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode === 13) {
        if(document.getElementById("logIn").style.visibility == "" || document.getElementById("logIn").style.visibility == "visible")
            ajaxcheckPassword();
        else if(document.getElementById("signUpForm").style.visibility == "visible")
            checkSignUp();

    }
});

function checkSignUp(){
    var user = document.getElementById("userSign").value;
    var email = document.getElementById("emailSign").value;
    var password = document.getElementById("pswSign").value;
    var passwordconfirm = document.getElementById("pswConfirmSign").value;
    var date = document.getElementById("dateSign").value;
    var name = document.getElementById("nameSign").value;
    var surname = document.getElementById("surnameSign").value;
    var gender = document.getElementById("gender").value;
    var province = document.getElementById("province").value;
    var city = document.getElementById("citySign").value;
    var checkbox = document.getElementById("checkboxSign").checked;

    var checks = 0;

    if(user.length == 0 ) {
        document.getElementById("userSign").style.borderColor = "red";
        checks = 1;
    }
    if(email.length == 0 ) {
        document.getElementById("emailSign").style.borderColor = "red";
        checks = 1;
    }
    if(password.length == 0 ) {
        document.getElementById("pswSign").style.borderColor = "red";
        checks = 1;
    }
    if(passwordconfirm.length == 0 ) {
        document.getElementById("pswConfirmSign").style.borderColor = "red";
        checks = 1;
    }
    else
        if(passwordconfirm != password)
        {
            document.getElementById("pswConfirmSign").style.borderColor = "red";
            document.getElementById("errorSignupBox").innerHTML = "The Confirm Password is different!";
            return;
        }
    if(name.length == 0 ) {
        document.getElementById("nameSign").style.borderColor = "red";
        checks = 1;
    }
    if(surname.length == 0 ) {
        document.getElementById("surnameSign").style.borderColor = "red";
        checks = 1;
    }

    if(date == "") {
        document.getElementById("dateSign").style.borderColor = "red";
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
        document.getElementById("citySign").style.borderColor = "red";
        checks = 1;
    }

    if(checkbox == false)
    {
        document.getElementById("errorSignupBox").innerHTML = "You Must Agree with the Terms & Conditions!";
        return;
    }

    if(checks >= 1){
        document.getElementById("errorSignupBox").innerHTML = "Some Data are missing Missing!";
        return;
    }

    xmlreq = getXMLHttpRequestObject();

    url = encodeURI("async_checkemail.php" + "?email=" + email+"&username=" + user);
    xmlreq.onreadystatechange = ajaxCheckEmail;
    xmlreq.open("GET", url, true);
    xmlreq.send();
}

function ajaxCheckEmail() {
    if (xmlreq.readyState == 4) {
        if (xmlreq.status == 200) {
            if (xmlreq.responseText != null)
            {
                if (xmlreq.responseText == "ok")
                    document.signup.submit();
                else if(xmlreq.responseText == "email")
                    document.getElementById("errorSignupBox").innerHTML = "Email Already Taken!";
                else if(xmlreq.responseText == "username")
                    document.getElementById("errorSignupBox").innerHTML = "Username Already Taken!";
            }
            else alert("Ajax error: no data received");
        }
        else
            alert("Ajax error: " + xmlreq.statusText);
    }
}

function removeErrorSignup(){
    document.getElementById("errorSignupBox").innerHTML = "<br>";
    document.getElementById("userSign").style.borderColor = "white";
    document.getElementById("emailSign").style.borderColor = "white";
    document.getElementById("pswSign").style.borderColor = "white";
    document.getElementById("pswConfirmSign").style.borderColor = "white";
    document.getElementById("nameSign").style.borderColor = "white";
    document.getElementById("surnameSign").style.borderColor = "white";
    document.getElementById("dateSign").style.borderColor = "white";
    document.getElementById("gender").style.borderColor = "white";
    document.getElementById("province").style.borderColor = "white";
    document.getElementById("citySign").style.borderColor = "white";
}
