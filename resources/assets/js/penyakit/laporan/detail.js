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


window.openFoto = (e) => {
    $("#modal_foto").data('foto', $(e).data('foto'));
    $("#modal_foto").modal();
};

$(document).ready(function () {


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

            self.el.DataTable({
                order: [[0, 'desc']]
            });
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