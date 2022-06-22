/*
Susikurkite objektų konstruktorių naudojant new pavadinimu Book, kuris galės kurti objektus, 
kurie turės šias savybes (properties): name, author, year ir metodus (naudojant prototype), 
kurių vienas parašys pavadinima ir autorių, o kitas parodys knygos amžių (senumą).
*/

const book1 = new Book('A Tale of Two Cities', 'Charles Dickens', 1859);
// console.log(`${book1.getNameAndAuthor()[0]} by ${book1.getNameAndAuthor()[1]}, ${book1.getAge()} years old.`);
console.log(`${book1.getNameAndAuthor().name} by ${book1.getNameAndAuthor().author}, ${book1.getAge()} years old.`);