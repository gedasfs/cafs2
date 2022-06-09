"use strict"

// 2022-06-06

/* Sukurkite funkciją`getMaxSubSum(arr)`, kuri sugrąžins masyvo (Array) visų įvestų skaičių, kurie yra didesni nei 0 sumą.
 * 
 */

/*
let arr = [11, -2, 34, 45, 19, 6];

function getMaxSubSum(arr) {
	let sum = 0;

	for (let val of arr) {
		if (val > 0) {
			sum += val;
		}
	}

	return sum;
}
console.log('getMaxSubSum:', getMaxSubSum(arr));
console.assert(getMaxSubSum(arr) == 115);

// forEach
function getMaxSubSumForEah(arr) {
	let sum = 0;

	arr.forEach(function(value) {
		if (value > 0) {
			sum += value;
		}
	});

	return sum;
}
console.log('getMaxSubSumForEah:', getMaxSubSumForEah(arr));

// reducer
function getMaxSubSumReduce(arr) {
	
	return arr.reduce((previousValue, currentValue, currentIndex, fullArray) => {
		// console.log('getMaxSubSumReduce', {previousValue, currentValue, currentIndex, fullArray});

		if (currentValue > 0) {
			previousValue += currentValue;
		}

		return previousValue;
	}, 0);
}
console.log('getMaxSubSumReduce:', getMaxSubSumReduce(arr));

const getMaxSubSumReduceInline = arr => arr.reduce((prev, curr) => curr > 0 ? prev + curr : prev, 0);
console.log('getMaxSubSumReduceInline', getMaxSubSumReduceInline(arr));
// console.log(arr.reduce((prev, curr) => curr > 0 ? prev + curr : prev, 0));
*/


// Array methods
let users = [
	{name: 'John'},
	{name: 'Doe'},
];

let userId = users.findIndex( elem => elem.name === 'Doe' );
console.log(userId);

const arr1 = [1, 2, 3, 4, 5];

// forEach
console.log('forEach:')
arr1.forEach(element => console.log(element));

// map()


let arr2 = arr1.map(function(x) {
	return x = x + 1;
});
console.log('arr2 = arr1.map() ', 'arr1:', arr1, '. arr2:', arr2);

// include()

// filter()

// reduce()

// some()

// every()

// Array.from()

//Array.of()



// Tasks
let nums = String(123);

console.log(nums.split(''));