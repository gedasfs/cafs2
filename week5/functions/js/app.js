/* 2022-05-30 */
/*
function checkAge(age) {
	return ((age>18) ? true : confirm('Dide parents allow you?'));
}

checkAge(19);
*/

/*
function getMin(x, y) {
	console.log(Math.min(+x, +y));
}

getMin(5, 2);
getMin(5, -2);
getMin(3, 200);
*/


/* 2022-05-31 */
/*
function plusPlus(number, rep) {
	for (let i = 0; i < rep; i++) {
		number++
	}
	

	return number;
}
*/

/*
function plusPlusRecursion(number, rep) {
	if (rep == 0) {
		return number;
	}
	number++;
	rep--;
	

	return plusPlusRecursion(number, rep);
}
let num = 15;
console.log(plusPlus(num, 10));
console.log(plusPlusRecursion(num, 10))
*/

/* Task. Recursion function */
/*
function sumOfDigits(number) {
	if (number == 0) {
		return 0;
	}
	let remainder = number % 10;
	let remainNum = Math.floor(number / 10);

	return remainder + sumOfDigits(remainNum);
}

const sumOfDigitsArrow = (number) => {
	if (number == 0) {
		return 0;
	}

	let remainder = number % 10;
	let remainNum = parseInt(number / 10);

	return remainder + sumOfDigits(remainNum);
}

const sumOfDigitsArrow2 = number => 
	number ? 
	(number % 10) + sumOfDigitsArrow2(Math.floor(number / 10)) : 
	0;

let num = 4321	//10
console.log(sumOfDigits(num));
console.assert(sumOfDigits(num) == 10);

console.log(sumOfDigitsArrow(num));
console.assert(sumOfDigitsArrow(num) == 10);

console.log(sumOfDigitsArrow2(num));
console.assert(sumOfDigitsArrow2(num) == 10);
*/

/* Perrašykite šią “function declaration” būdu parašytą funkciją į “arrow function” (jeigu manote, kad reikia, sutvarkykite funkcijos kūną): */
/*
let cities = ["Vilnius", "Kaunas", "Klaipėda", "Šiauliai", "Panevėžys", "Marijampolė"];

const getFavoriteCity2 = (name, surname, city) => {
	let user = `${name} ${surname}`;
    let favoriteCity = city;
    return `${user} favorite city is ${favoriteCity}`;
}

const getFavoriteCity = (name, surname, city) => `${name} ${surname} favorite city is ${city}`;



console.log(getFavoriteCity2("Vardas", "Pavarde", cities[5]));
console.log(getFavoriteCity("Vardas", "Pavarde", cities[5]));
*/

/* Closures */
/*
function getSum(a) {

	function getSum2(b) {
		return a + b;
	}

	return getSum2;
}

let testFunc = getSum(5);

console.log(testFunc(4));
console.log(getSum(5)(6));
*/

/*
let message;

function checkNumber(num) {
	if (isNaN(num) || num < 1) {
		console.error('Not a number or number is negative.');
		return false;
	}

	let rem3 = num % 3;
	let rem5 = num % 5; 
	

	if (rem3 == 0 && rem5 == 0) {
		message ='Skaičius dalijasi iš 3 ir iš 5';
	} else if (rem3 == 0) {
		message ='Skaičius dalijasi iš 3';
	} else if (rem5 == 0) {
		message ='Skaičius dalijasi iš 5';
	} else {
		message ='Skaičius nesidalijasi nei iš 3, nei iš 5';
	}

	return true;
}

console.log(checkNumber(3));
console.log(message);
*/

/* Loops through objects and arrays */
/*
let objektas = {
	a: '0',
	b: '1'
};
console.log(objektas);
for (let key in objektas) {
	console.log('Loop in object: key (property name)', key, ', value (property value) ', objektas[key]);
}

let masyvas = ['a', 'b'];
console.log(masyvas);
for (let key in masyvas) {
	console.log('key in array el.', key);
}
for (let value of masyvas) {
	console.log('value or array el.', value);
}

let masyvasAss = {'a': 'aa', 'b': 'bb'};
console.log(masyvasAss);
for (key in masyvasAss) {
	console.log('key in arrayAss ', key);
}
for (key in masyvasAss) {
	console.log('value of arrayAss ', masyvasAss[key]);
}
*/


//----------------------------

/* Loops */
/*
function getLaughWhile(rep) {
	let msg = '';
	let i = 0;
	
	while (i < rep) {
		msg += 'ha';
		i++;
	}
	
	return msg + '!';
}

function getLaughDoWhile(rep) {
	let msg = '';
	let i = 0;

	do {
		msg += 'ha';
		i++;
	} while (i < rep);

	return msg + '!';
}

function getLaughFor(rep) {
	let msg = '';
	
	for (let i = 0; i < rep; i++) {
		msg += 'ha';
	}
	
	return msg + '!';
}

console.log('While: ', getLaughWhile(1));
console.log('Do-While', getLaughDoWhile(4));
console.log('For',getLaughFor(4));
*/

/*
let getHighestNumber = (...numbers) => {
	let lng = numbers.length;
	let highest = null;
	let firstNumFound = false;

	for (let i = 0; i < lng; i++) {
		let checkingVal = +numbers[i];
		
		if (isNaN(checkingVal)) {
			continue;
		} 
		if (!firstNumFound) {
			highest = checkingVal;
			firstNumFound = true;
			continue;
		} 
		if (highest < checkingVal) {
			highest = checkingVal;
		}
	}

	return highest;
}

//If console.log -> null  - all argument values are NaN.
console.log(getHighestNumber('yy', -3.3, 'z', -58, '55a', 0, '5', 66));
*/

// 2022-06-02
// Loops
/*
let y = 9;
while (y >= 1) {
	console.log('hello ' + y);
	y = y-1;
}

for (let x = 9; x >= 1; x--) {
	console.log('Hello ' + x);
}
*/

// -------------------------------------------------------------
// Arrays

/*

let arrObjs = [
	{
		name: 'Kunigunda',
		age: 23
	},
	{
		name: 'Jonas',
		age: 24
	},
	{
		name: 'Petras',
		age: 25
	},
];

let nameTest = 'Petrass';

function getArrIndexFromName(arr, name) {
	for (let key in arrObjs) {
		if (arrObjs[key]?.name == nameTest) {
			return key;
		}
	}
}

console.log(getArrIndexFromName(arrObjs, nameTest));

arrObjs.pop();
console.log(arrObjs);

arrObjs.push({name: 'Kristina', age: 30});
console.log(arrObjs);

const arrNames = ['Jonas', 'Tadas', 'Tomas', 'Emilija'];

console.log(arrNames.find(element => element == 'Emilija'));

const arrNames2 = arrNames;
console.log(arrNames2);
console.log(arrNames);
arrNames2.pop();
console.log(arrNames2);
console.log(arrNames);

arrNames2[arrNames2.length] = 'Krsitina';

console.log(arrNames2);
console.log(arrNames);

*/

// Array tasks

let styles = ['Jazz', 'Blues'];
console.log(styles);

styles.push('Rock-n-Roll');
console.log(styles);

styles[1] = 'Classics';
console.log(styles);

console.log(styles.shift());
console.log(styles);

styles.unshift('Rap', 'Reggae');
console.log(styles);