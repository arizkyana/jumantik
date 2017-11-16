var _dataTable;
var table,
    kecamatan;
window.notifikasi = (function () {

    function init() {
        initTable();
    }

    function initTable() {
        table = {
            el: $("#table-setup"),
            evt: {},
            init: function () {
                const self = this;

               _dataTable =  self.el.DataTable();


            }
        };

        table.init();
    }


    return {
        init: (init)
    }
})();

$(document).ready(function () {
    window.notifikasi.init();
});

window.remove = function (id) {
    event.preventDefault();

    swal({
        title: "Apakah Anda Yakin?",
        text: "Notifikasi yang sudah di hapus tidak dapat di kembalikan!",
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
            "Notifikasi sudah dihapus.",
            "success");
    });
};