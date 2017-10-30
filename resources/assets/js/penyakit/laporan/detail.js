window.openFoto = (e) => {
    $("#modal_foto").data('foto', $(e).data('foto'));
    $("#modal_foto").modal();
};

$("#modal_foto").on('show.bs.modal', function (e) {
    const foto = $(this).data('foto');
    let imgFoto = $("#foto");

    imgFoto.attr('src', base_url + '/media' + foto);
});
