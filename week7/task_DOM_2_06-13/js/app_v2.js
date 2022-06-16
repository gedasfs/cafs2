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

function resetAll() {
  operator = null;
  num1 = null;
  displayValue = 0;
  okForNextValue = false;

  updateDisplay();

}

function updateDisplay() {
  display.textContent = displayValue;
}

function insertValueIntoDisplay(value) {
  if (okForNextValue) {
    displayValue = value;
    okForNextValue = false;
  } else {
    if (displayValue === 0) {
      displayValue = value;
    } else {
      displayValue += value;
    }
  }
  updateDisplay();
}

function insertDecimalIntoDisplay(dec) {
  if (displayValue.toString().includes(dec)) {
    return;
  } else {
    if (displayValue == 0) {
      displayValue += dec;
    } else {
      insertValueIntoDisplay(dec); 
    }   
  }
  updateDisplay();
}

function trimDisplayValueByOne() {
  let displayValueStr = displayValue.toString();

  if (displayValueStr.length === 1) {
    displayValue = 0;
  } else {
    displayValue = displayValueStr.slice(0, -1);
  }
  updateDisplay();
}


let operator = null;
let num1 = null;
let displayValue = null;
let okForNextValue = null;

const calculator = document.querySelector('.calculator');
const keys = calculator.querySelectorAll('input');
const display = calculator.querySelector('[data-type="display"]');


resetAll();


keys.forEach((key) => {
  key.addEventListener('click', (e) => {
    let target = e.target;
    let keyValue = e.target.value;
    let btnDataType = target.dataset.type;
    let opName = target.id;


    if (btnDataType === 'equals') {
      if (!num1) {
        return;
      }
      displayValue = calculateValue(Number(num1), Number(displayValue), operator);
      updateDisplay();
      okForNextValue = true;
      operator = null;
      return;
    }

    if (btnDataType === 'operation') {
      if (operator) {
        displayValue = calculateValue(Number(num1), Number(displayValue), operator);
      } 
      
      operator = opName;
      num1 = displayValue;
      okForNextValue = true;
      updateDisplay();
      return;
    }

    if (btnDataType === 'decimal') {
      insertDecimalIntoDisplay(keyValue)
      return;
    }

    if (btnDataType === 'backspace') {
      trimDisplayValueByOne();
      return;
    }

    if (btnDataType === 'reset') {
      resetAll();
      return;
    }

    if (btnDataType === 'number') {
      insertValueIntoDisplay(keyValue)
      return;
    }
  });
});