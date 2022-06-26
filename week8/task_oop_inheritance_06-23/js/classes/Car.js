/*
Užduotis: Naudojant ES6 klases sukurkite automobilių objektų kūrimo konstruktorių (Car), kuris turės šias savybes: 
1. make; 2. model; 3. year. ir metodus: 
1. getIntroduction, kuris grąžins pilną pavadinimą (su make ir model).
2. getAge, kuris gražins “10 metų arba naujesnis”, jei automobilio amžius yra 10 metų arba naujesnis arba “11 metų arba senesnis”, jei automobilio amžius yra 11 metų arba senesnis (šio metodo logikai naudokite ternary operatorių ir Date() metodą). 
Naudojant ES6 subklases sukurkite motociklų objektų kūrimo konstruktorių (Motorcycle), kuris turės visas automobilių objektų kūrimo konstruktorių (Car) savybes ir metodus ir papildomai šią savybę: 
1. wheels (kurio vertė bus number).
Ir metodą: 
1. getWheelsNumber, kuris grąžins “motociklas turi 3 ratus”, jei wheels vertė bus 3 ir “motociklas turi 2 ratus”, jei wheels vertė bus 2 (šio metodo logikai naudokite else if operatorių).
Testavimui, sukurkite du objektus, kurie turės nurodytas savybes ir metodus.
*/

class Car {
    constructor (make, model, year) {
        this.make = make;
        this.model = model;
        this.year = +year;
    }

    getIntroduction() {
        let intro = null;

        if (this.make !== '' && this.model !== '') {
            intro = {
                make: this.make,
                model: this.model,
            };
        }

        return intro;
    }

    getIntroductionMsg() {
        let intro = this.getIntroduction();

        if (intro) {
            return `Make: ${intro.make}, model: ${intro.model}.`;
        } else {
            return 'Could not get intro (make and model).';
        }
    }

    getAge() {
        let age = null;

        if (!isNaN(this.year)) {
            let currYear = new Date().getFullYear();
            age = currYear - this.year;
        }

        return age;
    }

    getAgeMsg() {
        let age = this.getAge();
        let checkCond = 10;

        if (!age) {
            return 'Could not get age.';
        }

        return (age <= checkCond) ? '10 metų arba naujesnis.' : '11 metų arba senesnis.';
    }
    
    getAll() {
        return this;
    }

}