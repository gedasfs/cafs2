/*
Sukurkime aplanką pavadinimu “Strings” ir jame inicijuokime du failus index.html ir script.js.
Index.html faile patalpinime startinį kodą, kuriame būtų pirminiai, privalomi tag’ai (<html>, <head>, <body> su privalomais child tag’ai);
Index.html failo <body> tag’o viduje susikurkime tuščią <div> turintį id=”main”;
index.html ir script.js susiekime „External JavaScript“ būdu (prieš <head> arba </body> tag’us);
Atsidarome script.js failą ir sukuriame kintamąjį “userInfoOutput”, kuriam priskiriame index.html faile esantį <div> su id=”main” (naudokite: document.getelementbyid());
Susikurkite objektą “user”, kuriam nurodykite šias savybes: vardas, pavardė;
Kintamąjam userInfoOutput naudojant “.innerHTML =” DOM nuosavybę ir atgalinius klavišus (backticks) t.y. ``, sukurkite H2 tag, kuris, nurodo “User Information” ir <p> tag’ą, kuriame pateiktas, toks sakinys “Vartotojo vardas yra (vardas), o pavardė (pavardę).”
*/

let userInfoOutput = document.getElementById('main');

let user = {
	name: 'Vardenis',
	lastname: 'Pavardenis'
};

userInfoOutput.innerHTML = 
	'<h2>User Information</h2>' +
	`<p>Vartotojo vardas yra ${user.name}, o pavardė ${user.lastname}.</p>`;