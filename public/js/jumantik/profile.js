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
/******/ 	return __webpack_require__(__webpack_require__.s = 40);
/******/ })
/************************************************************************/
/******/ ({

/***/ 40:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(41);
module.exports = __webpack_require__(42);


/***/ }),

/***/ 41:
/***/ (function(module, exports) {

/**
 * Created by agungrizkyana on 10/21/17.
 */
var table = {};

$(document).ready(function () {

    table = {
        el: $("#table-laporan-jumantik"),
        evt: {},
        init: function init() {
            var self = this;

            self.el.dataTable();
        }
    };

    table.init();
});

/***/ }),

/***/ 42:
/***/ (function(module, exports) {

/**
 * Created by agungrizkyana on 10/21/17.
 */

var form = {};

$(document).ready(function () {

    form.inputSuspect = {
        el: $("#input_suspect_dbd"),
        evt: {},
        init: function init() {
            var self = this;

            self.el.hide();
        }

    };

    form.checkSuspect = {
        el: $("#is_suspect_dbd"),
        evt: {
            onChange: function onChange(e) {
                e.preventDefault();

                if ($(this).is(":checked")) {
                    form.inputSuspect.el.show();
                } else {
                    form.inputSuspect.el.hide();
                }
                return;
            }
        },
        init: function init() {
            var self = this;

            self.el.change(self.evt.onChange);
        }
    };

    form.penyakit = {
        el: $("#penyakit"),
        evt: {},
        init: function init() {
            var self = this;

            self.el.select2();
        }
    };

    form.kelurahan = {
        el: $("#kelurahan"),
        evt: {
            onChange: function onChange() {}
        },
        init: function init() {
            var self = this;

            self.el.select2();
        }

    };

    form.kecamatan = {
        el: $("#kecamatan"),
        evt: {
            onChange: function onChange(e) {
                e.preventDefault();
                var _kecamatan = $(this).val();
                $.ajax({
                    url: '/api/kelurahan/get_by_kecamatan/' + _kecamatan,
                    method: 'get',
                    headers: {
                        'Accept': 'application/json',
                        'Content-type': 'application/json'
                    }
                }).then(function (result) {
                    form.kelurahan.el.empty();
                    form.kelurahan.el.select2().val('');
                    $.each(result, function (i, kelurahan) {
                        var options = '<option value="' + kelurahan.kelurahan_id + '">' + kelurahan.nama_kelurahan + '</option>';
                        form.kelurahan.el.append(options);
                    });
                });

                return;
            }
        },
        init: function init() {
            var self = this;

            self.el.select2();
            self.el.change(self.evt.onChange);
        }
    };

    form.penyakit.init();
    form.kelurahan.init();
    form.kecamatan.init();

    form.checkSuspect.init();
    form.inputSuspect.init();
});

/***/ })

/******/ });