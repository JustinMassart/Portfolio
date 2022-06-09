const firstName = document.querySelector('.title__firstname');

document.addListener('scroll', () => {
    firstName.style.top = window.scrollY * 5 + "px";
})