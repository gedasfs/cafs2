const navHamburger = document.querySelector('.nav-hamburger');
const barIcon = document.querySelector('.bi-list');
const closeIcon = document.querySelector('.bi-x');
const navList = document.querySelector('.ul-nav-links');

navHamburger.addEventListener('click', function() {
  barIcon.classList.toggle('btn-active');
  navList.classList.toggle('nav-active')
  closeIcon.classList.toggle('btn-active');
});