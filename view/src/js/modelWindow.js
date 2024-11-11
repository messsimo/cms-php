// Vars
const btnAddUserOpen = document.getElementById("openForm-btn");
const btnAddUserClose = document.getElementById("closeForm-btn");
const formAddUser = document.querySelector(".create-user--form");
const dashboardOverlay = document.querySelector(".overlay");

// Open form
btnAddUserOpen.addEventListener("click", function() {
    formAddUser.classList.toggle("active");
    dashboardOverlay.classList.toggle("active");
});

// Close form
btnAddUserClose.addEventListener("click", function() {
    formAddUser.classList.toggle("active");
    dashboardOverlay.classList.toggle("active");
});