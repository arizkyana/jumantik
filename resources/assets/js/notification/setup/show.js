var _dataTable;
var table,
    kecamatan;
window.dinkes = (function () {

    function init() {
        initTable();
    }

    function initTable() {
        table = {
            el: $("#table-users"),
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