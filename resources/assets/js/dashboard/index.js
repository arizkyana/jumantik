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

    let formData = new FormData();

    formData.append("pelapor", "nurdin");

    $.ajax({
        url: '/api/penyakit/laporan/create',
        method: 'POST',
        headers: {
            'Accept' : 'application/json',
            'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjJhNzM5NmFiNjAxMmEyOWFjN2JjZjQ3ZThiOThmMDU4Njg3NmMwM2NkZTA5OGIwMmI5ZjY5NjllYWVhNjU3NGFkNTBjMjMwNjQwYTVjZGJlIn0.eyJhdWQiOiIyIiwianRpIjoiMmE3Mzk2YWI2MDEyYTI5YWM3YmNmNDdlOGI5OGYwNTg2ODc2YzAzY2RlMDk4YjAyYjlmNjk2OWVhZWE2NTc0YWQ1MGMyMzA2NDBhNWNkYmUiLCJpYXQiOjE1MDg5Nzg1NzUsIm5iZiI6MTUwODk3ODU3NSwiZXhwIjoxNTQwNTE0NTc1LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.e-T7mwGfeYNDB1kINjlVQ8nOYkALGULbte-JY4o4k7yJk9u_0UyGBG9YPGcvBT8HY5IBRRgvvjS6YE7Xe3bxhZcpFDEZ_bq2lWFMleAZ20Opp0Q9irN00r8A_gYpKyBMbrXSpc3WlWboHZdswiMUGphx523L8UB6epjNTSDe4DHfHaWBJo5hER0jf4me57ZShStFm87dODpw3V-McpTb_0QwQnE4Gsw96OGji_3T3_5U1lALNQOcUttNTvVT6-a_2SMUxR40ZavfZ-Gduc_8thc5SkwjkFpF4-JKXrfLLZx_8TnFpCv1znDay-mPB34z3BxeATUWPI8AcpvwdpDks3mFDSB_M7jy7ivDYxEZWER-snoLXWmMHXIbxBx0jYE2OiaqFM0z-DdYCZV4M017VFx1736R00a34ckn0DkUlrBpCRoToGBnLcDw7bcw9RbrkGv2QvWdXbjLOT_gry2vD3XAGVcigIerWKLdtO8E4VlDNnqXp5bAxXY6c1vY6Y6O3x3uayZwAUF6j1DH54UQkOK4FwGlsl_bduLqajF223O5Zgj0l6m_CHOwVOWgi0UPPZqhrrt-jwbqUxt5-5tLGMmwHhCiIJJ8nyutkBEleZjp7_dx7qbV8s7HOs864JNPBAVYG7onIORV2d971w5eBnQmhKEiSBoRRjzYAydIdIA',
        },
        data: "pelapor=jono"
    }).then(function(result){
        console.log(result);
    });
});