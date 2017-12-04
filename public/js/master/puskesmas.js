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
/******/ 	return __webpack_require__(__webpack_require__.s = 202);
/******/ })
/************************************************************************/
/******/ ({

/***/ 202:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(203);
module.exports = __webpack_require__(204);


/***/ }),

/***/ 203:
/***/ (function(module, exports) {

var _dataTable;
var table, kecamatan;
window.dinkes = function () {

    function init() {
        initTable();
    }

    function initTable() {
        table = {
            el: $("#table-dinkes"),
            evt: {},
            init: function init() {
                var self = this;

                self.el.DataTable();
            }
        };

        table.init();
    }

    return {
        init: init
    };
}();

$(document).ready(function () {
    window.dinkes.init();
});

window.remove = function (id) {
    event.preventDefault();

    swal({
        title: "Apakah Anda Yakin?",
        text: "Puskesmas yang sudah di hapus tidak dapat di kembalikan!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: 'Batal',
        closeOnConfirm: false,
        html: false
    }, function () {
        document.getElementById('delete-' + id).submit();
        swal("Berhasil!", "Puskesmas sudah dihapus.", "success");
    });
};

/***/ }),

/***/ 204:
/***/ (function(module, exports) {

var kecamatan, kelurahan, role;
(function () {

    kelurahan = {
        el: $('#kelurahan'),
        evt: {},
        init: function init() {
            var self = this;

            $(self.el).select2();
        }

    };

    kecamatan = {
        el: $('#kecamatan'),
        evt: {
            change: function change() {
                var idKecamatan = $(this).val();
                $.ajax({
                    url: base_url + '/api/kelurahan/get_by_kecamatan/' + idKecamatan,
                    method: 'get'
                }).then(function (result) {
                    kelurahan.el.select2().val(null).trigger('change');
                    kelurahan.el.empty();
                    $.each(result.data, function (i, item) {

                        var options = "<option value='" + item.kelurahan_id + "'>" + item.nama_kelurahan + "</option>";
                        kelurahan.el.append(options);
                    });
                }, logError);
            }
        },
        init: function init() {
            var self = this;
            self.el.select2();
            self.el.change(self.evt.change);
        }
    };

    role = {
        el: $("#role"),
        evt: {},
        init: function init() {
            var self = this;
            self.el.select2();
        }
    };

    kelurahan.init();
    kecamatan.init();
    role.init();
})();

/***/ })

/******/ });