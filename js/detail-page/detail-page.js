const plus = document.querySelector('.plus')
const minus = document.querySelector('.minus')
const cartCount = document.querySelector('.cart-count')

plus.onclick = (e) => {
    cartCount.value = parseInt(cartCount.value) + 1;
}


minus.onclick = (e) => {
    if (cartCount.value === '0') { } else {
        cartCount.value = parseInt(cartCount.value) - 1;
    }
}