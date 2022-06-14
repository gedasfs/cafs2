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

function reset() {
  displayValue = 0;
  num1 = null;
  action = undefined;
  okForNum2 = false;
  readyForNewCalc = true;
}

function performCalculation() {
  displayValue = calculateValue(Number(num1), Number(displayValue), action);
  if (displayValue.toString().length > 8) {
    displayValue = displayValue.toFixed(8);
  }
  readyForNewCalc = false;
}

// following functions are based on example at: https://freshman.tech/calculator/
function insertValueToDisplay(value) {
  if (okForNum2) {
    displayValue = value;
    okForNum2 = false;
  } else {
    if (displayValue === 0) {
      displayValue = value;
    } else {
      displayValue += value;
    }
  } 
}

function insertDecimalToDisplay(dec) {
  if (displayValue.includes(dec)) {
    return;
  } else {
    displayValue += dec;
  }
}

function handleAction(actName) {
  action = actName;
  
   if (num1 === null) {
    num1 = displayValue;
  }
  okForNum2 = true;
} 

function updateDisplayValue() {
  display.textContent = displayValue;
}

const display = document.querySelector('#display-result');
const keys = document.querySelectorAll('input');

let displayValue;
let num1;
let action;
let okForNum2;
let readyForNewCalc;

reset();
// updateDisplayValue();    // when page loads, inserts the 0 into display area

keys.forEach(key => {
  key.addEventListener('click', function(event) {
    let evTarget = event.target;

    let keyId = evTarget.id;
    let keyValue = evTarget.value;


    if (evTarget.classList.contains('action')) {
      console.log('action: ', keyValue);
      handleAction(keyId);
      updateDisplayValue();
      return;
    }

    if (evTarget.classList.contains('decimal')) {
      console.log('decimal: ', keyValue);
      insertDecimalToDisplay(keyValue);
      updateDisplayValue();
      return;
    }

    if (evTarget.classList.contains('reset')) {
      console.log('action: ', keyValue);
      reset();
      updateDisplayValue();
      return;
    }

    if (evTarget.classList.contains('equals')) {
      console.log(okForNum2);
      console.log(num1, displayValue, action);
      if (action == undefined) {
        okForNum2 = true;
        return;
      }
      performCalculation()
      updateDisplayValue();
      return;
    }


    console.log('number: ', keyValue);
    if (!readyForNewCalc) {
      reset();
    }
    insertValueToDisplay(keyValue);
    updateDisplayValue();
  });
});
