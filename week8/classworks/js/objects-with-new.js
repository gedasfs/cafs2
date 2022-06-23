// 2022-06-22 OOP
// 2. Object creation with "new"

let userObj = new Object();     // if no values are passed to constructor, () can be ommitted
userObj.name = 'Gedas';
userObj.age = '31';
userObj.city = 'Klaipeda';

userObj.sayHelloWorld = function() {
    return 'Hello World';
};

userObj.greetings = function() {
    return `Hello, my name is ${this.name}!`;
};

userObj.sayHelloWorldWithGreetingsAsString = function() {
    return this.sayHelloWorld() + ', ' + this.greetings();
};

userObj.sayHelloWorldWithGreetingsAsArray = function(someValue) {
    return [
        someValue,
        this.sayHelloWorld(),
        this.greetings()
    ];
};


console.log(userObj.sayHelloWorldWithGreetingsAsArray(123));
console.log(userObj.greetings());
