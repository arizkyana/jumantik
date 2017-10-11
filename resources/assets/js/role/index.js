let table = {};
$(document).ready(function(){
    table = {
        el: $("#table-role"),
        evt: {},
        init: function(){
            let self = this;
            self.el.dataTable();
        }
    };

    table.init();
});