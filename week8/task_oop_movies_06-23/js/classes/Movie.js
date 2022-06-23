class Movie {
    constructor(name, year, director, budget, income) {
        this.name = name;
        this.year = year;
        this.director = director;
        this.budget = +budget;
        this.income = +income;
    }

    getIntroduction() {
        let intro = null;
        if (this.name && this.year && this.director) {
            intro = {
                name: this.name,
                year: this.year,
                director: this.director,
            };
        }
        return intro;
    }
    

    getProfit() {
        let profit = null;
        if (!isNaN(this.budget) && !isNaN(this.income)) {
            profit = this.income - this.budget;
        }
        return profit;
    }
}