// load map

var map;
var markers = {
    apartment: [],
    faskes: [],
    perkimtan: [],
    sekolah: [],
    perumahan: []
};
var cluster;

window.dashboard = (function () {

    function openWindow(object, laporan, map) {

        let infowindow = new google.maps.InfoWindow({
            content: laporan.title + ' ' + laporan.keterangan
        });

        new google.maps.event.addListener(object, 'click', function (event) {
            infowindow.setContent(laporan.title + ' ' + laporan.keterangan);
            infowindow.setPosition(event.latLng);
            infowindow.open(map);
            setTimeout(function () {
                window.location.href = base_url + '/penyakit/laporan/' + laporan.id + '/show';
            }, 1200);
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

                    openWindow(_laporan, laporan, map);

                });

                resolve(map);
            }, function (err) {
                reject(err);
            })
        });

        return promise;

    }

    function loadApartement(map, isShow) {

        if (!isShow) {
            // clear marker
            clearMarker(markers.apartment);
            markers.apartment = [];
        } else {
            $.ajax({
                url: '/api/master/apartment',
                method: 'get'
            }).then(function (result) {

                $.each(result.data, function (i, apartment) {
                    const latLng = new google.maps.LatLng(Number(apartment.latitude), Number(apartment.longitude));
                    const _apartment = new google.maps.Marker({
                        position: latLng,
                        title: apartment.nama,
                        icon: {
                            url: base_url + '/marker/apartment.png',
                            scaledSize: new google.maps.Size(32, 32)
                        },
                        animation: google.maps.Animation.DROP,
                    });

                    markers.apartment.push(_apartment);
                    openWindow(_apartment, apartment.nama, map);
                });

                // show marker
                addMarker(markers.apartment);


            }, logError)
        }


    }

    function loadPerumahan(map, isShow) {

        if (!isShow) {
            // clear marker
            clearMarker(markers.perumahan);
            markers.perumahan = [];
        } else {
            $.ajax({
                url: '/api/master/perumahan',
                method: 'get'
            }).then(function (result) {

                $.each(result.data, function (i, perumahan) {
                    const latLng = new google.maps.LatLng(Number(perumahan.latitude), Number(perumahan.longitude));
                    const _perumahan = new google.maps.Marker({
                        position: latLng,
                        title: perumahan.nama,
                        icon: {
                            url: base_url + '/marker/perumahan_belum_jadi.png',
                            scaledSize: new google.maps.Size(32, 32)
                        },
                        animation: google.maps.Animation.DROP,
                    });

                    markers.perumahan.push(_perumahan);
                    openWindow(_perumahan, perumahan.nama, map);
                });

                // show marker
                addMarker(markers.perumahan);


            }, logError)
        }


    }

    function loadFaskes(map, isShow) {

        if (!isShow) {
            clearMarker(markers.faskes);
            markers.faskes = [];
        } else {

            $.ajax({
                url: '/api/master/faskes',
                method: 'get'
            }).then(function (result) {

                $.each(result.data, function (i, faskes) {
                    const latLng = new google.maps.LatLng(Number(faskes.latitude), Number(faskes.longitude));
                    const _faskes = new google.maps.Marker({
                        position: latLng,
                        title: faskes.nama,
                        icon: {
                            url: base_url + '/marker/faskes.png',
                            scaledSize: new google.maps.Size(32, 32)
                        },
                        animation: google.maps.Animation.DROP,

                    });
                    markers.faskes.push(_faskes);
                    openWindow(_faskes, faskes.nama, map);
                });

                addMarker(markers.faskes);


            }, logError);
        }
    }

    function loadPerkimtan(map, isShow) {

        if (!isShow) {
            clearMarker(markers.perkimtan);
            markers.perkimtan = [];
        } else {

            $.ajax({
                url: '/api/master/perkimtan',
                method: 'get'
            }).then(function (result) {


                $.each(result.data, function (i, perkimtan) {

                    const latLng = new google.maps.LatLng(Number(perkimtan.latitude), Number(perkimtan.longitude));

                    const _perkimtan = new google.maps.Marker({
                        position: latLng,
                        title: perkimtan.nama,
                        icon: {
                            url: base_url + '/marker/perkimtan.png',
                            scaledSize: new google.maps.Size(32, 32)
                        },
                        animation: google.maps.Animation.DROP,

                    });
                    markers.perkimtan.push(_perkimtan);
                    openWindow(_perkimtan, perkimtan.nama, map);
                });

                addMarker(markers.perkimtan);


            }, logError);
        }
    }

    function loadSekolah(map, isShow) {
        if (!isShow) {
            clearMarker(markers.sekolah);
            markers.sekolah = [];
        } else {
            $.ajax({
                url: '/api/master/sekolah',
                method: 'get'
            }).then(function (result) {

                $.each(result.data, function (i, sekolah) {
                    const latLng = new google.maps.LatLng(Number(sekolah.latitude), Number(sekolah.longitude));
                    const _sekolah = new google.maps.Marker({
                        position: latLng,
                        title: sekolah.nama,
                        icon: {
                            url: base_url + '/marker/sekolah.png',
                            scaledSize: new google.maps.Size(32, 32)
                        },
                        animation: google.maps.Animation.DROP,
                    });

                    markers.sekolah.push(_sekolah);
                    openWindow(_sekolah, sekolah.nama, map);
                });

                addMarker(markers.sekolah);

            }, logError);
        }
    }

    function loadmap() {

        $.ajax({
            url: '/api/kecamatan/area',
            method: 'get'
        }).then(function (result) {

            console.log(result);

            let coords = [];
            let rgb = "255,255,0";
            $.each(result.data, function (i, area) {
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
                    fillColor: 'rgb(226,183,83)',
                    fillOpacity: 0.35
                });

                polygon.setMap(map);

                let contentString = area.kecamatan;
                infowindow = new google.maps.InfoWindow({
                    content: contentString
                });

                new google.maps.event.addListener(polygon, 'click', function (event) {
                    // infowindow.setContent(contentString);
                    // infowindow.setPosition(event.latLng);
                    // infowindow.open(map);
                    let kecamatan = area.kecamatan.replace(/\s+/g, '-').toLowerCase();
                    window.location.href = base_url + '/penyakit/laporan?kecamatan=' + kecamatan;
                });

                new google.maps.event.addListener(polygon, 'mouseover', function (event) {
                    infowindow.setContent(contentString);
                    infowindow.setPosition(event.latLng);
                    infowindow.open(map);
                    // let kecamatan = area.kecamatan.replace(/\s+/g, '-').toLowerCase();
                    // window.location.href = base_url + '/penyakit/laporan?kecamatan=' + kecamatan;
                });


            });


            if (typeof Promise === 'undefined') {
                alert('Browser tidak support untuk menampilkan informasi pada peta');
                return;
            }

            loadLaporan(map).catch(logError);

        });


    }

    function init() {
        const latitude = Number(-6.2383);
        const longitude = Number(106.9756);

        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: latitude, lng: longitude},
            zoom: 12
        });

        loadmap(map);

        // switchery


        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

        elems.forEach(function (html) {
            var switchery = new Switchery(html);
        });

    }

    function changeMapLayer(el, layer) {

        let isChecked = $(el).is(':checked');

        switch (layer) {
            case 1:
                loadSekolah(map, isChecked);
                break;
            case 2:
                loadFaskes(map, isChecked);
                break;
            case 3:
                loadPerkimtan(map, isChecked);
                break;
            case 4:
                loadApartement(map, isChecked);
                break;
            case 5:
                loadPerumahan(map, isChecked);
                break;

        }
    }

    function addMarker(markers) {

        $.each(markers, function (i, marker) {

            marker.setMap(map);
        });

        // Add a marker clusterer to manage the markers.
        // cluster = new MarkerClusterer(map, markers,
        //     {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
    }

    function clearMarker(markers) {
        console.log("masuk clear marker");
        $.each(markers, function (i, marker) {
            marker.setMap(null);
        });

        // cluster.setMap(null);
        // cluster.clearMarkers();
    }

    return {
        init: (init),
        changeMapLayer: (changeMapLayer)
    }
})();

$(document).ready(function () {
    window.dashboard.init();

    $("input[name=bulan]").datepicker({
        format: "yyyy-mm",
        startView: "months",
        minViewMode: "months",
        autoclose: true
    });

    Highcharts.setOptions({
        chart: {
            style: {
                fontFamily: 'Open Sans'
            }
        }
    });


    loadChart();

    $("#bulan").change(function () {
        let _bulan = $(this).val();
        loadChart();
    });

    // setInterval(function(){
    //     loadChart();
    // }, 5000);

});

function loadChart() {
    loadStatistikJumantik()
        .then(buildCartJumantik)
        .then(loadStatistikPenyakitMenularNyamuk)
        .then(buildChartPenyakitNyamukMenular)
        .catch(logError);
}

function loadStatistikJumantik() {

    let _promise = new Promise(function (resolve, reject) {
        $.ajax({
            url: base_url + '/api/dashboard/jumantik?' + $("#form-filter").serialize(),
            method: 'get'
        }).then(function (result) {
            let data = [];
            $.each(result, function (i, o) {
                let _date = {
                    year: Number(moment(o.created_at, 'YYYY-MM-DD').format('YYYY')),
                    month: Number(moment(o.created_at, 'YYYY-MM-DD').format('MM')),
                    day: Number(moment(o.created_at, 'YYYY-MM-DD').format('DD'))
                };
                data.push([Date.UTC(Number(_date.year), Number(_date.month) - 1, Number(_date.day)) - 1, o.jumlah]);
            });

            resolve(data);

        }, function (err) {
            reject(err);
        });
    });

    return _promise;


}

function buildCartJumantik(data) {
    Highcharts.chart('ct-jumantik', {
        credits: false,
        chart: {
            type: 'line',
            zoomType: 'x',
            animation: Highcharts.svg, // don't animate in old IE
            marginRight: 10,
            events: {
                load: function () {

                    let series = this.series[0];
                    console.log('series', series);

                }
            }
        },
        title: {
            text: 'Laporan Jumantik'
        },

        // subtitle: {
        //     text: document.ontouchstart === undefined ?
        //         'Click and drag in the plot area to zoom in' : 'Pinch the chart to zoom in'
        // },
        xAxis: {
            type: 'datetime'
        },
        yAxis: {
            title: {
                text: 'Jumlah Laporan'
            }
        },
        legend: {
            enabled: true
        },
        tooltip: {

            xDateFormat: '%d/%m/%Y'

        },
        plotOptions: {
            area: {
                fillColor: {
                    linearGradient: {
                        x1: 0,
                        y1: 0,
                        x2: 0,
                        y2: 1
                    },
                    stops: [
                        [0, Highcharts.getOptions().colors[0]],
                        [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                    ]
                },
                marker: {
                    radius: 2
                },
                lineWidth: 1,
                states: {
                    hover: {
                        lineWidth: 1
                    }
                },
                threshold: null
            }
        },

        series: [
            {
                type: 'area',
                name: 'Laporan',
                data: data
            },

        ]
    });
}

function loadStatistikPenyakitMenularNyamuk() {

    let _promise = new Promise(function (resolve, reject) {
        $.ajax({
            url: base_url + '/api/dashboard/penyakit_nyamuk_menular?' + $("#form-filter").serialize(),
            method: 'get'
        }).then(function (result) {
            console.log(result);

            resolve(result);
        }, function (err) {
            reject(err);
        });
    });

    return _promise;


}

function buildChartPenyakitNyamukMenular(data) {
    Highcharts.chart('ct-penyakit-menular-nyamuk', {
        credits: false,
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Sebaran Penyakit Nyamuk Menular'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Intensitas',
            colorByPoint: true,
            data: data
        }]
    });
}