/**
 * Created by agungrizkyana on 10/21/17.
 */
let table = {};

$(document).ready(function(){

    table = {
        el: $("#table-jadwal"),
        evt: {},
        init: function(){
            const self = this;

            self.el.dataTable();
        }
    };

    table.init();
});