/*
Naudojant ES6 klases sukurkite objekto Filmas (Movie) kūrimo konstruktorių, kuris turės šias savybes: 
1. name; 2. year; 3. director; 4. budget; 5. income.
ir metodus: 
1. getIntroduction, kuris grąžins filmo pilną pavadinimą (su name, year, director); 
2. getProfit, kuris grąžins sumą, kurią uždirbo (pelną) filmas.
Testavimui, sukurkite du filmus, kurie turės nurodytas savybes ir metodus.
*/

const movie1 = new Movie('Avatar', '2009', 'James Cameron', 237000000, 2847397339);
const movie2 = new Movie('Avengers: Endgame', '2019', 'Antony Russo and Joe Russo', 400000000, 2797501328);

console.log(`${movie1.getIntroduction().name}, directed by ${movie1.getIntroduction().director} (rel. ${movie1.getIntroduction().year}) profited ${movie1.getProfit()}$`);
console.log(`${movie2.getIntroduction().name}, directed by ${movie1.getIntroduction().director} (rel. ${movie2.getIntroduction().year}) profited ${movie2.getProfit()}$`);