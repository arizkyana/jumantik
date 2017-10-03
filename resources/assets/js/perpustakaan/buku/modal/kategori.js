const modalKategori = {
  el: $("#modal-kategori"),
  evt: {
      onShow: function(e){
          // alert('modal kategori on show');
      },
      onHide: function(e){
          // alert('modal kategori on hide');
      }
  }
};

const formKategori = {
    el: $("form[name=form-kategori]"),
    evt: {
        submit: function(e){
            e.preventDefault();
            const data = $(this).serialize();

            return;

        }
    }
};

modalKategori.el.on('show.bs.modal', modalKategori.evt.onShow);
modalKategori.el.on('hide.bs.modal', modalKategori.evt.onHide);

formKategori.el.submit(formKategori.evt.submit);

module.exports = modalKategori;
