var _dataTable;
var table,
    kecamatan;
window.dinkes = (function () {

    function init() {
        initTable();
    }

    function initTable() {
        table = {
            el: $("#table-dinkes"),
            evt: {},
            init: function () {
                const self = this;

                self.el.DataTable();
            }
        };

        table.init();
    }


    return {
        init: (init)
    }
})();

$(document).ready(function () {
    window.dinkes.init();
});

window.remove = function (id) {
    event.preventDefault();

    swal({
        title: "Apakah Anda Yakin?",
        text: "Puskesmas yang sudah di hapus tidak dapat di kembalikan!",
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
            "Puskesmas sudah dihapus.",
            "success");
    });
};