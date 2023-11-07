// Selects the div where to load the data
let placeToLoad = $("#placeToLoad");

// Each button has a on click funtion which clears the div where the data is to be loaded
// then loads the selected buttons php file using .load()
$('#add').click(() => {
    placeToLoad.html("");
    placeToLoad.load("./functions/addProduct.php")
    //window.location.href="./functions/addProduct.php";
})
$('#see').click(() => {
    placeToLoad.html("");
    placeToLoad.load("./functions/seeAllProducts.php")
})
$('#change').click(() => {
    placeToLoad.html("");
    placeToLoad.load("./functions/changeProduct.php")
})
$('#remove').click(() => {
    placeToLoad.html("");
    placeToLoad.load("./functions/removeProduct.php")
})
$('#navLink').click((event) => {
    event.preventDefault();
    placeToLoad.html("");
})