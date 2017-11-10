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
        evt: {},
        init: function () {
            let self = this;
            self.el.select2();
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