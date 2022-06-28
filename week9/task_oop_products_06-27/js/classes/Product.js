/*
Sukurkite objektų kūrimo konstruktorių (ES6 būdu) pavadinimu Products. Jo pagrindu sukurkite 5 produktus (apranga), kurie turės šias savybės: 
name, price, salePrice, category(bus kaip masyvas, jame vardijamos kategorijos, prie kurių jis priskiriamas, galimos "T-shirts", "Pants", "Sweaters", "Shoes") ir metodus,
kurie atlikas šias funkcijas:
1.1. pateiks produkto prisistatymą su pavadinimu ir kaina (arba akcijine kaina) (Pvz. "Nike pants": 59.00 Eur");
1. patikrins ar produktas turi akciję kainą ir jeigu turi gražins akcijinę kainą, jeigu neturi, grąžins tekstą, kuriame nurodoma, kad šiam produktui akcija netaikoma;
2. Sukurkite masyvą, pavadinimo currentProducts, kurima bus patalpinti 5 produktai;
3. Filtrus, kurie padės vartotojams filtruoti prekes pagal:
    1. Kainą (turi būti sukuriama funkcija (turės tris argumentus pvz.: 1 argumentas - produktai, 2 - visada bus skaičius, 3 argumentas - gali būti skaičius arba string "nuo" / "iki"), 
kuri leis vartotojui nurodyti:
        1. kainą nuo/iki (funkcja priims tis argumentus: produktų masyvas, kaina nuo, kaina iki)
        2. arba nurodyti kainą nuo ir rodys prekes nuo tos kainos iki maksimalios galimos
        3. arba kainą iki ir rodys prekes nuo minimalios galimos iki tos kainos kurią nurodė;
    2. Kategoriją (turi būti sukuriama funkcija, kuri leis vartotjui kaip argumentą nurodyti vieną iš kategorijų ir jam atvaizduos tas prekes, kurios turi tą kategoriją);
    3. Akcijas, kuri parodys tas prekes, kurios turi akcijinę kainą;
4. Patobulinkite objektų kūrimo kontsruktoriaus Products metododą aptartą 1.2. punkte, kad jis turėtų tokį funkcionalumą: patikrins ar produktas turi akciję kainą ir 
jeigu turi gražins tą nuolaidą kaip procentinę išraišką (pvz. produkto kaina 10 Eur, akcijinė kaina 7 Eur, gražins "Produktui "Nike pants" taikoma 30% nuuolada").
*/

class Product {

    constructor(name, price, category, salePrice = null) {
        this.categoryList = [
            'T-Shirts',
            'Pants',
            'Sweaters',
            'Shoes',
        ];
        
        this.name = this.setName(name);
        this.price = this.setPrice(price);
        this.salePrice = this.setDiscountedPrice(salePrice);
        this.finalPrice = this.getFinalPrice();
        this.category = this.setCategory(category);

    }

    setName(name) {
        if (typeof name === 'string' && name !== '') {
            return name;
        } else {
            throw new Error('Problems with name.');
        }
    }

    setPrice(price) {
        if (!isNaN(price)) {
            return +price;
        } else {
            throw new Error('Problems with price.');
        }
    }

    setDiscountedPrice(salePrice) {
        if ((salePrice) && !isNaN(salePrice)) {
            return +salePrice;
        } else {
            return null;
        }
    }

    setCategory(category) {
        if (typeof category === 'string' && category !== '') {
            if (this.categoryList.includes(category)) {
                return category;
            } else {
                return null;        //provided category not listed in allowed categories
            }
        } else {
            throw new Error('Problems with category.');
        }
    }

    getName() {
        return this.name;
    }

    getPrice() {
        return this.price;
    }

    getDiscountedPrice() {
        return (this.salePrice) ? this.salePrice : null;
    }

    getFinalPrice() {
        return (this.getDiscountedPrice()) ? this.getDiscountedPrice() : this.getPrice();
    }

    getDiscountAsPercent() {
        let result = null;
        
        if (this.getDiscountedPrice()) {
            result = (1 - (this.getDiscountedPrice()/this.getPrice())) * 100;
            result = result.toFixed(2);
        }

        return result;
    }

    getCategory() {
        return this.category;
    }
}