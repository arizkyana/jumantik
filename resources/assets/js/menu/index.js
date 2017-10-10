

let table = {};
$(document).ready(function(){
    table = {
        el: $("#table-menu"),
        evt: {},
        init: function(){
            let self = this;
            self.el.dataTable();
        }
    };

    table.init();
});