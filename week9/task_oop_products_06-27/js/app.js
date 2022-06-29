categoryList = [
    'T-Shirts',
    'Pants',
    'Sweaters',
    'Shoes',
];

const currentProducts = [
    new Product('product1', 10.5, 'Shoes', 7),
    new Product('product2', 20, 'Pants'),
    new Product('product3', 30, 'T-Shirts', 25),
    new Product('product4', 40, 'Sweaters'),
    new Product('product5', 50, 'Shoes', 45),
];

const currFilter = new Filter();

currentProducts.forEach(product => {
    console.log(product.getNameAndPrice());

    let discPrice = product.getDiscountedPrice();
    if(discPrice) {
        console.log(`${product.getName()} discounted price: ${discPrice} (discount ${product.getDiscountAsPercent()}%)`);
    } else {
        console.log(`${product.getName()} does not have a discount.`)
    }

    console.log('-------------------------')
    currFilter.add(product);
});

let pricesForFilter = [20, 43]; 
let singelPriceForFilter = [25];
let priceCheckPoint = 'min';
let category = 'Shoes';

console.log('All products:');
console.log(currentProducts);
console.log('-------------------------');

console.log('Discounted products: ');
console.log(currFilter.getFilteredByDiscountedPrice());
console.log('-------------------------');

console.log(`Products, belonging to category "${category}":`);
console.log(currFilter.getFilteredByCategory(category));
console.log('-------------------------');

console.log(`Products, filtered by prices ${pricesForFilter[0]} and ${pricesForFilter[1]}`)
console.log(currFilter.getFilteredByPrices(pricesForFilter));
console.log('-------------------------');

console.log(`Products, filtered by price ${singelPriceForFilter} and checkpoint is ${priceCheckPoint}`)
console.log(currFilter.getFilteredByPrices(singelPriceForFilter, priceCheckPoint));
console.log('-------------------------');