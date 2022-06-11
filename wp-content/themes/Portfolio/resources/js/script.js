console.log('Hello there');

const inputs = document.querySelectorAll('.inputs');
const burgerMenu = document.querySelector('.header__burger');
const menus = document.querySelectorAll('.menu');
const logo = document.querySelector('.header__logo');
const html = document.querySelector('html');
const body = document.querySelector('body');
const navigationLinks = document.querySelectorAll('.nav__item');

inputs.forEach((input) => {
    input.addEventListener('focusin', () => {
        input.children[2].classList.add('form__placeholder-move');
    })
    input.addEventListener('focusout', () => {
        input.children[2].classList.remove('form__placeholder-move');
    })
});

burgerMenu.addEventListener('click', () => {
    burgerMenu.classList.toggle("close");
    menus.forEach((menu) => {
        menu.classList.toggle("overlay");
    })
    logo.classList.toggle("header__contrast");
    html.classList.toggle("contrast");
    body.classList.toggle("contrast");
});

navigationLinks.forEach((link) => {
    link.addEventListener('click', () => {
        logo.classList.remove("header__contrast");
        html.classList.remove("contrast");
        body.classList.remove("contrast");
        burgerMenu.classList.remove("close");
        menus.forEach((menu) => {
            menu.classList.remove("overlay");
        })
    })
})