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


