// Vars
const btnAddProductOpen = document.getElementById("openForm-btn--product");
const btnAddProductClose = document.getElementById("closeForm-btn--product");
const formAddProduct = document.querySelector(".create-product--form");
const dashboardOverlayProduct = document.querySelector(".overlay");

// Open form
btnAddProductOpen.addEventListener("click", function() {
    formAddProduct.classList.toggle("active");
    dashboardOverlayProduct.classList.toggle("active");
});

// Close form
btnAddProductClose.addEventListener("click", function() {
    formAddProduct.classList.toggle("active");
    dashboardOverlayProduct.classList.toggle("active");
});