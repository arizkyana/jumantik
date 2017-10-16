let table = {};
$(document).ready(function(){
    table = {
        el: $("#table-api-client"),
        evt: {},
        init: function(){
            let self = this;
            self.el.dataTable();
        }
    };

    table.init();
});