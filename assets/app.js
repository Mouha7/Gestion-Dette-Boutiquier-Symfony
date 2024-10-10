import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

// Wrong (if bundle not installed)
// import '@symfony/stimulus-bundle';

// Correct (if bundle is installed)
// import '@stimulus/stimulus'; // Assuming you're using standalone Stimulus

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

// Client configuration
const menuBurger = document.querySelector("#menu-burger");
const inputTitle = document.querySelector("#input-title a");
const sideMenu = document.querySelector("#side-menu");


menuBurger.addEventListener("click", () => {
    sideMenu.classList.toggle("hidden");
    inputTitle.classList.toggle("hidden");
});

