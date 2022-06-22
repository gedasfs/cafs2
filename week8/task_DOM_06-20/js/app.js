/*
2022-06-20
DOM [JavaScript]
Sukurkite HTML dokumentą, kuris <body> dalyje turės tris žymas, t.y. <header>, <main>, <footer>. 
<header> dalyje bus navigacijos meniu su 5 nuorodomis, kuris bus “Responsive” (mobilioje versjoje turi būti “toggler” mygtukas, kurį paspaudus atsiranda meniu).
<main> dalyje bus trys <section>:
Pirmas <section> turės pilno pločio ir aukčio “slider” foną, kuriame bus trys paveikslėliai, kurie keisis kas 2 sekundės;
Antras <section> turės pilno pločio ir ne mažesnę nei 300px aukščio laikrodį (laikas rodomas kaip tekstas), kuriame bus matomos dabartinės valandos, minutės ir sekundės (atsinaujins realiu laiku); 
Trečias <section> turės kontaktų formą, kurią užpildžius, po ja pasirodys žinutė, kurioje nurodoma, kad forma užpildyta sėkmingai
*/


const navHamCont = document.querySelector('.nav-hamburger-cont');
const barIcon = document.querySelector('.bi-list');
const closeIcon = document.querySelector('.bi-x');
const navList = document.querySelector('.nav-links');

navHamCont.addEventListener('click', function() {
    barIcon.classList.toggle('burger-active');
    navList.classList.toggle('nav-active');
    closeIcon.classList.toggle('burger-active');
  });




const slides = document.querySelectorAll('.slide');
let curSlide = 0;

function slideImg() {

    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = 'none';
    }
    curSlide++;
    if (curSlide > slides.length) {
        curSlide = 1;
    }
    slides[curSlide - 1].style.display = 'block';
}
// setInterval(slideImg, '2000');

const clockDiv = document.querySelector('.clock');

function startClock() {
    const curDate = new Date();
    let h = curDate.getHours();
    let m = curDate.getMinutes();
    let s = curDate.getSeconds();

    m = checkTimeForZeros(m);
    s = checkTimeForZeros(s);

    clockDiv.textContent = h + ':' + m + ':' + s;
}

function checkTimeForZeros(timing) {
    if (timing < 10) {
        timing = '0' + timing;
    }
    return timing;
}
// setInterval(startClock, '1000');


const form = document.querySelector('form');
const firstName = form.querySelector('#firstname');
const email = form.querySelector('#email');
const comment = form.querySelector('#comment');
const notification = form.querySelector('.notification');


window.addEventListener('DOMContentLoaded', () => {
    setInterval(slideImg, '2000');
    setInterval(startClock, '1000');

    form.addEventListener('submit', (e) => {
        e.preventDefault();
    
        if (firstName.value == '' || email.value == '' || comment.value == '') {
            notification.textContent = 'Required fields not filled in.';
            notification.style.color = 'red';
        } else {
            notification.textContent = 'Your reqest has been accepted.';
            notification.style.color = 'green';
        }
    });
});