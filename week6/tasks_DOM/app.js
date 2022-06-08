const ageTable = document.getElementById('age-table');
console.log('Table with id="age-table": ', ageTable);

const tdAge = document.getElementById('age');
console.log('td with id="age": ', tdAge);


const allLabels = document.querySelectorAll('form > label');
if (allLabels.length > 0 ) {
	console.log('All label elements: ');
	for (let el of allLabels) {
		console.log(el);
	}
}


const inputs = document.querySelectorAll('form > input');
console.log('first input: ', inputs[0]);
console.log('last input: ', inputs[inputs.length-1]);
