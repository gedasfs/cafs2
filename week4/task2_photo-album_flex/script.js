const navHamburger = document.querySelector('.nav-hamburger-cont');
const barIcon = document.querySelector('.bi-list');
const closeIcon = document.querySelector('.bi-x');
const navList = document.querySelector('.ul-nav-links');
const navButton = document.querySelector('.nav-btn-cont');

navHamburger.addEventListener('click', function() {
  barIcon.classList.toggle('burger-active');
  navList.classList.toggle('nav-active')
  closeIcon.classList.toggle('burger-active');
  navButton.classList.toggle('nav-active');
});