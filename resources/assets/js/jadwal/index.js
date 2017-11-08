/**
 * Created by agungrizkyana on 11/9/17.
 */

let table = {};
let supervisor = {};
let pic = {};

$(document).ready(function(){

    table = {
        el: $("#table-jadwal"),
        evt: {},
        init: function(){
            const self = this;

            self.el.dataTable();
        }
    };

    supervisor = {
        el: $("#supervisor"),
        evt: {},
        init: function(){
            let self = this;
            self.el.select2();
        }
    };

    pic = {
        el: $("#pic"),
        evt: {},
        init: function(){
            let self = this;
            self.el.select2();
        }
    };

    table.init();
    supervisor.init();
    pic.init();
});