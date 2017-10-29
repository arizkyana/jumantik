/**
 * Created by agungrizkyana on 10/21/17.
 */
let table = {};
let filter = {};

$(document).ready(function () {

    table = {
        el: $("#table-laporan-jumantik"),
        evt: {},
        init: function () {
            const self = this;

            self.el.dataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/api/penyakit/laporan/ajax_laporan',
                    method: 'post'
                },
                columns: [

                    {
                        data: 'created_at',
                        render: function (data, type, row, meta) {
                            const html = '<a class="text-danger" href="' + base_url + '/penyakit/laporan/' + row.id + '/show">' + data + '</a>';
                            return html;
                        }
                    },
                    {data: 'pelapor'},
                    {data: 'tipe_pelapor'},
                    {data: 'nama_penyakit'},
                    {data: 'nama_tindakan'},
                    {data: 'nama_status'},
                    {
                        data: 'alamat',
                        render: function (data, type, row, meta) {
                            const html = data + '<br /><small>' + row.nama_kelurahan + ", " + row.nama_kecamatan + '</small>';
                            return html;
                        }
                    },
                    {
                        data: 'id',
                        render: function (data, type, row, meta) {
                            const html = '<a href="#" class="btn btn-primary btn-sm"  tooltip="Detail Laporan"><i class="fa fa-eye"></i></a>';
                            return html;
                        }
                    }
                ]
            });
        }
    };

    filter.tipePelapor = {
        el: $('#tipe_pelapor'),
        evt: {},
        init: function () {
            const self = this;

            self.el.select2();
        }
    };

    filter.tanggalMulai = {
        el: $('#tanggal_mulai'),
        evt: {},
        init: function () {
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
        init: function () {
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