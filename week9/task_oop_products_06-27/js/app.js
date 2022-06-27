const currentProducts = [
    new Product('product1', 10, 'Shoes', 8),
    new Product('product2', 20, 'Pants'),
    new Product('product3', 30, 'T-Shirts', 25),
    new Product('product4', 40, 'Sweaters'),
    new Product('product5', 50, 'Shoes', 45),
];

// console.log(currentProducts);

const currFilter = new Filter(currentProducts);
console.log(currFilter.getFilteredByCategory('Shoes'));
console.log(currFilter.getFilteredBySalePrice());