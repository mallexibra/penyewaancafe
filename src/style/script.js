const burger = document.getElementById("burger_menu");
const close = document.getElementById("btn_close");
const sidebar = document.getElementById("sidebar");
burger.addEventListener("click", () => {
  sidebar.classList.toggle("hidden");
  sidebar.classList.toggle("flex");
});
document.getElementById("year").textContent = new Date().getFullYear();

