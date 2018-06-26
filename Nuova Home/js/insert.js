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


var currentCatNumber = 1;

function selectCategory(id){
    var facName = "fac"+id;
    currentCatNumber = id;
    var faculty = document.getElementById(facName).value;

    if(faculty == "not-selected")
        return;

    xmlreq = getXMLHttpRequestObject();

    url = encodeURI("./script/async_select_category.php" + "?faculty=" + faculty);

    xmlreq.onreadystatechange = asyncSelCategory;
    xmlreq.open("GET", url, true);
    xmlreq.send();
}

function asyncSelCategory() {
    if (xmlreq.readyState == 4) {
        if (xmlreq.status == 200) {
            if (xmlreq.responseText != null)
            {
                var catName = "cat"+currentCatNumber;
                document.getElementById(catName).innerHTML = xmlreq.responseText;
            }
            else alert("Check Internet Connection!");
        }
        else
            alert("Check Internet Connection!");
    }
}

function addNewCategory(){
    currentCatNumber = currentCatNumber + 1;
    document.getElementById("number_of_categories").value = currentCatNumber;

    xmlreq = getXMLHttpRequestObject();

    url = encodeURI("./script/async_add_category.php" + "?count=" + currentCatNumber);

    xmlreq.onreadystatechange = asyncAddCategory;
    xmlreq.open("GET", url, true);
    xmlreq.send();
}

function removeCategory(num){
    var facName = "fac"+num;
    var catName = "cat"+num;
    var butName = "removeButton"+num;

    document.getElementById(facName).selectedIndex = 0;
    document.getElementById(facName).remove();
    document.getElementById(catName).selectedIndex = 0;
    document.getElementById(catName).remove();
    document.getElementById(butName).remove();
}

function asyncAddCategory() {
    if (xmlreq.readyState == 4) {
        if (xmlreq.status == 200) {
            if (xmlreq.responseText != null)
            {
                document.getElementById("categories").insertAdjacentHTML('beforeend', xmlreq.responseText);
            }
			else alert("Check Internet Connection!");
        }
        else
            alert("Check Internet Connection!");
    }
}


function checkname(name){
    var regexp1=/^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/;
    test = regexp1.test(name);
    return test;
}

function checktitle(name){
    var regexp1=/^[a-zA-Z]+(([',. -][a-zA-Z0-9 ])?[a-zA-Z0-9]*)*$/;
    test = regexp1.test(name);
    return test;
}

function checkisbn(isbn){
    var regexp1=/^(97(8|9))?\d{9}(\d|X)$/;
    test = regexp1.test(isbn);
    return test;
}

function submitNewBook(){
    var author = document.getElementById("author").value;
    var title = document.getElementById("title").value;
    var description = document.getElementById("description").value;
    var pages = document.getElementById("pages").value;
    var edition = document.getElementById("edition").value;
    var isbn = document.getElementById("isbn").value;
    var price = document.getElementById("price").value;
    var place = document.getElementById("place").value;

    var fac1 = document.getElementById("fac1").value;
    var cat1 = document.getElementById("cat1").value;

    var checks = 0;
    if(author.length == 0 || !checkname(author)) {
        document.getElementById("author").style.borderColor = "red";
        checks = 1;
    }
    if(title.length == 0  || !checktitle(title)) {
        document.getElementById("title").style.borderColor = "red";
        checks = 1;
    }
    if(description.length == 0) {
        document.getElementById("description").style.borderColor = "red";
        checks = 1;
    }
    if(pages <= 0) {
        document.getElementById("pages").style.borderColor = "red";
        checks = 1;
    }

    if(edition == "") {
        document.getElementById("edition").style.borderColor = "red";
        checks = 1;
    }
    if(isbn == "" || !checkisbn(isbn)) {
        document.getElementById("isbn").style.borderColor = "red";
        checks = 1;
    }

    if(price <= 0) {
        document.getElementById("price").style.borderColor = "red";
        checks = 1;
    }
    if(place == "" || !checkname(place)) {
        document.getElementById("place").style.borderColor = "red";
        checks = 1;
    }
    if(fac1 == "not-selected") {
        document.getElementById("fac1").style.borderColor = "red";
        checks = 1;
    }
    if(cat1 == "not-selected") {
        document.getElementById("cat1").style.borderColor = "red";
        checks = 1;
    }

    if(checks >= 1){
        document.getElementById("errorBox").innerHTML = "Some Data are missing or wrong!";
        return;
    }

    document.add_new.submit();
}

function removeErrorNewBook(){
    document.getElementById("errorBox").innerHTML = "<br>";
    document.getElementById("author").style.borderColor = "white";
    document.getElementById("title").style.borderColor = "white";
    document.getElementById("description").style.borderColor = "white";
    document.getElementById("pages").style.borderColor = "white";
    document.getElementById("edition").style.borderColor = "white";
    document.getElementById("isbn").style.borderColor = "white";
    document.getElementById("fac1").style.borderColor = "white";
    document.getElementById("cat1").style.borderColor = "white";
    document.getElementById("price").style.borderColor = "white";
    document.getElementById("place").style.borderColor = "white";
}

document.addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode === 13) {
        submitNewBook();
    }
});


function submitModifyBook(){
    var author = document.getElementById("author").value;
    var title = document.getElementById("title").value;
    var description = document.getElementById("description").value;
    var pages = document.getElementById("pages").value;
    var edition = document.getElementById("edition").value;
    var isbn = document.getElementById("isbn").value;
    var price = document.getElementById("price").value;
    var place = document.getElementById("place").value;

    var fac1 = document.getElementById("fac1").value;
    var cat1 = document.getElementById("cat1").value;

    var checks = 0;
    if(author.length == 0 || !checkname(author)) {
        document.getElementById("author").style.borderColor = "red";
        checks = 1;
    }
    if(title.length == 0  || !checktitle(title)) {
        document.getElementById("title").style.borderColor = "red";
        checks = 1;
    }
    if(description.length == 0) {
        document.getElementById("description").style.borderColor = "red";
        checks = 1;
    }
    if(pages <= 0) {
        document.getElementById("pages").style.borderColor = "red";
        checks = 1;
    }

    if(edition == "") {
        document.getElementById("edition").style.borderColor = "red";
        checks = 1;
    }
    if(isbn == "" || !checkisbn(isbn)) {
        document.getElementById("isbn").style.borderColor = "red";
        checks = 1;
    }

    if(price <= 0) {
        document.getElementById("price").style.borderColor = "red";
        checks = 1;
    }
    if(place == "" || !checkname(place)) {
        document.getElementById("place").style.borderColor = "red";
        checks = 1;
    }
    if(fac1 == "not-selected") {
        document.getElementById("fac1").style.borderColor = "red";
        checks = 1;
    }
    if(cat1 == "not-selected") {
        document.getElementById("cat1").style.borderColor = "red";
        checks = 1;
    }

    if(checks >= 1){
        document.getElementById("errorBox").innerHTML = "Some Data are missing or wrong!";
        return;
    }

    document.modify_book.submit();
}


var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('imageShow');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
 };
