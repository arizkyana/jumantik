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
/******/ 	return __webpack_require__(__webpack_require__.s = 23);
/******/ })
/************************************************************************/
/******/ ({

/***/ 23:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(24);


/***/ }),

/***/ 24:
/***/ (function(module, exports) {

// load map

function loadmap() {
    var latitude = Number(-6.2383);
    var longitude = Number(106.9756);

    var map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: latitude, lng: longitude },
        zoom: 14
    });
}

$(document).ready(function () {
    loadmap();

    var formData = new FormData();

    formData.append("pelapor", "nurdin");

    $.ajax({
        url: '/api/penyakit/laporan/create',
        method: 'POST',
        headers: {
            'Accept': 'application/json',
            'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjJhNzM5NmFiNjAxMmEyOWFjN2JjZjQ3ZThiOThmMDU4Njg3NmMwM2NkZTA5OGIwMmI5ZjY5NjllYWVhNjU3NGFkNTBjMjMwNjQwYTVjZGJlIn0.eyJhdWQiOiIyIiwianRpIjoiMmE3Mzk2YWI2MDEyYTI5YWM3YmNmNDdlOGI5OGYwNTg2ODc2YzAzY2RlMDk4YjAyYjlmNjk2OWVhZWE2NTc0YWQ1MGMyMzA2NDBhNWNkYmUiLCJpYXQiOjE1MDg5Nzg1NzUsIm5iZiI6MTUwODk3ODU3NSwiZXhwIjoxNTQwNTE0NTc1LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.e-T7mwGfeYNDB1kINjlVQ8nOYkALGULbte-JY4o4k7yJk9u_0UyGBG9YPGcvBT8HY5IBRRgvvjS6YE7Xe3bxhZcpFDEZ_bq2lWFMleAZ20Opp0Q9irN00r8A_gYpKyBMbrXSpc3WlWboHZdswiMUGphx523L8UB6epjNTSDe4DHfHaWBJo5hER0jf4me57ZShStFm87dODpw3V-McpTb_0QwQnE4Gsw96OGji_3T3_5U1lALNQOcUttNTvVT6-a_2SMUxR40ZavfZ-Gduc_8thc5SkwjkFpF4-JKXrfLLZx_8TnFpCv1znDay-mPB34z3BxeATUWPI8AcpvwdpDks3mFDSB_M7jy7ivDYxEZWER-snoLXWmMHXIbxBx0jYE2OiaqFM0z-DdYCZV4M017VFx1736R00a34ckn0DkUlrBpCRoToGBnLcDw7bcw9RbrkGv2QvWdXbjLOT_gry2vD3XAGVcigIerWKLdtO8E4VlDNnqXp5bAxXY6c1vY6Y6O3x3uayZwAUF6j1DH54UQkOK4FwGlsl_bduLqajF223O5Zgj0l6m_CHOwVOWgi0UPPZqhrrt-jwbqUxt5-5tLGMmwHhCiIJJ8nyutkBEleZjp7_dx7qbV8s7HOs864JNPBAVYG7onIORV2d971w5eBnQmhKEiSBoRRjzYAydIdIA'
        },
        data: "pelapor=jono"
    }).then(function (result) {
        console.log(result);
    });
});

/***/ })

/******/ });