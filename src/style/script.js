const burger = document.getElementById("burger_menu");
const close = document.getElementById("btn_close");
const sidebar = document.getElementById("sidebar");
burger.addEventListener("click", () => {
  sidebar.classList.toggle("hidden");
  sidebar.classList.toggle("flex");
});

const arrowNavAdmin = document.getElementById("arrow_nav_admin");
const navAdmin = document.getElementById("nav_admin");
arrowNavAdmin.addEventListener("click", () => {
  navAdmin.classList.toggle("hidden");
});
