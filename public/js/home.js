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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 43);
/******/ })
/************************************************************************/
/******/ ({

/***/ 43:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(44);


/***/ }),

/***/ 44:
/***/ (function(module, exports) {

var app = new Vue({
    el: '#home',
    data: {
        product: []
    },
    watch: {
        message: function message() {
            Echo.private('change').whisper('typing', {
                name: this.response
            });
        }
    },
    methods: {
        get: function get() {
            var _this = this;

            axios.get('get').then(function (response) {
                _this.product = response;
            }).catch(function (error) {
                console.log(error);
            });
        },
        getTime: function getTime() {
            var time = new Date();
            return time.getHours() + ':' + time.getMinutes();
        },
        changeState: function changeState(id) {
            var _this2 = this;

            axios.post('update', {
                id: id
            }).then(function (response) {
                _this2.get();
                var $toastContent = $('<span>Petición denegada</span>');
                // var $toastContent = $('<span>Petición denegada</span>').add($('<button class="btn-flat toast-action">Deshacer</button>'));
                Materialize.toast($toastContent, 10000);
            }).catch(function (error) {
                console.log(error);
            });
        },
        updatePrice: function updatePrice(product) {
            var _this3 = this;

            axios.post('updatePrice', {
                id: product.id,
                product_id: product.product_id,
                price_new: product.precio_sugerido
            }).then(function (response) {
                _this3.get();
                var $toastContent = $('<span>Petición aceptada</span>');
                Materialize.toast($toastContent, 10000);
            }).catch(function (error) {
                console.log(error);
            });
        },
        undoDenied: function undoDenied(id) {
            var _this4 = this;

            axios.post('undoDenied/' + id).then(function (response) {
                _this4.get();
                var $toastContent = $('<span>Deshacer exitoso.</span>');
                Materialize.toast($toastContent, 10000);
            }).catch(function (error) {
                console.log(error);
            });
        }
    },
    mounted: function mounted() {
        var _this5 = this;

        this.get();
        Echo.private('change').listen('ChangeEvent', function (e) {
            if (e.response == 'nueva') {
                Push.create("Nueva petición", {
                    body: "Tiene una nueva solicitud para cambio de precio.",
                    icon: 'img/xplod.png',
                    timeout: 4000,
                    onClick: function onClick() {
                        window.focus();
                        this.close();
                    }
                });
            } else if (e.response == 'denegada') {
                Push.create("Petición denegada", {
                    body: "La petición para cambio de precio fue denegada.",
                    icon: 'img/xplod.png',
                    timeout: 4000,
                    onClick: function onClick() {
                        window.focus();
                        this.close();
                    }
                });
            } else if (e.response == 'aceptada') {
                Push.create("Petición aceptada", {
                    body: "La petición para cambio de precio fue aceptada.",
                    icon: 'img/xplod.png',
                    timeout: 4000,
                    onClick: function onClick() {
                        window.focus();
                        this.close();
                    }
                });
            }
            var $toastContent = $('<span>Petición ' + e.response + '</span>');
            // var $toastContent = $('<span>'+e.response+'</span>');
            Materialize.toast($toastContent, 10000);
            _this5.get();
        });
    }
});

/***/ })

/******/ });