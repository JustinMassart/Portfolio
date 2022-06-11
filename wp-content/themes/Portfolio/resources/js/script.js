console.log('Hello there');

// VARIABLES

/// FORM
const inputs = document.querySelectorAll('.inputs');

///BURGER
const burgerMenu = document.getElementById('burger');
const menus = document.querySelectorAll('.menu');
const logo = document.querySelector('.header__logo');
const html = document.querySelector('html');
const body = document.querySelector('body');
const navigationLinks = document.querySelectorAll('.nav__item');

/// FADE ANIMATION
const landing = document.querySelector('.landing');
const about = document.querySelector('.qualities');
const projects = document.querySelectorAll('.project');
const languages = document.querySelectorAll('.code');
const contact = document.getElementById('contact');
const schoolE = document.querySelector('.school__establishment');
const schoolS = document.querySelector('.school__study');

// CHECK IF JS ENABLED

html.classList.remove('no-js');
html.classList.add('js-enabled');

// JS

if (html.className === 'js-enabled') {
    inputs.forEach(input => {
        input.children[2].classList.remove('form__placeholder-css');
        input.children[2].classList.add('form__placeholder');
    })
    landing.classList.add('fade-in');
    about.classList.add('fade-in');
    schoolE.classList.add('fade-in');
    schoolS.classList.add('fade-in');
    projects.forEach(project => {
        project.classList.add('fade-in');
    })
    languages.forEach(language => {
        language.classList.add('fade-in');
    })


    const faders = document.querySelectorAll('.fade-in');

    const appearOptions = {
        threshold: 1,
    };
    const appearOnScroll = new IntersectionObserver(function (entries, appearOnScroll) {
        entries.forEach(entry => {
            if (!entry.isIntersecting) {
                return;
            } else {
                entry.target.classList.add('appear');
                appearOnScroll.unobserve(entry.target);
            }
        })
    }, appearOptions)

    faders.forEach(fader => {
        appearOnScroll.observe(fader);
    })

    inputs.forEach(input => {
        if (input.children[1].value !== '') {
            input.children[2].classList.add('form__placeholder-move');
        }
        input.addEventListener('focusin', () => {
            input.children[2].classList.add('form__placeholder-move');
        })
        input.addEventListener('focusout', () => {
            if (input.children[1].value === '') {
                input.children[2].classList.remove('form__placeholder-move');
            }
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

    navigationLinks.forEach(link => {
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
}