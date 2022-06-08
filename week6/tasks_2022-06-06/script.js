"use strict"
// Testuosime šį masyvą
const numbers = [5, 1, 7, 2, -9, 8, 2, 7, 9, 4, -5, 2, -6, -4, 6];

// 1. Parašykite funkciją arrDoubled, kuri sukuria ir grąžina naują masyvą, kurio elementai padauginti iš 2;
function arrDoubled(arr) {
  return arr.map(arrVal => arrVal * 2);
}

const numbers1 = arrDoubled(numbers);
console.log('1. ', numbers, numbers1);


// 2. Parašykite funkciją arrMultiplied, kuri sukuria ir grąžina naują masyvą, kurio elementai padauginti iš argumentu nurodyto skaičiaus
function arrMultiplied(arr, multiplier) {
  return arr.map(arrVal => arrVal * multiplier);
}

const numbers2 = arrMultiplied(numbers, 5);
console.log('2. ', numbers, numbers2);


// 3. Parašykite funkciją arrCountTwos, kuri suskaičiuoja dvejetus masyve
function arrCountTwos(arr) {
  let count = 0;
  
  arr.forEach(arrVal => {
    if (arrVal === 2) {
      count++;
    }
  });

  return count;
}

console.log('3. ', arrCountTwos(numbers));


// 4. Parašykite funkciją arrIndexOfFirst, kuri grąžintu pirmo surasto, argumentu nurodyto skaičiaus, indeksą masyve. Jei skaičius nerastas funkcija turi grąžinti -1.
function arrIndexOfFirst(arr, x) {
  return arr.indexOf(x);
}

console.log('4. ', arrIndexOfFirst(numbers, 7));



// 5. Parašykite funkciją arrIndexOfLast, kuri grąžintu paskutinio surasto, argumentu nurodyto skaičiaus, indeksą masyve. Jei skaičius nerastas funkcija turi grąžinti -1.
function arrIndexOfLast(arr, x) {
  return arr.lastIndexOf(x);
}

console.log('5. ', arrIndexOfLast(numbers, 6));



// 6. Parašykite funkciją reverseNumbers, kuri pakeis skaičius vietomis taip, kad pirmas skaičius taps paskutiniu, antras piešpaskutiniu, o buvęs paskutinis taps pirmu, priešpaskutinis bus antru.
// Pvz.: Turime skaičius 32243;
// Iškvietus funkciją rezultata bus: 34223
function reverseNumbers(number) {
  number = Array.from(String(number));
  
  number = number.reverse();
  number = Number(number.join(''));
  
  return number;
}
const nums = 32243;
const numsReversed = reverseNumbers(nums);
console.log('6. ', nums, numsReversed);

// 7. Parašykite  funkciją, kuri kaip argumentą priims skaičių masyvą ir suras atitinkamai mažiausią ir didžiausią skaičių bei juos grąžins.
// Pvz.: Turime masyvą: [8,5,4,2,7,1,9]
// Iškvietus funkciją rezultata bus: "Mažiausas: 1, Didžiausas: 9"
function getMinMaxFromArr(arr) {
  let minNum = Math.min(...arr);
  let maxNum = Math.max(...arr);
  let msg = `Mažiausias: ${minNum}, Didžiausias: ${maxNum}`;
  
  return msg;
}

console.log('7. ', getMinMaxFromArr(numbers));


// 8. Parašykite  funkciją checkForLetters, kuri priims du argumentus: Pirmas argumentas bus sakinys (arba žodžiai (-is)) ir antras argumentas bus raidė (kaip string). Funkcija turės suskaičiuoti kiek pirmu agrumentu nurodytame sakinyje/žodžiuose(-yje) yra antru argumentu nurodytų raidžių ir gražinti tų raidžių sumą su sakiniu pvz.: “Raidė “v” sakinyje rasta 4 kartus”.
function checkForLetters(str, char, caseInsensitive = false) {
  if (caseInsensitive) {
    str = str.toLowerCase();
    char = char.toLowerCase();
  }

  let count = 0;
  let strArr = Array.from(str);
  let msg = '';

  strArr.forEach(currChar => {
    if (currChar === char) {
      count++;
    }
  });
  msg = `Raidė “${char}” sakinyje rasta ${count} kartus.`;
  
  return msg;
}

const str = 'TAI yra sakinys.';
const char = 'a';
console.log('8. ', `"${str}" `, checkForLetters(str, char, true));


// 9. Parašykite funckiją, kuri ras visus skaičius esančius msyve ir gražins juos kaip atsikrą masyvą. Naujame masyve visi skaičiai bus surikiuoti nuo mažiausio iki didžiausio.
// let arr2 = [8, 'Hello', 'click', 'u', 7, 4, 'a', 'a', 3, 6, "chair", ,10, 1];
// Iškvietus funkciją rezultata bus: [1,3,4,6,7,8,10];
function getNumsfromArr(arr) {
  arr = arr.filter(arrVal => Number(arrVal));
  arr = arr.map(x => Number(x));
  arr = arr.sort((a, b) => a - b);
  
  return arr;
}

const arr2 = [8, 'Hello', 'click', 'u', 7, 4, 'a', 'a', 3, 6, "chair", ,10, 1, '5', -2];
console.log('9. ', arr2, ' => ', getNumsfromArr(arr2));


// 10. Sukurkite funkciję checkIfAllSmaller(arr, max), BE MASYVO METODŲ, kuri patikrintų ar visi skaičiai masyve yra didesni negu perduota reikšmė max;
// Pvz.: Turime masyvą: let arr1 = [2, 7, 6, 9, 5];
// Iškvietus funkciją checkIfAllSmaller(arr1, 5) rezultata bus: False
function checkIfAllSmaller(arr, max) {
let count = 0;

  for (let value of arr) {
    if (value > max) {
      count++;
    }
  }

  if (count == arr.length) {
    return true;
  } 

  return false;
}

const arr1 = [2, 7, 6, 9, 5];
console.log('10. ', checkIfAllSmaller(arr1, 2));


// 11. Parašykite funkciją filteredByLetter, kuri turi du parametrus: 1. masyvas; 2. raidė. Funkcija sukuria ir grąžina naują masyvą, kuriame yra visi masyvo, nurodyto kaip pirmas parametras elemntai, kuriuose galima rasti antru paramatetru nurodytą raidę.
// Testuosime šį masyvą
const citiesOfLithuania = [
  'Vilnius',
  'Kaunas',
  'Klaipėda',
  'Šiauliai',
  'Panevėžys',
  'Alytus',
  'Marijampolė',
  'Mažeikiai',
  'Jonava',
  'Utena',
];

function filteredByLetter(arr, char, caseInsensitive = false) {
    return arr.filter(arrVal => {
      if (caseInsensitive) {
        arrVal = arrVal.toLowerCase();
        char = char.toLowerCase();
      }
      return arrVal.includes(char);
    });
    
}

console.log('11. ', filteredByLetter(citiesOfLithuania, 'v', true));


// 12. Parašykite penkias funkcijas:
// - calculateValue()
// - addition()
// - subtraction()
// - multiplication()
// - division()

// Pagridinė funkcija bus calculateValue(num1, num2, action), kuri priims tris argumentus: a) num1 - skaičius;b) num2 - skaičius; c) action - (matematinis veiksmas kaip string pvz. “substraction”). Būtina, kad funckija validuotų ar num1 ir num2 yra skaičiai.

// Priklausomai trečio argumento (action), su pirmais dviem (num1 ir num2) bus atliekamas matematinis veiksmas ir kviečiama viena iš keturių funkcijų, kurios priims du argumentus (num1 ir num2) ir grąžins atlikta veiksmą.

// Pastaba: šios funkcijos: addition(), subtraction(), multiplication(), division() turi būti kviečiamas calculateValue() viduje, o aprašomos išorėje.

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
  let result = false;

  if (isNaN(num1) || isNaN(num2)) {
    return result;
  }

  switch (action) {
    case 'addition':
      result = addition(num1, num2);
      break;

    case 'substraction':
      result = substraction(num1, num2);
      break;

    case 'multiplication':
      result = multiplication(num1, num2);
      break;

    case 'division':
      result = division(num1, num2);
      break;
  }

  return result;
}

console.log('12. ', calculateValue(5, 2, 'division'));


function calculateValueBetter(num1, num2, action) {
  if (Number(num1) != num1 || Number(num2) != num2) {
    throw new Error('One or both numbers are not a number.')
  }

  const actions = [addition, substraction, multiplication, division];
  const indexOfAction = actions.map(x => x.name).indexOf(action);

  if (indexOfAction === -1) {
    throw new Error('Action not recognized.');
  }

  return actions[indexOfAction](num1, num2);
}

console.log('12. ', calculateValue(5, 2, 'division'));