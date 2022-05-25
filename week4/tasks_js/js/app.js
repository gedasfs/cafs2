
/* Sukurkite kodą, kuris lankytoją ragina įvesti du skaičius ir parodo jų sumą. */

/*
let num1 = +prompt('Enter Number 1:');
let num2 = +prompt('Enter Number 2:');
console.log('Sum: ', num1 + num2);
*/



/*
Sukurkite kodą, kuris sukurs penkis atsitiktinius skaičius (skaičiai negali būti didesni nei 10) ir juos priskirs kintamiesiems, kurie turi iki dviejų skaičių po kablelio;

Tada suraskite, kuris iš sukurtų skaičių yra:
didžiausias;
mažiausias.
*/


/*
let a = parseFloat((Math.random() * 10).toFixed(2));
let b = parseFloat((Math.random() * 10).toFixed(2));
let c = parseFloat((Math.random() * 10).toFixed(2));
let d = parseFloat((Math.random() * 10).toFixed(2));
let e = parseFloat((Math.random() * 10).toFixed(2));
*/

let a = getRandom();
let b = getRandom();
let c = getRandom();
let d = getRandom();
let e = getRandom();


function getRandom() {
	let numTemp = (Math.random() * 10).toFixed(2);
	return parseFloat(numTemp);
}

let maxN = Math.max(a, b, c, d, e);
let minN = Math.min(a, b, c, d, e);
console.log(a, b, c, d, e);
console.log('Max: ', maxN);
console.log('Min: ', minN);

let numArr = [];

for (let i=0; i<5; i++) {
	let numTemp;
	numTemp = (Math.random() * 10).toFixed(2);
	numArr[i] = parseFloat(numTemp);
}

console.log(numArr);
console.log('Max: ', Math.max(...numArr));
console.log('Min: ', Math.min(...numArr));