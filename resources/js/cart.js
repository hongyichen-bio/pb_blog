function initCart(){
    return Cookies.get('cart');
}

function getCart(){
    let cart = Cookies.get('cart');
    return cart ? JSON.parse(cart) : {}
}

function addProductToCart(productId, quantity){
    let cart = getCart();
    var currentQuantity = parseInt(cart[productId]) || 0
    var addQuantity = parseInt(quantity) || 0
    var newQuantity = currentQuantity + addQuantity

    updateProductToCart(productId, newQuantity);

}

function updateProductToCart(productId, newQuantity){
    let cart = getCart();
    cart[productId] = newQuantity;
    saveCart(cart);
}

function saveCart(cart){
    Cookies.set('cart', JSON.stringify(cart));
}

function alertProductToCart(productId){
    let cart = getCart();
    let quantity = parseInt(cart[productId]);
    alert(quantity);
}

function initAddToCart () {
    var addToCartBtn = document.querySelector('#addToCart');

    if (addToCartBtn) {
        addToCartBtn.addEventListener('click', function(){ 
            var quantityInput = document.querySelector('input[name="quantity"]');
            if (quantityInput) {
                addProductToCart(productId , quantityInput.value)
                alertProductToCart(productId)
            }
        })
    }
}

export {initAddToCart}