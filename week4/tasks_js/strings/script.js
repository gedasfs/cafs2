let userInfoOutput = document.getElementById('main');

user = {
	name: 'Vardenis',
	lastname: 'Pavardenis'
};

userInfoOutput.innerHTML = 
	`<h2>User Information</h2>` +
	`<p>Vartotojo vardas yra ${user.name}, o pavardė ${user.lastname}.</p>`;