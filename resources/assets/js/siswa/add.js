/**
 * Created by Lenovo on 9/19/2017.
 */
let fotoSiswaPreview;
$(document).ready(function(){
    fotoSiswaPreview = $("#foto");

    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#foto-siswa').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    fotoSiswaPreview.change(function(){
        readURL(this);
    });
});