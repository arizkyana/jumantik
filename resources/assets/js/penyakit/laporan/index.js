/**
 * Created by agungrizkyana on 10/21/17.
 */
let table = {};
let filter = {};

$(document).ready(function(){

    table = {
        el: $("#table-laporan-jumantik"),
        evt: {},
        init: function(){
            const self = this;

            self.el.dataTable();
        }
    };

    filter.tipePelapor = {
        el: $('#tipe_pelapor'),
        evt: {},
        init: function(){
            const self = this;

            self.el.select2();
        }
    };

    filter.tanggalMulai = {
        el: $('#tanggal_mulai'),
        evt: {},
        init: function(){
            const self = this;

            self.el.datepicker({
                autoclose: true,
                orientation: 'bottom'
            });
        }
    };

    filter.tanggalAkhir = {
        el: $('#tanggal_akhir'),
        evt: {},
        init: function(){
            const self = this;

            self.el.datepicker({
                autoclose: true,
                orientation: 'bottom'
            });
        }
    };

    filter.tanggalMulai.init();
    filter.tanggalAkhir.init();

    filter.tipePelapor.init();

    table.init();
});