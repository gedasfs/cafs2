"use strict"

function addition(num1, num2) {
  return num1 + num2;
}

function substraction(num1, num2) {
  return num1 - num2;
}

function multiplication(num1, num2) {
  return num1 * num2;
}

function division(num1, num2) {
  return num1 / num2;
}

function calculateValue(num1, num2, action) {
  if (Number(num1) != num1 || Number(num2) != num2) {
    throw new Error('One or both numbers are not a number.');
  }

  const actions = [addition, substraction, multiplication, division];
  const indexOfAction = actions.map(x => x.name).indexOf(action);

  if (indexOfAction === -1) {
    throw new Error('Action not recognized.');
  }

  return actions[indexOfAction](num1, num2);
}



const result = document.querySelector('#result');
const numerics = document.querySelectorAll('input');
const operations = document.querySelectorAll('button');


let number = '';

 
numerics.forEach(numeric => {
	// console.log(Number(num.defaultValue));
	
	numeric.addEventListener('click', function(event) {
		number += event.target.value;
		console.log(number);
	});
});


operations.forEach(oper => {
	// console.log(action.id);
	oper.addEventListener('click', function(event) {
		let action = event.target.id;
		console.log(action);
	});
})