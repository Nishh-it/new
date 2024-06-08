const wrapper = document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');
const createLink = document.querySelector('.create-link');
const btnPopup = document.querySelector('.btnLogin-popup');
const iconClose = document.querySelector('.icon-close');
const forgotLink = document.querySelector('.forgot-link');

registerLink.addEventListener('click',()=>{
    wrapper.classList.add('active');
    wrapper.classList.remove('set');
});

createLink.addEventListener('click',()=>{
    wrapper.classList.add('active');
    wrapper.classList.remove('set');
});

loginLink.addEventListener('click',()=>{
    wrapper.classList.remove('active','set');
});

forgotLink.addEventListener('click',()=>{
    wrapper.classList.add('set');
});

btnPopup.addEventListener('click',()=>{
    wrapper.classList.add('active-popup');
});

iconClose.addEventListener('click',()=>{
    wrapper.classList.remove('active-popup','active','set');
});