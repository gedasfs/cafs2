const inp1 = document.querySelector('.inp1');
const inp2 = document.querySelector('.inp2');
const btn = document.querySelector('button');


btn.addEventListener('click', () => {
    inp2.value = inp1.value;
});


