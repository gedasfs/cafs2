// 2022-06-22 OOP
let userArr = [
    'Gedas',
    'Klaipeda',
    31
];
// ------------------------------------------------------------------
// 1. Object literal syntax for object creation
let userObj = {
    name: 'Gedas',
    city: 'Klaipeda',
    age: 31,

    sayHelloWorld: function() {
        return 'Hello World';
    },

    greetings() {
        return `Hello, my name is ${this.name}!`;
    },

    sayHelloWorldWithGreetingsAsString() {
        return this.sayHelloWorld() + ', ' + this.greetings();
    },

    sayHelloWorldWithGreetingsAsArray() {
        return [
            this.sayHelloWorld(),
            this.greetings()
        ];
    },

};

// For properties OK:
userObj.name = 'Andrius';

// Not recommended, but usable (should be written in object creation):
userObj.getKeys = function() {
    return Object.keys(this);
};

console.log(userObj.getKeys());

console.log(userObj.sayHelloWorld());
console.log(userObj.greetings());
console.log(userObj.sayHelloWorldWithGreetingsAsString());
console.log(userObj.sayHelloWorldWithGreetingsAsArray());


let userObj2 = {
    name: 'Karolis',
    city: 'Klaipeda',
    age: 31,
    city: 'Siauliai',   //overrides previous value
};


let users = [
    userObj,
    userObj2,
    {
        name: 'Kristijonas',
        city: 'Kaunas',
        age: 31,
    }
];
console.log(users);
console.log(users[2].city);     // Kaunas

// also possible:
/*
console.log(users[2]['city']);  // Kaunas
// or
const KEY = 'city';
console.log(users[2][KEY]);
console.log(users[2][function() {
    return 'city';
}()]);
*/

// Old use case when creating object using function:
/*
function User() {
    this.name = 'Gedas';
}
let userG = User;
*/


