class AlmaHome {
    CzechPrice(number, decimals = 0) {
        return number.toFixed(decimals).toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ")
    }
}

const alma = new AlmaHome;