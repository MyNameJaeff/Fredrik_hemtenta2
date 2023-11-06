let placeToLoad = $("#placeToLoad");
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