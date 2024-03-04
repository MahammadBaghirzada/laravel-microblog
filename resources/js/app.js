import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const btn = document.getElementById("hamburger-icon");
const nav = document.getElementById("mobile-menu");

btn.addEventListener("click", () => {
    nav.classList.toggle("flex");
    nav.classList.toggle("hidden");
})
