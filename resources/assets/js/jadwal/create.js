/**
 * Created by agungrizkyana on 11/9/17.
 */

window.jadwal = (function () {

    function initDatePicker(){
        let el = {
            tanggalMulai : $("#mulai"),
            tanggalAkhir : $("#akhir")
        };

        el.tanggalMulai.datepicker({
            orientation: 'top'
        });

        el.tanggalAkhir.datepicker({
            orientation: 'top'
        });

        return el;
    }

    function initClockPicker() {
        let el = {
            jamMulai: $("#jam_mulai"),
            jamAkhir: $("#jam_akhir")
        };

        el.jamMulai.clockpicker({
            placement: 'top',
            donetext: 'Done'
        });
        el.jamAkhir.clockpicker({
            placement: 'top',
            donetext: 'Done'
        });

        return el;
    }

    function init() {
        initClockPicker();
        initDatePicker();
    }

    return {
        init: (init)
    }
})();

$(document).ready(function () {
    window.jadwal.init();
});