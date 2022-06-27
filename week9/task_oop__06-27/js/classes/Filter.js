class Filter {
    
    constructor(products) {
        this.products = this.setProducts(products);

    }

    setProducts(productsArr) {
        console.log(productsArr)
        if (Array.isArray(productsArr) && productsArr.length !== 0) {
            return productsArr;
        } else {
            throw new Error(`An array required, passed ${typeof productsArr}`);
        }
    }

    //check if arr elements are objects?
    

    getFilteredByCategory(category) {
        if (category !== '') {
            let result = [];
            
            result = this.products.filter(product => product.getCategory() === category);
            
            return result;
        } else {
            return null;
        }
    }

    getFilteredByPrice() {

    }

    getFilteredBySalePrice() {
        let result = [];

        result = this.products.filter(product => product.getSalePrice());

        return result;
    }
}