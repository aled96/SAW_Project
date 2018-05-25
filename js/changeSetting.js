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
        document.getElementById("errorSettingsBox").innerHTML = "Some Data are missing Missing!";
        return;
    }
    
	
    xmlreq = getXMLHttpRequestObject();

    url = encodeURI("async_checkemailModify.php" + "?email=" + email+"&username=" + user);
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

    url = encodeURI("async_select_city.php" + "?province=" + province);

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


function SHA1(msg) {
  function rotate_left(n,s) {
    var t4 = ( n<<s ) | (n>>>(32-s));
    return t4;
  };
  function lsb_hex(val) {
    var str="";
    var i;
    var vh;
    var vl;
    for( i=0; i<=6; i+=2 ) {
      vh = (val>>>(i*4+4))&0x0f;
      vl = (val>>>(i*4))&0x0f;
      str += vh.toString(16) + vl.toString(16);
    }
    return str;
  };
  function cvt_hex(val) {
    var str="";
    var i;
    var v;
    for( i=7; i>=0; i-- ) {
      v = (val>>>(i*4))&0x0f;
      str += v.toString(16);
    }
    return str;
  };
  function Utf8Encode(string) {
    string = string.replace(/\r\n/g,"\n");
    var utftext = "";
    for (var n = 0; n < string.length; n++) {
      var c = string.charCodeAt(n);
      if (c < 128) {
        utftext += String.fromCharCode(c);
      }
      else if((c > 127) && (c < 2048)) {
        utftext += String.fromCharCode((c >> 6) | 192);
        utftext += String.fromCharCode((c & 63) | 128);
      }
      else {
        utftext += String.fromCharCode((c >> 12) | 224);
        utftext += String.fromCharCode(((c >> 6) & 63) | 128);
        utftext += String.fromCharCode((c & 63) | 128);
      }
    }
    return utftext;
  };
  var blockstart;
  var i, j;
  var W = new Array(80);
  var H0 = 0x67452301;
  var H1 = 0xEFCDAB89;
  var H2 = 0x98BADCFE;
  var H3 = 0x10325476;
  var H4 = 0xC3D2E1F0;
  var A, B, C, D, E;
  var temp;
  msg = Utf8Encode(msg);
  var msg_len = msg.length;
  var word_array = new Array();
  for( i=0; i<msg_len-3; i+=4 ) {
    j = msg.charCodeAt(i)<<24 | msg.charCodeAt(i+1)<<16 |
    msg.charCodeAt(i+2)<<8 | msg.charCodeAt(i+3);
    word_array.push( j );
  }
  switch( msg_len % 4 ) {
    case 0:
      i = 0x080000000;
    break;
    case 1:
      i = msg.charCodeAt(msg_len-1)<<24 | 0x0800000;
    break;
    case 2:
      i = msg.charCodeAt(msg_len-2)<<24 | msg.charCodeAt(msg_len-1)<<16 | 0x08000;
    break;
    case 3:
      i = msg.charCodeAt(msg_len-3)<<24 | msg.charCodeAt(msg_len-2)<<16 | msg.charCodeAt(msg_len-1)<<8  | 0x80;
    break;
  }
  word_array.push( i );
  while( (word_array.length % 16) != 14 ) word_array.push( 0 );
  word_array.push( msg_len>>>29 );
  word_array.push( (msg_len<<3)&0x0ffffffff );
  for ( blockstart=0; blockstart<word_array.length; blockstart+=16 ) {
    for( i=0; i<16; i++ ) W[i] = word_array[blockstart+i];
    for( i=16; i<=79; i++ ) W[i] = rotate_left(W[i-3] ^ W[i-8] ^ W[i-14] ^ W[i-16], 1);
    A = H0;
    B = H1;
    C = H2;
    D = H3;
    E = H4;
    for( i= 0; i<=19; i++ ) {
      temp = (rotate_left(A,5) + ((B&C) | (~B&D)) + E + W[i] + 0x5A827999) & 0x0ffffffff;
      E = D;
      D = C;
      C = rotate_left(B,30);
      B = A;
      A = temp;
    }
    for( i=20; i<=39; i++ ) {
      temp = (rotate_left(A,5) + (B ^ C ^ D) + E + W[i] + 0x6ED9EBA1) & 0x0ffffffff;
      E = D;
      D = C;
      C = rotate_left(B,30);
      B = A;
      A = temp;
    }
    for( i=40; i<=59; i++ ) {
      temp = (rotate_left(A,5) + ((B&C) | (B&D) | (C&D)) + E + W[i] + 0x8F1BBCDC) & 0x0ffffffff;
      E = D;
      D = C;
      C = rotate_left(B,30);
      B = A;
      A = temp;
    }
    for( i=60; i<=79; i++ ) {
      temp = (rotate_left(A,5) + (B ^ C ^ D) + E + W[i] + 0xCA62C1D6) & 0x0ffffffff;
      E = D;
      D = C;
      C = rotate_left(B,30);
      B = A;
      A = temp;
    }
    H0 = (H0 + A) & 0x0ffffffff;
    H1 = (H1 + B) & 0x0ffffffff;
    H2 = (H2 + C) & 0x0ffffffff;
    H3 = (H3 + D) & 0x0ffffffff;
    H4 = (H4 + E) & 0x0ffffffff;
  }
  var temp = cvt_hex(H0) + cvt_hex(H1) + cvt_hex(H2) + cvt_hex(H3) + cvt_hex(H4);

  return temp.toLowerCase();
}

