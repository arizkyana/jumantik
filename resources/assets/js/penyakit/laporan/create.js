/**
 * Created by agungrizkyana on 10/21/17.
 */

let form = {};

$(document).ready(function () {

    form.inputSuspect = {
        el: $("#input_suspect_dbd"),
        evt: {},
        init: function () {
            const self = this;

            self.el.hide();
        },

    };

    form.checkSuspect = {
        el: $("#is_suspect_dbd"),
        evt: {
            onChange: function (e) {
                e.preventDefault();

                if ($(this).is(":checked")) {
                    form.inputSuspect.el.show();
                } else {
                    form.inputSuspect.el.hide();
                }
                return;
            }
        },
        init: function () {
            const self = this;

            self.el.change(self.evt.onChange);
        }
    };

    form.penyakit = {
        el: $("#penyakit"),
        evt: {},
        init: function () {
            const self = this;

            self.el.select2();
        }
    };

    form.kelurahan = {
        el: $("#kelurahan"),
        evt: {
            onChange: function () {
            }
        },
        init: function () {
            const self = this;

            self.el.select2();
        },

    };

    form.kecamatan = {
        el: $("#kecamatan"),
        evt: {
            onChange: function (e) {
                e.preventDefault();
                const _kecamatan = $(this).val();
                $.ajax({
                    url: '/api/kelurahan/get_by_kecamatan/' + _kecamatan,
                    method: 'get',
                    headers: {
                        'Accept': 'application/json',
                        'Content-type': 'application/json'
                    }
                }).then(function (result) {
                    form.kelurahan.el.empty();
                    form.kelurahan.el.select2().val('');
                    $.each(result, function (i, kelurahan) {
                        let options = '<option value="' + kelurahan.kelurahan_id + '">' + kelurahan.nama_kelurahan + '</option>';
                        form.kelurahan.el.append(options);
                    });
                });

                return;
            }
        },
        init: function () {
            const self = this;

            self.el.select2();
            self.el.change(self.evt.onChange);
        }
    };

    form.penyakit.init();
    form.kelurahan.init();
    form.kecamatan.init();

    form.checkSuspect.init();
    form.inputSuspect.init();


});