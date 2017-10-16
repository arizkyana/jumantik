var form = {
    api : {
        scope: {}
    }
};

$(document).ready(function(){

    form.api.scope = {
        el: $("#client_scope"),
        evt: {
            onChange: function(e){
                e.preventDefault();
                return;
            }
        },
        init: function(){
            const self = this;
            self.el.select2({
                placeholder: 'Pilih Scope'
            });
        }
    }

});