$(document).ready(function () {
    $('.header').height($(window).height());
})

function scrollToContact() {
    var contactSection = document.getElementById('contact');
    contactSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
}

$(document).ready(function () {
    $('.dropdown-toggle').dropdown();
});

src = "https://code.jquery.com/jquery-3.7.1.js"; integrity = "sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
crossorigin = "anonymous"
src = "https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
integrity = "sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s"
crossorigin = "anonymous"
type = "module"; src = "https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"

const wrapper = document.querySelector(".wrapper");
const loginLink = document.querySelector(".login-link");
const registerLink = document.querySelector(".register-link");
const iconClose = document.querySelector(".icon-close");
const loginForm = document.querySelector("#loginForm");
const registerForm = document.querySelector("#registerForm");

registerLink.addEventListener("click", () => {
    loginForm.style.display = "none";
    registerForm.style.display = "block";
});

loginLink.addEventListener("click", () => {
    loginForm.style.display = "block";
    registerForm.style.display = "none";
});

iconClose.addEventListener("click", () => {
    wrapper.classList.remove("active-popup");
    loginForm.style.display = "block";
    registerForm.style.display = "none";
});

function switchForm() {
    const wrapper = document.querySelector('.wrapper');
    wrapper.classList.toggle('active');
}

src = "cursortrail.js"
type = "module"; src = "https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"