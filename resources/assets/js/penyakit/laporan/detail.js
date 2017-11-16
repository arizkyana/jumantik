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

window.detail = (function () {

    function openWindow(object, contentString, map) {

        let infowindow = new google.maps.InfoWindow({
            content: contentString
        });

        new google.maps.event.addListener(object, 'click', function (event) {
            infowindow.setContent(contentString);
            infowindow.setPosition(event.latLng);
            infowindow.open(map);
        });
    }


    function loadmap() {

        let promise = new Promise(function(resolve, reject){
            $.ajax({
                url: '/api/kecamatan/area',
                method: 'get'
            }).then(function (result) {

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

                resolve({
                    map: map,
                    lat: $("#lat").val(),
                    lon: $("#lon").val()
                });

            }, function(err){
                reject(err);
            });
        });

        return promise;



    }

    function addMarker(map) {

        const latLng = new google.maps.LatLng(Number(map.lat), Number(map.lon));

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
        const latitude = Number(-6.2383);
        const longitude = Number(106.9756);

        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: latitude, lng: longitude},
            zoom: 12
        });

        loadmap(map)
            .then(addMarker)
            .catch(logError);


    }





    return {
        init: (init)
    }
})();

window.openFoto = (e) => {
    $("#modal_foto").data('foto', $(e).data('foto'));
    $("#modal_foto").modal();
};

$(document).ready(function () {
    window.detail.init();

    $("#modal_foto").on('show.bs.modal', function (e) {
        const foto = $(this).data('foto');
        let imgFoto = $("#foto");

        imgFoto.attr('src', base_url + '/media' + foto);
    });

    tableDetail = {
        el: $("#table-detail-laporan"),
        evt: {},
        init: function () {
            let self = this;

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
        swal("Berhasil!",
            "Laporan sudah dihapus.",
            "success");
    });
};