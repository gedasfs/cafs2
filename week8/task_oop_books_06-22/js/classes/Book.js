class Book {
    constructor(name, author, year) {
        this.name = name;
        this.author = author;
        this.year = +year;
        this.setAge(this.year);
    }

    setAge(year) {
        if (year) {
            let currYear = new Date().getFullYear();
            this.age = currYear - year;
        } else {
            return false;
        }
    }

    getNameAndAuthor() {
        if (this.name && this.author) {
            // return [
            //     this.name,
            //     this.author,
            // ];

            return {
                name: this.name,
                author: this.author,
            }
        } else {
            return false;
        }
    }

    getAge() {
        if (this.age) {
            return this.age;
        } else {
            return false;
        }
    }
}