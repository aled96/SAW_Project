function resetFilters(){
	window.location.replace('category.php');
	return false;
}


function pressFaculty(idCategories){

	var objs = idCategories.value.split(" ");
	for(var i = 0; i < objs.length-1; i++)
		document.getElementById("cat"+objs[i]).checked = true;
}


function checkPrice(min,max){
	min = parseInt(min);
	max = parseInt(max);
	if((min > max) || min < 0 || max < 0)
		return false;
	return true;
}

/*
function searchBuilding(search){
	var output = "";
	if(search != "")
	{
		var ss = search.split(" ");
		var cont = 0;
		for (var i in ss) {
			if(cont == 0 )
				output = output.concat(" description LIKE");
			if(cont > 0 )
				output = output.concat(" AND description LIKE");
			output = output.concat("'%",ss[i],"%'");
			cont++;
		}
	}
	return output;
}*/

function manageCat(max){
	var output = "";
	for(var i = 1; i <= max; i++){
		if(document.getElementById("cat"+i).checked == true)
			output = output+i+" ";
	}
	return output;
}

function searchFilter(){
	//var search = document.getElementById("search").value;
	
	var priceMin = document.getElementById("priceMin").value;
	var priceMax = document.getElementById("priceMax").value;
	//var searchFiltered = "";
	
	var maxCat = document.getElementById("maxCat").value;
	var catSelected = "";
	
	if(!checkPrice(priceMin,priceMax))
	{	
		document.getElementById("priceMin").style.background = "#ffaaaa";
		document.getElementById("priceMax").style.background = "#ffaaaa";
	}
	else{
		//searchFiltered = searchBuilding(search);
		//document.getElementById("search").value = searchFiltered;
		
		catSelected = manageCat(maxCat);
		document.getElementById("catSearched").value = catSelected;
		
		document.getElementById("formCat").submit();
	}	
}

function removePriceError(){
		document.getElementById("priceMin").style.background = "#ffffff";
		document.getElementById("priceMax").style.background = "#ffffff";
}


document.addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode === 13) {
		searchFilter();

    }
});

function filter_button(){
	if(document.getElementById("filter-container").style.visibility == "visible")
	{
		document.getElementById("filter-container").style.visibility = "hidden";
		document.getElementById("filter-container").style.display = "none";
		document.getElementById("filter-button-minus").innerHTML = "<i class='fa fa-angle-down'></i>";
	}
	else{
		document.getElementById("filter-container").style.visibility = "visible";
		document.getElementById("filter-container").style.display = "block";
		document.getElementById("filter-button-minus").innerHTML = "<i class='fa fa-angle-up'></i>";
    }
}
	
