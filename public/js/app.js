/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/css/app.scss":
/*!********************************!*\
  !*** ./resources/css/app.scss ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _cart__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./cart */ "./resources/js/cart.js");

window.initAddToCart = _cart__WEBPACK_IMPORTED_MODULE_0__["initAddToCart"];
window.initCartDeleteButton = _cart__WEBPACK_IMPORTED_MODULE_0__["initCartDeleteButton"];

/***/ }),

/***/ "./resources/js/cart.js":
/*!******************************!*\
  !*** ./resources/js/cart.js ***!
  \******************************/
/*! exports provided: initAddToCart, initCartDeleteButton */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initAddToCart", function() { return initAddToCart; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "initCartDeleteButton", function() { return initCartDeleteButton; });
function initCart() {
  return getCart();
}

function getCart() {
  console.log(document.cookie);
  var cart = Cookies.get('cart');
  return !cart ? {} : JSON.parse(cart);
}

function saveCart(cart) {
  Cookies.set('cart', JSON.stringify(cart));
}

function addProductToCart(productId, quantity) {
  var cart = getCart();
  var currentQuantity = parseInt(cart[productId]) || 0;
  var addQuantity = parseInt(quantity) || 0;
  var newQuantity = currentQuantity + addQuantity;
  updateProductToCart(productId, newQuantity);
}

function updateProductToCart(productId, newQuantity) {
  var cart = getCart();
  cart[productId] = newQuantity;
  saveCart(cart);
}

function alertProductQuantity(productId) {
  var cart = getCart();
  var quantity = parseInt(cart[productId]) || 0;
  alert(quantity);
}

function initAddToCart(productId) {
  var addToCartBtn = document.querySelector('#addToCart');

  if (addToCartBtn) {
    addToCartBtn.addEventListener('click', function () {
      var quantityInput = document.querySelector('input[name="quantity"]');

      if (quantityInput) {
        addProductToCart(productId, quantityInput.value);
        alertProductQuantity(productId);
      }
    });
  }
}

function initCartDeleteButton(actionUrl) {
  var cartDeleteBtns = document.querySelectorAll('.cartDeleteBtn');

  for (var index = 0; index < cartDeleteBtns.length; index++) {
    var cartDeleteBtn = cartDeleteBtns[index];
    cartDeleteBtn.addEventListener('click', function (e) {
      var btn = e.target;
      var dataId = btn.getAttribute('data-id');
      var formData = new FormData();
      formData.append("_method", 'DELETE');
      var csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
      var csrfToken = csrfTokenMeta.content;
      formData.append("_token", csrfToken);
      formData.append("id", dataId);
      var request = new XMLHttpRequest();
      request.open("POST", actionUrl);

      request.onreadystatechange = function () {
        if (request.readyState === XMLHttpRequest.DONE && request.status === 200 && request.responseText === "success") {
          window.location.reload();
        }
      };

      request.send(formData);
    });
  }
}



/***/ }),

/***/ 0:
/*!************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/css/app.scss ***!
  \************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! C:\Users\cty22\Desktop\Coureses\Laravel\projects\04. controller_and_view\pb_controller\resources\js\app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! C:\Users\cty22\Desktop\Coureses\Laravel\projects\04. controller_and_view\pb_controller\resources\css\app.scss */"./resources/css/app.scss");


/***/ })

/******/ });