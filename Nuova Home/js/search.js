function resetFilters(){
	document.getElementById("priceMin").value = "";
	document.getElementById("priceMax").value = "";
	document.getElementById("search").value = "";
	
	var maxCat = document.getElementById("maxCat").value;
	for(var i = 1; i <= maxCat; i++)
		document.getElementById("cat"+i).checked = false;
		
	document.getElementById("catSearched").value = "";
	
	document.getElementById("resetFilterButton").style.visibility = "hidden";
	return false;
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