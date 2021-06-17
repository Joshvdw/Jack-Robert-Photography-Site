// hamburger menu function
console.log('hello');
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