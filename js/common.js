$('.dropdown-toggle').click(function(e) {
    e.preventDefault();
    e.stopPropagation();

    return false;
});


function autoHeight() {
	document.getElementById("autoHeight").style.height = 'auto';
};

function goToPageBook(id){
	window.location.href = "PageBook.php?Id="+id;
}
