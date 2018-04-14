$(document).ready(function() {   
            var sideslider = $('[data-toggle=collapse-side]');
            var sel = sideslider.attr('data-target');
            var sel2 = sideslider.attr('data-target-2');
            sideslider.click(function(event){
                $(sel).toggleClass('in');
                $(sel2).toggleClass('out');
            });
        });

$('.nav-collapse').click(function(e) {
    e.preventDefault();
    e.stopPropagation();

    return false;
});

function show(target) {
	document.getElementById(target).style.visibility = 'visible';
};

function hide(target) {
	document.getElementById(target).style.visibility = 'hidden';
};

function autoHeight() {
	document.getElementById("autoHeight").style.height = 'auto';
};


//Log In
function checkValue(field){
	var xmlrequest = null;
	if(window.XMLHttpRequest)
		xmlrequest = new XMLHttpRequest();
	else if(window.ActiveXObject)
		xmlrequest = ActiveXObject("MSXML2.XMLHTTP.3.0");
	
	var url =encodeURI("https://saw1718.herokuapp.com/validation.php"+"?"+field+"="+document.getElementById(field).value);

	xmlrequest.open("GET", url,true);
	xmlrequest.onreadystatechange = function() {
		if (xmlrequest.readyState == 4)
		{
			if(xmlrequest.status == 200) {
				if(xmlrequest.responseText != null){
					var json_output = JSON.parse(xmlrequest.responseText);
					if(json_output[0]['status'] == "ko")
						document.getElementById(field).style.background = "#ffcccc";
					else if(json_output[0]['status'] == "ok")
						document.getElementById(field).style.background = "#ccffcc";
				}
				else
					alert("Error occurred");
			}
		}
	};
	xmlrequest.send();
}

function weather(location){
	var xmlrequest = null;
	if(window.XMLHttpRequest)
		xmlrequest = new XMLHttpRequest();
	else if(window.ActiveXObject)
		xmlrequest = ActiveXObject("MSXML2.XMLHTTP.3.0");
	
	var url ="http://api.openweathermap.org/data/2.5/weather?q="+location+"&APPID=39c31ba1a800335ac824fa5862755fd9";
	
	xmlrequest.open("GET", url,true);
	xmlrequest.onreadystatechange = function() {
		if (xmlrequest.readyState == 4)
		{
			if(xmlrequest.status == 200) {
				if(xmlrequest.responseText != null){
					//alert(xmlrequest.responseText);
					var json_output = JSON.parse(xmlrequest.responseText);
					document.getElementById("weather-"+location).innerHTML = "Now in "+location+": "+json_output['weather'][0]['main']
					+"<br/>"+"Temperature: "+Math.round((json_output['main']['temp']-273.15)*10)/10+" °C";
				}
				else
					alert("Error occurred");
			}
			else
				alert("Error in status - not 200");
		}
	};
	xmlrequest.send();
}


function weatherDisable(location){
	document.getElementById("weather-"+location).innerHTML ="";
}