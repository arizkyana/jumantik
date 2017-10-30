// load map


var dashboard = (function () {

    function openWindow(object, contentString, map){

        let infowindow = new google.maps.InfoWindow({
            content: contentString
        });

        new google.maps.event.addListener(object, 'click', function (event) {
            infowindow.setContent(contentString);
            infowindow.setPosition(event.latLng);
            infowindow.open(map);
        });
    }

    function laporanIcon(status) {
        let icon = '/marker/emergency_pinpoint.png';
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

        let promise = new Promise(function (resolve, reject) {
            $.ajax({
                url: '/api/penyakit/laporan',
                method: 'get'
            }).then(function (result) {
                $.each(result, function (i, laporan) {
                    const latLng = new google.maps.LatLng(laporan.lat, laporan.lon);
                    const _laporan = new google.maps.Marker({
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
            })
        });

        return promise;

    }

    function loadApartement(map) {
        let promise = new Promise(function (resolve, reject) {
            $.ajax({
                url: '/api/master/apartment',
                method: 'get'
            }).then(function (result) {

                $.each(result, function (i, apartment) {
                    const latLng = new google.maps.LatLng(apartment.latitude, apartment.longitude);
                    const _apartment = new google.maps.Marker({
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
            })
        });

        return promise;
    }

    function loadFaskes(map) {
        let promise = new Promise(function (resolve, reject) {
            $.ajax({
                url: '/api/master/faskes',
                method: 'get'
            }).then(function (result) {

                $.each(result, function (i, faskes) {
                    const latLng = new google.maps.LatLng(faskes.latitude, faskes.longitude);
                    const _faskes = new google.maps.Marker({
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
            })
        });

        return promise;
    }

    function loadPerkimtan(map) {
        let promise = new Promise(function (resolve, reject) {
            $.ajax({
                url: '/api/master/perkimtan',
                method: 'get'
            }).then(function (result) {

                $.each(result, function (i, perkimtan) {
                    const latLng = new google.maps.LatLng(perkimtan.latitude, perkimtan.longitude);
                    const _perkimtan = new google.maps.Marker({
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
            })
        });

        return promise;
    }

    function loadSekolah(map) {
        let promise = new Promise(function (resolve, reject) {
            $.ajax({
                url: '/api/master/sekolah',
                method: 'get'
            }).then(function (result) {

                $.each(result, function (i, sekolah) {
                    const latLng = new google.maps.LatLng(sekolah.latitude, sekolah.longitude);
                    const _sekolah = new google.maps.Marker({
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
            })
        });

        return promise;
    }

    function loadmap() {
        const latitude = Number(-6.2383);
        const longitude = Number(106.9756);

        let map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: latitude, lng: longitude},
            zoom: 12
        });

        $.ajax({
            url: '/api/kecamatan/area',
            method: 'get'
        }).then(function (result) {

            let coords = [];
            let rgb = "255,255,0";
            $.each(result, function (i, area) {
                coords = $.map(area.area, function (o) {
                    rgb = o.rgb;
                    return {
                        lat: Number(o.latitude),
                        lng: Number(o.longitude)
                    }
                });

                const polygon = new google.maps.Polygon({
                    paths: coords,
                    strokeColor: '#FF0000',
                    strokeOpacity: 0.8,
                    strokeWeight: 3,
                    fillColor: 'rgb(' + rgb + ')',
                    fillOpacity: 0.35
                });

                polygon.setMap(map);

                let contentString = area.kecamatan;
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

            loadLaporan(map)
                .then(loadApartement)
                .then(loadFaskes)
                .then(loadPerkimtan)
                .then(loadSekolah)
                .catch(logError)


        });


    }

    function init() {
        loadmap();


    }

    return {
        init: (init)
    }
})();

$(document).ready(function () {
    dashboard.init();
});