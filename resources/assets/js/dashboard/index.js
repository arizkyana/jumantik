// load map

function loadmap(){
    const latitude = Number(-6.2383);
    const longitude = Number(106.9756);



    let map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: latitude, lng: longitude},
        zoom: 14
    });


}

$(document).ready(function(){
    loadmap();
});