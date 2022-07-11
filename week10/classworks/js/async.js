const numbers = [5, 1, 7, 2, -9, 8, 2, 7, 9, 4, -5, 2, -6, -4, 6];

const arrMultiplied = (numbers, num) => numbers.map(value => value * num);
console.log('1 => ', arrMultiplied(numbers, 1));

console.log('before setTimeout');
console.log('timeOutID => ', setTimeout(function () {
    console.log('console.log inside setTimeout()');
}, 2000));
console.log('after setTimeout');

console.log('before btn event listener');
document.querySelector('#btn-click-me')?.addEventListener('click', function() {
    console.log('inside btn event listener');
});
console.log('after btn event listener');
