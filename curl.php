<?php

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_PORT => "8000",
    CURLOPT_URL => "http://localhost:8000/api/penyakit/laporan/create?pelapor=1",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "{\n\t\"pelapor\" : 1\n}\t",
    CURLOPT_HTTPHEADER => array(
        "accept: application/json",
        "authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjM1NGRlNGFhMDZmYmJhNzE3ZWNhYmEyMWRmODBkMDQ1ZTNlOGZjMzZkOWQwZWNlZjY1NDZmNTIyMjUxMWE3Y2E5NjUxMzE4ZTIxOTc5OTE2In0.eyJhdWQiOiIyIiwianRpIjoiMzU0ZGU0YWEwNmZiYmE3MTdlY2FiYTIxZGY4MGQwNDVlM2U4ZmMzNmQ5ZDBlY2VmNjU0NmY1MjIyNTExYTdjYTk2NTEzMThlMjE5Nzk5MTYiLCJpYXQiOjE1MDg5ODg1MTMsIm5iZiI6MTUwODk4ODUxMywiZXhwIjoxNTQwNTI0NTEzLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.SqNeShUJ9QbUfV6ggWnYFuUwBPKlj_5TYdE6d-L6nnHWgDdryYbEXLxT1b8OCm27lU2rwpAWSRopc1eX5Gxfclk2nkFjsc6JBKbvBmp15cF2dYvU_gc4lQfQ3Xo14eg6pL4LPwV9NoXP34VhcKVjpqLpSnbbFLdaA-u8-rxX3I7bbO5h8boRzfE8Q-gR16zsgETLbvbaKPGlt-CFeI7nhbtw87oFn7j-GMTaM9GygQZLVp8A3oAc6YG_syXFq_4k0CQLghtXAlLpzhuP7cfzMj_Kke9sbqhIwVET2UuMGd0QJ4ZlBxri9CAyItjyeK66XB9Q2pi1z-4Cv2FbcLs_ggfdEUlvft-UjTM4URyE4z5xjg5AgQVijYFDSoEF5GhjkFppijoX2Ga0whbYe3yoV-jVCWcuNnK6onFu0HMJGAgQtMbJfZKq75GQPfjXRp4jK9RGzv5NLQl2Gse8UbDpz234euQV6b4Ihe62bOJqCD7toWYRRJCiEMwsRTB0czO9g1Kcksg_i5C4JWQfUbJ1S1qjQ8eHnUK0EIGkq-PU0Asjiu_D-mnHARHBZ7PssvsrvY3P8Twl2CHNEL0jSPTqCZBmFRIRbIYUDN9aOGuaGJdlrY5d5D3yYrEkZhupLdmMnCdQvt09dG9PKDnw3q1BjQD3VxtrDrs31eUGyqH-1H4",
        "cache-control: no-cache",
        "postman-token: 574b7feb-c641-cb78-2de1-267ef74a5172"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}