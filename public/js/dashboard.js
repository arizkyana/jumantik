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
/******/ 	return __webpack_require__(__webpack_require__.s = 13);
/******/ })
/************************************************************************/
/******/ ({

/***/ 13:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(14);


/***/ }),

/***/ 14:
/***/ (function(module, exports) {

// load map


var dashboard = function () {

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

    function laporanIcon(status) {
        var icon = '/marker/emergency_pinpoint.png';
        switch (status) {
            case 1:
                icon = '/marker/emergency_pinpoint.png';
                break;
            case 2:
                icon = '/marker/solved.png';
                break;
            case 3:
                icon = '/marker/rescue.png';
                break;
        }

        return {
            url: icon,
            scaledSize: new google.maps.Size(50, 50)
        };
    }

    function loadLaporan(map) {

        var promise = new Promise(function (resolve, reject) {
            $.ajax({
                url: '/api/penyakit/laporan',
                method: 'get'
            }).then(function (result) {
                $.each(result, function (i, laporan) {
                    var latLng = new google.maps.LatLng(laporan.lat, laporan.lon);
                    var _laporan = new google.maps.Marker({
                        position: latLng,
                        title: laporan.keterangan,
                        icon: laporanIcon(laporan.status),
                        animation: google.maps.Animation.DROP,
                        map: map
                    });

                    openWindow(_laporan, laporan.keterangan, map);
                });

                resolve(map);
            }, function (err) {
                reject(err);
            });
        });

        return promise;
    }

    function loadApartement(map) {
        var promise = new Promise(function (resolve, reject) {
            $.ajax({
                url: '/api/master/apartment',
                method: 'get'
            }).then(function (result) {

                $.each(result, function (i, apartment) {
                    var latLng = new google.maps.LatLng(apartment.latitude, apartment.longitude);
                    var _apartment = new google.maps.Marker({
                        position: latLng,
                        title: apartment.nama,
                        icon: {
                            url: base_url + '/marker/apartment.png',
                            scaledSize: new google.maps.Size(32, 32)
                        },
                        animation: google.maps.Animation.DROP,
                        map: map
                    });

                    openWindow(_apartment, apartment.nama, map);
                });

                resolve(map);
            }, function (err) {
                reject(err);
            });
        });

        return promise;
    }

    function loadFaskes(map) {
        var promise = new Promise(function (resolve, reject) {
            $.ajax({
                url: '/api/master/faskes',
                method: 'get'
            }).then(function (result) {

                $.each(result, function (i, faskes) {
                    var latLng = new google.maps.LatLng(faskes.latitude, faskes.longitude);
                    var _faskes = new google.maps.Marker({
                        position: latLng,
                        title: faskes.nama,
                        icon: {
                            url: base_url + '/marker/faskes.png',
                            scaledSize: new google.maps.Size(32, 32)
                        },
                        animation: google.maps.Animation.DROP,
                        map: map
                    });

                    openWindow(_faskes, faskes.nama, map);
                });

                resolve(map);
            }, function (err) {
                reject(err);
            });
        });

        return promise;
    }

    function loadPerkimtan(map) {
        var promise = new Promise(function (resolve, reject) {
            $.ajax({
                url: '/api/master/perkimtan',
                method: 'get'
            }).then(function (result) {

                $.each(result, function (i, perkimtan) {
                    var latLng = new google.maps.LatLng(perkimtan.latitude, perkimtan.longitude);
                    var _perkimtan = new google.maps.Marker({
                        position: latLng,
                        title: perkimtan.nama,
                        icon: {
                            url: base_url + '/marker/perkimtan.png',
                            scaledSize: new google.maps.Size(32, 32)
                        },
                        animation: google.maps.Animation.DROP,
                        map: map
                    });

                    openWindow(_perkimtan, perkimtan.nama, map);
                });

                resolve(map);
            }, function (err) {
                reject(err);
            });
        });

        return promise;
    }

    function loadSekolah(map) {
        var promise = new Promise(function (resolve, reject) {
            $.ajax({
                url: '/api/master/sekolah',
                method: 'get'
            }).then(function (result) {

                $.each(result, function (i, sekolah) {
                    var latLng = new google.maps.LatLng(sekolah.latitude, sekolah.longitude);
                    var _sekolah = new google.maps.Marker({
                        position: latLng,
                        title: sekolah.nama,
                        icon: {
                            url: base_url + '/marker/sekolah.png',
                            scaledSize: new google.maps.Size(32, 32)
                        },
                        animation: google.maps.Animation.DROP,
                        map: map
                    });

                    openWindow(_sekolah, sekolah.nama, map);
                });

                resolve(map);
            }, function (err) {
                reject(err);
            });
        });

        return promise;
    }

    function loadmap() {
        var latitude = Number(-6.2383);
        var longitude = Number(106.9756);

        var map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: latitude, lng: longitude },
            zoom: 12
        });

        $.ajax({
            url: '/api/kecamatan/area',
            method: 'get'
        }).then(function (result) {

            var coords = [];
            var rgb = "255,255,0";
            $.each(result, function (i, area) {
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

            if (typeof Promise === 'undefined') {
                alert('Browser tidak support untuk menampilkan informasi pada peta');
                return;
            }

            // loadLaporan(map)
            //     .then(loadApartement)
            //     .then(loadFaskes)
            //     .then(loadPerkimtan)
            //     .then(loadSekolah)
            //     .catch(logError)

        });
    }

    function init() {
        loadmap();

        // switchery


        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

        elems.forEach(function (html) {
            var switchery = new Switchery(html);
        });
    }

    return {
        init: init
    };
}();

$(document).ready(function () {
    dashboard.init();
});

/***/ })

/******/ });