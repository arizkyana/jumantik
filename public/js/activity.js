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
/******/ 	return __webpack_require__(__webpack_require__.s = 223);
/******/ })
/************************************************************************/
/******/ ({

/***/ 223:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(224);


/***/ }),

/***/ 224:
/***/ (function(module, exports) {

/**
 * Created by agungrizkyana on 11/9/17.
 */

var table = {};
var supervisor = {};
var pic = {};
var filter = {
    tanggalMulai: {},
    tanggalAkhir: {}
};

var btn = {
    refresh: {}
};

var _datatable;

$(document).ready(function () {

    table = {
        el: $("#table-jadwal"),
        evt: {},
        init: function init() {
            var self = this;

            _dataTable = self.el.DataTable({
                processing: true,
                serverSide: true,
                saveState: true,
                ajax: {
                    url: base_url + '/api/activity/ajax_log',
                    method: 'post'
                },
                order: [[0, 'desc']],

                columns: [{
                    data: 'created_at',
                    name: 'activity.created_at',
                    searchable: false,
                    render: function render(data, type, row, meta) {
                        return moment(data).format('DD-MM-YYYY hh:mm:ss');
                    }
                }, {
                    data: 'ip',
                    name: 'activity.ip'
                }, {
                    data: 'email',
                    name: 'users.email',
                    render: function render(data, type, row, meta) {
                        return row.email;
                    }

                }, {
                    data: 'role',
                    name: 'role.name'

                }, {
                    data: 'message',
                    name: 'activity.message'
                }]
            });
        },
        redraw: function redraw(query) {
            var url = base_url + '/api/activity/ajax_log' + query;
            _dataTable.ajax.url(url).load();
            _dataTable.draw(true);
        }
    };

    filter.tanggalMulai = {
        el: $('#tanggal_mulai'),
        evt: {},
        init: function init() {
            var self = this;

            self.el.datepicker({
                autoclose: true,
                orientation: 'bottom'
            });
        }
    };
    filter.tanggalAkhir = {
        el: $('#tanggal_akhir'),
        evt: {
            change: function change(e) {
                e.preventDefault();
                table.redraw("?" + $("#form-filter").serialize());
            }
        },
        init: function init() {
            var self = this;

            self.el.datepicker({
                autoclose: true,
                orientation: 'bottom'
            });

            self.el.change(self.evt.change);
        }
    };

    btn.refresh = {
        el: $("#refresh"),
        evt: {
            click: function click() {

                table.redraw("?" + $("#form-filter").serialize());
            }
        },
        init: function init() {
            var self = this;
            self.el.click(self.evt.click);
        }
    };

    filter.tanggalMulai.init();
    filter.tanggalAkhir.init();
    btn.refresh.init();
    table.init();
});

/***/ })

/******/ });