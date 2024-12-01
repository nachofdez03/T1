// Referencias al botón del menú hamburguesa y el de cerrar
const menuToggle = document.getElementById("menu-toggle");
const menuClose = document.getElementById("menu-close");
const mobileMenu = document.getElementById("mobile-menu");

// Mostrar el menú al hacer clic en el botón hamburguesa
menuToggle.addEventListener("click", () => {
    mobileMenu.classList.add("open"); // Añade la clase "open" para mostrar el menú
});

// Cerrar el menú al hacer clic en la cruz
menuClose.addEventListener("click", () => {
    mobileMenu.classList.remove("open"); // Quita la clase "open" para ocultar el menú
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
