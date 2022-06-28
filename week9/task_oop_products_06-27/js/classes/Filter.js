class Filter {
    
    constructor(products) {
        this.products = this.setProducts(products);

    }

    setProducts(productsArr) {
        if (Array.isArray(productsArr) || productsArr.length !== 0) {
            return productsArr;
        } else {
            throw new Error(`An array is required, passed ${typeof productsArr}`);
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

    /*
     *  prices array    -> if 1 price is provided, providedPriceIs is needed (should be = 'max' or 'min') to filter this.products by
     * provided price either as max or min.
     *                  -> if 2 prices are provided, providedPriceIs is not needed. Both prices should be used as min and max for filtering.
     */
    getFilteredByPrices(prices, providedPriceIs = '') {
        
        if (!Array.isArray(prices) || (prices.length === 0)) {
            throw new Error(`An array is required, provided ${typeof prices}`);
        }

        if (prices.length > 2) {
            throw new Error(`An array with 1 or 2 prices required. Instead, provided ${prices.length}`);
        } else {
            prices.forEach((price, index) => {
                if (isNaN(+price)) {
                    throw new Error(`Price in provided array (index No.: ${index}) is not a number.`);
                }
            });
        }


        let result = [];
        
        if (prices.length === 1) {
            if (providedPriceIs === '' || (providedPriceIs !== 'min' && providedPriceIs !== 'max')) {
                throw new Error('ProvidedPriceIs is either empty or not "max", or not "min"');
            }

            let price = +prices[0];

            if (providedPriceIs === 'max') {
                result = this.products.filter(product => product.getFinalPrice() <= price);
                
                return result;
            } else if (providedPriceIs === 'min') {
                result = this.products.filter(product => product.getFinalPrice() >= price);
               
                return result;
            }
        }

        if (prices.length === 2) {
            let priceMin = +Math.min(...prices);
            let priceMax = +Math.max(...prices);

            result = this.products.filter(product => (product.getFinalPrice() <= priceMax) && (product.getFinalPrice() >= priceMin));
            
            return result;
        }
    }

    getFilteredByDiscountedPrice() {
        let result = [];

        result = this.products.filter(product => product.getDiscountedPrice());

        return result;
    }
}