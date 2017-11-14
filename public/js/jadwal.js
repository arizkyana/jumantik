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
/******/ 	return __webpack_require__(__webpack_require__.s = 63);
/******/ })
/************************************************************************/
/******/ ({

/***/ 63:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(64);
module.exports = __webpack_require__(65);


/***/ }),

/***/ 64:
/***/ (function(module, exports) {

/**
 * Created by agungrizkyana on 11/9/17.
 */

var table = {};
var supervisor = {};
var pic = {};

$(document).ready(function () {

    table = {
        el: $("#table-jadwal"),
        evt: {},
        init: function init() {
            var self = this;

            self.el.dataTable();
        }
    };

    supervisor = {
        el: $("#supervisor"),
        evt: {
            change: function change(e) {
                e.preventDefault();

                var id = $(this).val();

                loadWilayah(id);

                return;
            }
        },
        init: function init() {
            var self = this;
            self.el.select2();

            if (self.el.val()) {
                var id = self.el.val();
                loadWilayah(id);
            }

            self.el.change(self.evt.change);
        }
    };

    pic = {
        el: $("#pic"),
        evt: {},
        init: function init() {
            var self = this;
            self.el.select2();
        }
    };

    table.init();
    supervisor.init();
    pic.init();
});

function loadWilayah(id) {
    $("#lokasi").empty();

    $.ajax({
        url: base_url + '/api/jadwal/wilayah/' + id,
        method: 'get'
    }).then(function (result) {
        $("#lokasi").append(' <strong>' + result.data.nama + '</strong><br>\n' + result.data.alamat + ' <br>\n' + result.data.nama_kelurahan + ' , ' + result.data.nama_kecamatan + '<br>\n' + ' <abbr title="Phone">P:</abbr> ' + result.data.phone);

        $("input[name=alamat]").val(result.data.alamat);
        $("input[name=kelurahan]").val(result.data.kelurahan_id);
        $("input[name=kecamatan]").val(result.data.kecamatan_id);
    });
}

window.remove = function (id) {
    event.preventDefault();

    swal({
        title: "Apakah Anda Yakin?",
        text: "Jadwal yang sudah di hapus tidak dapat di kembalikan!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: 'Batal',
        closeOnConfirm: false,
        html: false
    }, function () {
        document.getElementById('delete-' + id).submit();
        swal("Berhasil!", "Jadwal sudah dihapus.", "success");
    });
};

/***/ }),

/***/ 65:
/***/ (function(module, exports) {

/**
 * Created by agungrizkyana on 11/9/17.
 */

window.jadwal = function () {

    function initDatePicker() {
        var el = {
            tanggalMulai: $("#mulai"),
            tanggalAkhir: $("#akhir")
        };

        el.tanggalMulai.datepicker({
            orientation: 'top'
        });

        el.tanggalAkhir.datepicker({
            orientation: 'top'
        });

        return el;
    }

    function initClockPicker() {
        var el = {
            jamMulai: $("#jam_mulai"),
            jamAkhir: $("#jam_akhir")
        };

        el.jamMulai.clockpicker({
            placement: 'top',
            donetext: 'Done'
        });
        el.jamAkhir.clockpicker({
            placement: 'top',
            donetext: 'Done'
        });

        return el;
    }

    function init() {
        initClockPicker();
        initDatePicker();
    }

    return {
        init: init
    };
}();

$(document).ready(function () {
    window.jadwal.init();
});

/***/ })

/******/ });