// hamburger menu function
function hamburgerMenu() {
    var x = document.getElementById("dropdown");
    var y = document.getElementById("icon");
    if (x.style.display === "block") {
        x.style.display = "none";
        y.style.transform = "rotate(0deg)";
    } else {
        x.style.display = "block";
        y.style.transform = "rotate(90deg)";
    }
}

// faq open answers function
function openAnswers(x) {
    
    var x = "id_" + x;
    var y = document.querySelectorAll('[id^="id_"]');
    
    for (var i = 0; i < y.length; i++) {

        if (x === y[i].id && y[i].style.display === "none") {
            y[i].style.display = "block";
        } else {
            y[i].style.display = "none";
        } 
    }
}