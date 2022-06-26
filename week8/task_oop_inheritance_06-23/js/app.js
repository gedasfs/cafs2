const car1 = new Car('WV', '', '2003');
const motorc1 = new Motorcycle('Kawasaki', 'Ninja H2R', 2020, 2);

// console.log(car1.getAll());
console.log(car1.getIntroductionMsg(), car1.getAgeMsg());

// console.log(motorc1.getAll());
console.log(motorc1.getIntroductionMsg(), motorc1.getAgeMsg(), motorc1.getWheelsMsg());