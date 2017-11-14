/**
 * Created by agungrizkyana on 11/9/17.
 */

let table = {};
let supervisor = {};
let pic = {};

$(document).ready(function () {

    table = {
        el: $("#table-jadwal"),
        evt: {},
        init: function () {
            const self = this;

            self.el.dataTable();
        }
    };

    supervisor = {
        el: $("#supervisor"),
        evt: {
            change: function (e) {
                e.preventDefault();

                const id = $(this).val();

                loadWilayah(id);


                return;
            }
        },
        init: function () {
            let self = this;
            self.el.select2();

            if (self.el.val()) {
                const id = self.el.val();
                loadWilayah(id);
            }

            self.el.change(self.evt.change);
        }
    };

    pic = {
        el: $("#pic"),
        evt: {},
        init: function () {
            let self = this;
            self.el.select2();
        }
    };

    table.init();
    supervisor.init();
    pic.init();
});

function loadWilayah(id){
    $("#lokasi").empty();

    $.ajax({
        url: base_url + '/api/jadwal/wilayah/' + id,
        method: 'get'
    }).then(function (result) {
        $("#lokasi").append(
            ' <strong>' + result.data.nama + '</strong><br>\n' +
            result.data.alamat + ' <br>\n' +
            result.data.nama_kelurahan + ' , ' + result.data.nama_kecamatan  + '<br>\n' +
            ' <abbr title="Phone">P:</abbr> ' + result.data.phone
        );

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
        swal("Berhasil!",
            "Jadwal sudah dihapus.",
            "success");
    });
};