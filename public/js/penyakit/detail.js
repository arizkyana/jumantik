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
/******/ 	return __webpack_require__(__webpack_require__.s = 155);
/******/ })
/************************************************************************/
/******/ ({

/***/ 155:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(156);


/***/ }),

/***/ 156:
/***/ (function(module, exports) {

var tableDetail = {};
// load map

var map;
var markers = {
    apartment: [],
    faskes: [],
    perkimtan: [],
    sekolah: [],
    perumahan: []
};

window.detail = function () {

    function openWindow(object, contentString, map) {

        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });

        new google.maps.event.addListener(object, 'click', function (event) {
            infowindow.setContent(contentString);
            infowindow.setPosition(event.latLng);
            infowindow.open(map);
        });
    }

    function loadmap() {

        var promise = new Promise(function (resolve, reject) {
            $.ajax({
                url: '/api/kecamatan/area',
                method: 'get'
            }).then(function (result) {

                var coords = [];
                var rgb = "255,255,0";
                $.each(result.data, function (i, area) {
                    coords = $.map(area.area, function (o) {
                        rgb = o.rgb;
                        return {
                            lat: Number(o.latitude),
                            lng: Number(o.longitude)
                        };
                    });

                    var polygon = new google.maps.Polygon({
                        paths: coords,
                        strokeColor: '#FF0000',
                        strokeOpacity: 0.8,
                        strokeWeight: 3,
                        fillColor: 'rgb(' + rgb + ')',
                        fillOpacity: 0.35
                    });

                    polygon.setMap(map);

                    var contentString = area.kecamatan;
                    infowindow = new google.maps.InfoWindow({
                        content: contentString
                    });

                    new google.maps.event.addListener(polygon, 'click', function (event) {
                        infowindow.setContent(contentString);
                        infowindow.setPosition(event.latLng);
                        infowindow.open(map);
                    });
                });

                resolve({
                    map: map,
                    lat: $("#lat").val(),
                    lon: $("#lon").val()
                });
            }, function (err) {
                reject(err);
            });
        });

        return promise;
    }

    function addMarker(map) {

        var latLng = new google.maps.LatLng(Number(map.lat), Number(map.lon));

        new google.maps.Marker({
            position: latLng,
            icon: {
                url: base_url + '/marker/emergency_pinpoint.png',
                scaledSize: new google.maps.Size(32, 32)
            },
            animation: google.maps.Animation.DROP,
            map: map.map
        });
    }

    function init() {
        var latitude = Number(-6.2383);
        var longitude = Number(106.9756);

        map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: latitude, lng: longitude },
            zoom: 12
        });

        loadmap(map).then(addMarker).catch(logError);
    }

    return {
        init: init
    };
}();

window.openFoto = function (e) {
    $("#modal_foto").data('foto', $(e).data('foto'));
    $("#modal_foto").modal();
};

$(document).ready(function () {
    window.detail.init();

    $("#modal_foto").on('show.bs.modal', function (e) {
        var foto = $(this).data('foto');
        var imgFoto = $("#foto");

        imgFoto.attr('src', base_url + '/media' + foto);
    });

    tableDetail = {
        el: $("#table-detail-laporan"),
        evt: {},
        init: function init() {
            var self = this;

            self.el.DataTable();
        }
    };

    tableDetail.init();
});

window.remove = function (id) {
    event.preventDefault();

    swal({
        title: "Apakah Anda Yakin?",
        text: "Laporan yang sudah di hapus tidak dapat di kembalikan!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: 'Batal',
        closeOnConfirm: false,
        html: false
    }, function () {
        document.getElementById('delete-' + id).submit();
        swal("Berhasil!", "Laporan sudah dihapus.", "success");
    });
};

/***/ })

/******/ });