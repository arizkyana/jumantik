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

            self.el.dataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/api/penyakit/laporan/ajax_laporan',
                    method: 'post'
                },
                columns: [

                    {data: 'created_at'},
                    {data: 'pelapor'},
                    {data: 'pelapor'},
                    {data: 'penyakit'},
                    {data: 'tindakan'},
                    {data: 'status'},
                    {data: 'id'},
                    {data: 'id'}
                ]
            });
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