const currentProducts = [
    new Product('product1', 10, 'Shoes', 7),
    new Product('product2', 20, 'Pants'),
    new Product('product3', 30, 'T-Shirts', 25),
    new Product('product4', 40, 'Sweaters'),
    new Product('product5', 50, 'Shoes', 45),
];

// console.log(currentProducts);

const currFilter = new Filter(currentProducts);
console.log(currFilter.getFilteredByCategory('Shoes'));
console.log(currFilter.getFilteredByDiscountedPrice());
console.log(currentProducts[0].getDiscountAsPercent());
console.log(currentProducts[0].getFinalPrice());

let priceForFilter = [20, 43]; 
let priceCheckPoint = 'min';
console.log('priceForFilter: ', priceForFilter);
console.log(currFilter.getFilteredByPrices(priceForFilter, priceCheckPoint));