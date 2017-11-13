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