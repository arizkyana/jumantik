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
/******/ 	return __webpack_require__(__webpack_require__.s = 38);
/******/ })
/************************************************************************/
/******/ ({

/***/ 38:
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(39);
module.exports = __webpack_require__(40);


/***/ }),

/***/ 39:
/***/ (function(module, exports) {

/**
 * Created by agungrizkyana on 10/21/17.
 */
var table = {};
var filter = {};
var _dataTable = {};
(function () {

    table = {
        el: $("#table-laporan-jumantik"),
        evt: {},
        init: function init() {
            var self = this;

            _dataTable = self.el.DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: base_url + '/api/penyakit/laporan/ajax_laporan',
                    method: 'post'
                },
                createdRow: function createdRow(row, data) {
                    var text = "";
                    var bg = "";
                    switch (data.status) {
                        case 1:
                            text = 'Open';
                            bg = 'bg-primary';
                            break;
                        case 2:
                            text = 'Finish';
                            bg = 'bg-success';
                            break;
                        case 3:
                            text = 'On Going';
                            bg = 'bg-warning';
                            break;
                    }

                    $('td', row).eq(6).html(text).addClass(bg);
                },
                columns: [{
                    data: 'created_at',
                    render: function render(data, type, row, meta) {
                        var html = '<a class="text-danger" href="' + base_url + '/penyakit/laporan/' + row.id + '/show">' + data + '</a>';
                        return html;
                    }
                }, { data: 'pelapor' }, { data: 'tipe_pelapor' }, { data: 'nama_penyakit' }, { data: 'nama_tindakan' }, {
                    data: 'alamat',
                    render: function render(data, type, row, meta) {
                        var html = data + '<br /><small>' + row.nama_kelurahan + ", " + row.nama_kecamatan + '</small>';
                        return html;
                    }
                }, {
                    searchable: false,
                    data: 'status'
                }, {
                    data: 'id',
                    render: function render(data, type, row, meta) {

                        var html = '<a onclick="deleteLaporan(' + data + ')" class="btn btn-danger btn-sm"  tooltip="Hapus Laporan"><i class="fa fa-trash"></i></a>';
                        return html;
                    }
                }]
            });
        },
        redraw: function redraw(query) {
            var url = base_url + '/api/penyakit/laporan/ajax_laporan' + query;
            _dataTable.ajax.url(url).load();
            _dataTable.draw(true);
        }
    };

    filter.tipePelapor = {
        el: $('#tipe_pelapor'),
        evt: {
            change: function change(e) {
                e.preventDefault();
                table.redraw("?" + $("#form-filter").serialize());
            }
        },
        init: function init() {
            var self = this;

            self.el.select2();

            self.el.change(self.evt.change);
        }
    };
    filter.penyakit = {
        el: $("#penyakit"),
        evt: {
            change: function change(e) {
                e.preventDefault();

                table.redraw("?" + $("#form-filter").serialize());
            }
        },
        init: function init() {
            var self = this;
            self.el.change(self.evt.change);
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

    filter.tanggalMulai.init();
    filter.tanggalAkhir.init();
    filter.tipePelapor.init();
    filter.penyakit.init();
    table.init();
})();

window.deleteLaporan = function (id) {

    var confirms = confirm('Apakah anda yakin?');
    if (confirms) {
        $.ajax({
            url: base_url + '/api/penyakit/laporan/delete/' + id,
            method: 'get'

        }).then(function (result) {
            console.log(result);
            table.redraw("");
        }, logError);
    }
};

window.refresh = function () {
    table.redraw("");
};

/***/ }),

/***/ 40:
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