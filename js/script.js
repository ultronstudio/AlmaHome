class AlmaHome {
    CzechPrice(number, decimals = 0) {
        return number.toFixed(decimals).toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ")
    };

    Zprava(text) {
        console.log(`%c[ALMA]`, "color: green;", text);
    };
}

const alma = new AlmaHome;