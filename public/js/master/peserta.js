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
/******/ 	return __webpack_require__(__webpack_require__.s = 184);
/******/ })
/************************************************************************/
/******/ ({

/***/ 184:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(185);
__webpack_require__(186);
module.exports = __webpack_require__(187);


/***/ }),

/***/ 185:
/***/ (function(module, exports) {

var table = {};
var _datatable = void 0;
$(document).ready(function () {
    table = {
        el: $("#table-users"),
        evt: {},
        redraw: function redraw() {
            _datatable.ajax.url(base_url + '/api/master/peserta').load();
            _datatable.draw();
        },
        init: function init() {
            var self = this;
            _datatable = self.el.DataTable({
                serverSide: true,
                processing: true,
                ajax: {
                    url: base_url + '/api/master/peserta',
                    method: 'post'
                },
                createdRow: function createdRow(row) {
                    $('td', row).eq(5).addClass('text-center');
                },
                order: [[0, 'desc']],
                columns: [{
                    data: 'created_at', name: 'peserta.created_at',
                    render: function render(data, type, row, meta) {
                        return moment(data, 'yyyy-mm-dd hh:mm:ss').format('D MMM Y');
                    }
                }, {
                    data: 'nrp', name: 'peserta.nrp',
                    render: function render(data, type, row, meta) {
                        return '<a class="text-danger" href="' + base_url + '/master/peserta/' + row.id + '/edit">' + data + '</a>';
                    }
                }, { data: 'nama', name: 'peserta.nama' }, { data: 'email', name: 'peserta.email' }, { data: 'telepon', name: 'peserta.telepon' }, {
                    data: 'id', name: 'peserta.id',
                    render: function render(data, type, row, meta) {
                        return '<button type="button" onclick="remove(' + row.id + ')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>';
                    }
                }]
            });
        }
    };

    table.init();
});

window.remove = function (id) {
    event.preventDefault();

    swal({
        title: "Apakah Anda Yakin?",
        text: "Peserta yang sudah di hapus tidak dapat di kembalikan!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: 'Batal',
        closeOnConfirm: false,
        html: false
    }, function () {

        window.axios.post(base_url + '/api/master/peserta/' + id + '/destroy', {
            id: id
        }).then(function () {
            swal("Berhasil!", "Peserta sudah dihapus.", "success");
            table.redraw();
        }).catch(window.logError);
    });
};

/***/ }),

/***/ 186:
/***/ (function(module, exports) {

throw new Error("Module build failed: Error: ENOENT: no such file or directory, open 'D:\\xampp\\htdocs\\edu\\resources\\assets\\js\\master\\peserta\\create.js'\n    at Error (native)");

/***/ }),

/***/ 187:
/***/ (function(module, exports) {

var form = {
    api: {
        scope: {}
    }
};

$(document).ready(function () {

    form.api.scope = {
        el: $("#client_scope"),
        evt: {
            onChange: function onChange(e) {
                e.preventDefault();
                return;
            }
        },
        init: function init() {
            var self = this;
            self.el.select2({
                placeholder: 'Pilih Scope'
            });
        }
    };
});

/***/ })

/******/ });