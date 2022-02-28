function initCart(){
    return getCart()
}

function getCart() {
    console.log(document.cookie)

    var cart = Cookies.get('cart')
    return (!cart) ? {} : JSON.parse(cart)
}

function saveCart(cart) {
    Cookies.set('cart', JSON.stringify(cart))
}

function addProductToCart(productId, quantity){
    var cart = getCart()
    var currentQuantity = parseInt(cart[productId]) || 0
    var addQuantity = parseInt(quantity) || 0
    var newQuantity = currentQuantity + addQuantity
    updateProductToCart(productId, newQuantity)
}

function updateProductToCart(productId, newQuantity){
    var cart = getCart()
    cart[productId] = newQuantity
    saveCart(cart)
}

function alertProductQuantity(productId) {
    var cart = getCart()
    var quantity = parseInt(cart[productId]) || 0
    alert(quantity)
}

function initAddToCart (productId) {
    var addToCartBtn = document.querySelector('#addToCart');

    if (addToCartBtn) {
        addToCartBtn.addEventListener('click', function(){ 
            var quantityInput = document.querySelector('input[name="quantity"]');
            if (quantityInput) {
                addProductToCart(productId, quantityInput.value)
                alertProductQuantity (productId)
            }
        })
    }
}

function initCartDeleteButton(actionUrl){
    var cartDeleteBtns = document.querySelectorAll('.cartDeleteBtn');
    for(var index = 0; index < cartDeleteBtns.length ; index ++){
        var cartDeleteBtn = cartDeleteBtns[index]
        cartDeleteBtn.addEventListener('click', function(e){
            var btn = e.target
            var dataId = btn.getAttribute('data-id');
            var formData = new FormData();
            formData.append("_method", 'DELETE');
            var csrfTokenMeta = document.querySelector('meta[name="csrf-token"]')
            var csrfToken = csrfTokenMeta.content
            formData.append("_token", csrfToken);
            formData.append("id", dataId);
            var request = new XMLHttpRequest();
            request.open("POST", actionUrl);
            request.onreadystatechange = function () {
                if(request.readyState === XMLHttpRequest.DONE 
                    && request.status === 200
                    && request.responseText === "success"
                    ) {
                    window.location.reload()
                }
            };
            request.send(formData);
        });
    }
}

export {initAddToCart, initCartDeleteButton}