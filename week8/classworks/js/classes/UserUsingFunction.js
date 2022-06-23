function UserUsingFunction(name, city, age) {
    this.name = name;
    this.age = age;
    this.city = city;

    this.sayHelloWorld = function() {
        return 'Hello World';
    };
    
    this.greetings = function() {
        return `Hello, my name is ${this.name}!`;
    };
    
    this.sayHelloWorldWithGreetingsAsString = function() {
        return this.sayHelloWorld() + ', ' + this.greetings();
    };
    
    this.sayHelloWorldWithGreetingsAsArray = function(someValue) {
        return [
            someValue,
            this.sayHelloWorld(),
            this.greetings()
        ];
    };
}