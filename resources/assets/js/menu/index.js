

let table = {};
$(document).ready(function(){
    table = {
        el: $("#table-menu"),
        evt: {},
        init: function(){
            let self = this;
            // console.log(self);
            self.el.DataTable({
                saveState: true
            });
        }
    };

    table.init();
});