// load map


var dashboard = (function () {

    function laporanIcon(status) {
        let icon = '/marker/emergency_pinpoint.png';
        switch (status) {
            case 1:
                icon = '/marker/emergency_pinpoint.png';
                break;
        }

        return icon;
    }

    function loadLaporan(map) {
        $.ajax({
            url: '/api/penyakit/laporan',
            method: 'get'
        }).then(function (result) {
            $.each(result, function (i, laporan) {
                const latLng = new google.maps.LatLng(laporan.lat, laporan.lon);
                let marker = new google.maps.Marker({
                    position: latLng,
                    title: laporan.keterangan,
                    icon: laporanIcon(laporan.status),
                    animation: google.maps.Animation.DROP
                });

                marker.setMap(map);
            });
        })
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


            loadLaporan(map);


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