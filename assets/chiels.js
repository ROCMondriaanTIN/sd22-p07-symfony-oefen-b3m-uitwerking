// Code for changing the pizza price in the order form
const selEl = document.querySelector('.pizza-select');

if (selEl) {
    const priceEl = document.querySelector('.pizza-price');
    const normalPrice = document.querySelector('.pizza-normal-price');
    const addPrices = {large: 4, medium: 2, regular: 0, small: -1 };

    selEl.addEventListener('change', function() {
        priceEl.innerText = parseFloat(parseFloat(normalPrice.innerText) + addPrices[selEl.value]).toFixed(2);
    });
}
