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

function goToPageBook(id){
	window.location.href = "PageBook.php?Id="+id;
}


function checkBeforeSubmit(){
	//fai cose
	
	document.signup.submit();
}

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
