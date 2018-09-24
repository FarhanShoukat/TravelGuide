let destination = null;
let source = null;

function destDataChange() {
    let input = document.getElementById('search-d-s').value.toLowerCase();
    if (input.length === 0) {
        document.getElementById("list-d").innerHTML = "";
        return;
    }

    let xmlHttp = getXMLHttp();
    xmlHttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById("list-d").innerHTML = this.responseText;
        }
    };
    xmlHttp.open("GET","../controller/SearchHandler.php?action=1stSearch&q=" + input, true);
    xmlHttp.send();
}

function destResultClicked(dest) {
    document.getElementById("list-d").innerHTML = "";
    document.getElementById('search-d-s').value = dest;
    destination = dest;
    document.getElementById('search_secondary').style.display = "block";
    updateSearchPlaceHolder();
    updateSecondaryResults();
}

function facilityClicked() { document.getElementById("list-d").innerHTML = ""; }

function typeChanged() {
    this.updateSearchPlaceHolder();
    let x = document.getElementById('type-filter');
    x = x.options[x.selectedIndex].text;
    let html = "";
    if (x === "Attractions") {
        document.getElementById('order').style.display = "none";
        document.getElementById('price').style.display = "none";
    }
    else if(x === "Hotels" || x === "Restaurants") {
        html += "<option class='form-control'>Name</option>";
        html += "<option class='form-control'>Price</option>";
        html += "<option class='form-control'>Rating</option>";
        document.getElementById('order').style.display = "block";
        document.getElementById('price').style.display = "block";
    }
    else {
        html += "<option class='form-control'>Company Name</option>";
        html += "<option class='form-control'>Price</option>";
        html += "<option class='form-control'>Date</option>";
        document.getElementById('order').style.display = "block";
        document.getElementById('price').style.display = "block";
    }
    document.getElementById('order-by').innerHTML = html;
    this.updateSecondaryResults();
}

function sourceDataChage() {
    let input = document.getElementById('search-d-s1').value.toLowerCase();
    if (input.length === 0) {
        document.getElementById("list-d1").innerHTML = "";
        return;
    }

    let xmlHttp = getXMLHttp();
    xmlHttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById("list-d1").innerHTML = this.responseText;
        }
    };
    xmlHttp.open("GET","../controller/SearchHandler.php?action=sourceSearch&q=" + input, true);
    xmlHttp.send();
}

function sourceResultClicked(s) {
    document.getElementById("list-d1").innerHTML = "";
    document.getElementById('search-d-s1').value = s;
    source = s;
    updateSecondaryResults();
}

function updateSecondaryResults() {
    let input = document.getElementById('search-hra-s').value;
    let order = document.getElementById("order-by");
    try {
        order = order.options[order.selectedIndex].text;
    } catch (e) {}
    let min = document.getElementById("t-min").value;
    let max = document.getElementById("t-max").value;
    if(min === "") min = "0";

    let x = document.getElementById('type-filter');
    x = x.options[x.selectedIndex].text;
    if (x === "Attractions")
        showAttraction(input);
    else if(x === "Hotels")
        showHotels(input, order, min, max);
    else if(x === "Restaurants")
        showRestaurants(input, order, min, max);
    else if(source != null){
        if (x === "Travel info(By Air)") {
            showTravelInfoByAir(input, order, min, max);
        }
        else {
            showTravelInfoByRoad(input, order, min, max);
        }
    }
    else document.getElementById('sec-search-results').innerHTML = "<h4>Please select source to see travel information.</h4>";
    //document.getElementById('sec-search-results').innerHTML = html;
}

function showAttraction(input) {
    let xmlHttp = getXMLHttp();
    xmlHttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById('sec-search-results').innerHTML = this.responseText;
        }
    };
    xmlHttp.open("GET","../controller/SearchHandler.php" +
        "?action=2ndSearch" +
        "&type=attraction" +
        "&destination=" + destination +
        "&q=" + input, true);
    xmlHttp.send();
}

function showHotels(input, order, min, max) {
    let xmlHttp = getXMLHttp();
    xmlHttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById('sec-search-results').innerHTML = this.responseText;
        }
    };
    let url = "../controller/SearchHandler.php" +
        "?action=2ndSearch" +
        "&type=hotel" +
        "&destination=" + destination +
        "&q=" + input +
        "&order=" + order +
        "&min=" + min +
        "&max=" + max;
    xmlHttp.open("GET", url, true);
    xmlHttp.send();
}

function showRestaurants(input, order, min, max) {
    let xmlHttp = getXMLHttp();
    xmlHttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById('sec-search-results').innerHTML = this.responseText;
        }
    };
    let url = "../controller/SearchHandler.php" +
        "?action=2ndSearch" +
        "&type=restaurant" +
        "&destination=" + destination +
        "&q=" + input +
        "&order=" + order +
        "&min=" + min +
        "&max=" + max;
    xmlHttp.open("GET", url, true);
    xmlHttp.send();
}

function showTravelInfoByAir(input, order, min, max) {
    let xmlHttp = getXMLHttp();
    xmlHttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById('sec-search-results').innerHTML = this.responseText;
        }
    };
    let url = "../controller/SearchHandler.php" +
        "?action=2ndSearch" +
        "&type=travel" +
        "&travel=air" +
        "&source=" + source +
        "&destination=" + destination +
        "&q=" + input +
        "&order=" + order +
        "&min=" + min +
        "&max=" + max;
    xmlHttp.open("GET", url, true);
    xmlHttp.send();
}

function showTravelInfoByRoad(input, order, min, max) {
    let xmlHttp = getXMLHttp();
    xmlHttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById('sec-search-results').innerHTML = this.responseText;
        }
    };
    let url = "../controller/SearchHandler.php" +
        "?action=2ndSearch" +
        "&type=travel" +
        "&travel=road" +
        "&source=" + source +
        "&destination=" + destination +
        "&q=" + input +
        "&order=" + order +
        "&min=" + min +
        "&max=" + max;
    xmlHttp.open("GET", url, true);
    xmlHttp.send();
    // let byroads = this.currDest.byroad;

    // if(orderby === 'Price') { byroads.sort(function (a, b) { return a.tPrice - b.tPrice }); }
    // else if(orderby === 'By Date') { byroads.sort(function (a, b) { return a.timing - b.timing }); }
    // else { byroads.sort(function (a, b) { return b.tRating - a.tRating }); }

    // for(let i = 0; i < byroads.length; i++) {
    //     let byroad = byroads[i];
    //     let title = byroad.travelCompany + ' (' + byroad.timing + ')';
    //     if(title.toLowerCase().indexOf(input) !== -1) {
    //         html += "<div class='row'>" +
    //             "                    <h4 class='col-md-5'>" + title + "</h4>" +
    //             "                    <span class='col-md-2'>" + byroad.tRating + "<span class='fa fa-star mystar'></span></span>" +
    //             "                </div><br/>"
    //     }
    // }
}

function updateSearchPlaceHolder() {
    let x = document.getElementById('type-filter');
    document.getElementById('search-hra-s').placeholder = "Search " + x.options[x.selectedIndex].text + " for " + destination;
}

function getXMLHttp() {
    if (window.XMLHttpRequest)
        return new XMLHttpRequest();     // code for IE7+, Firefox, Chrome, Opera, Safari
    else
        return new ActiveXObject("Microsoft.XMLHTTP");   // code for IE6, IE5
}