// Referencias al botón del menú hamburguesa y el de cerrar
const menuToggle = document.getElementById("menu-toggle");
const menuClose = document.getElementById("menu-close");
const mobileMenu = document.getElementById("mobile-menu");

menuToggle.addEventListener("click", () => {
    mobileMenu.classList.add("open");
});

// Cerrar el menú al hacer clic en la cruz
menuClose.addEventListener("click", () => {
    mobileMenu.classList.remove("open");
});

// Cerrar el menú al hacer clic fuera de él
document.addEventListener("click", (event) => {
    if (
        !menuToggle.contains(event.target) &&
        !mobileMenu.contains(event.target) &&
        !menuClose.contains(event.target)
    ) {
        mobileMenu.classList.remove("open");
    }
});
