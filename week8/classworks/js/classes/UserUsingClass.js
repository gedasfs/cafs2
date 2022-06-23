class UserUsingClass {

    constructor(name, city, age) {
        this.name = name;
        this.age = age;
        this.birthYear = (new Date()).getFullYear() - age;
        this.city = city;
    }

    sayHelloWorld() {
        return 'Hello World';
    }
    
    greetings() {
        return `Hello, my name is ${this.name}!`;
    }
    
    sayHelloWorldWithGreetingsAsString() {
        return this.sayHelloWorld() + ', ' + this.greetings();
    }

    sayHelloWorldWithGreetingsAsArray(someValue) {
        return [
            someValue,
            this.sayHelloWorld(),
            this.greetings()
        ];
    }
}