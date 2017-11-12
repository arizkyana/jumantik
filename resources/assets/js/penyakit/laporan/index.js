/**
 * Created by agungrizkyana on 10/21/17.
 */
let table = {};
let filter = {};
let _dataTable = {};
(function () {

    table = {
        el: $("#table-laporan-jumantik"),
        evt: {},
        init: function () {
            const self = this;

            _dataTable = self.el.DataTable({
                processing: true,
                serverSide: true,
                saveState: true,
                ajax: {
                    url: base_url + '/api/penyakit/laporan/ajax_laporan',
                    method: 'post'
                },
                order: [[0, 'desc']],
                createdRow: function (row, data) {
                    let text = "";
                    let bg = "";
                    switch (data.status) {
                        case 1:
                            text = 'Open';
                            bg = 'bg-primary';
                            break;
                        case 2:
                            text = 'Finish';
                            bg = 'bg-success';
                            break;
                        case 3:
                            text = 'On Going';
                            bg = 'bg-warning';
                            break;
                    }

                    $('td', row).eq(6).html(text).addClass(bg);
                },
                columns: [

                    {
                        data: 'created_at',
                        name: 'laporan.created_at',
                        searchable: false,
                        render: function (data, type, row, meta) {
                            const html = '<a class="text-danger" href="' + base_url + '/penyakit/laporan/' + row.id + '/show">' + data + '</a>';
                            return html;
                        }
                    },
                    {
                        data: 'pelapor',
                        name: 'users.name',

                    },
                    {
                        data: 'tipe_pelapor',
                        name: 'role.name',

                    },
                    {
                        data: 'nama_penyakit',
                        name: 'penyakit.nama_penyakit'
                    },
                    {
                        data: 'nama_tindakan',
                        name: 'tindakan.nama_tindakan'
                    },

                    {data:'nama_kecamatan', name:'kecamatan.nama_kecamatan', visible: false},
                    {data:'nama_kelurahan', name:'kelurahan.nama_kelurahan', visible: false},

                    {
                        data: 'alamat',
                        name: 'laporan.alamat',
                        render: function (data, type, row, meta) {
                            const html = data + '<br /><small>' + row.nama_kelurahan + ", " + row.nama_kecamatan + '</small>';
                            return html;
                        }
                    },
                    {
                        searchable: false,
                        data: 'status',
                        name: 'laporan.status'
                    },



                ]
            });
        },
        redraw: function (query) {
            let url = base_url + '/api/penyakit/laporan/ajax_laporan' + query;
            _dataTable.ajax.url(url).load();
            _dataTable.draw(true);
        }
    };

    filter.tipePelapor = {
        el: $('#tipe_pelapor'),
        evt: {
            change: function (e) {
                e.preventDefault();
                table.redraw("?" + $("#form-filter").serialize());
            }
        },
        init: function () {
            const self = this;

            self.el.select2();

            self.el.change(self.evt.change);
        }
    };
    filter.penyakit = {
        el: $("#penyakit"),
        evt: {
            change: function (e) {
                e.preventDefault();

                table.redraw("?" + $("#form-filter").serialize());
            }
        },
        init: function () {
            const self = this;
            self.el.change(self.evt.change);
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
        evt: {
            change: function (e) {
                e.preventDefault();
                table.redraw("?" + $("#form-filter").serialize());
            }
        },
        init: function () {
            const self = this;

            self.el.datepicker({
                autoclose: true,
                orientation: 'bottom'
            });

            self.el.change(self.evt.change);


        }
    };

    filter.tanggalMulai.init();
    filter.tanggalAkhir.init();
    filter.tipePelapor.init();
    filter.penyakit.init();
    table.init();
})();

window.deleteLaporan = (id) => {



    let confirms = confirm('Apakah anda yakin?');
    if (confirms) {
        $.ajax({
            url: base_url + '/api/penyakit/laporan/delete/' + id,
            method: 'get',

        }).then(function (result) {
            console.log(result);
            table.redraw("");
        }, logError);
    }


};

window.refresh = () => {
    table.redraw("");
};