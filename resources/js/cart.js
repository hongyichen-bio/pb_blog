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

function initCartDeleteButton(actionUrl){
    let cartDeleteBtn = document.querySelectorAll('.cartDeleteBtn');
    let csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    cartDeleteBtn.forEach(element => {
        element.addEventListener('click', function(){
            let id = this.getAttribute('data-id');
            var formData = new FormData();
            formData.append('id', id);
            formData.append('_method', 'DELETE');
            formData.append('_token', csrfToken);
            let request = new XMLHttpRequest();
            request.open('POST', actionUrl);
            request.onreadystatechange = function(){
                if(request.readyState === XMLHttpRequest.DONE
                    && request.status === 200
                    && request.responseText === 'success') {
                        window.location.reload();
                    }
                
            }

            request.send(formData);
        })
    });
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

export {initAddToCart, initCartDeleteButton}