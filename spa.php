<?php
function goo_gl_short_url($longUrl) {
    $GoogleApiKey = 'AIzaSyBG9E_Nm4kPzZJHCIKyI0PH70ElUpAXriM';
    $postData = array('longUrl' => $longUrl, 'key' => $GoogleApiKey);
    $jsonData = json_encode($postData);
    $curlObj = curl_init();
    curl_setopt($curlObj, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url');
    curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
    //As the API is on https, set the value for CURLOPT_SSL_VERIFYPEER to false. This will stop cURL from verifying the SSL certificate.
    curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curlObj, CURLOPT_HEADER, 0);
    curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
    curl_setopt($curlObj, CURLOPT_POST, 1);
    curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);
    $response = curl_exec($curlObj);
    $json = json_decode($response);
    curl_close($curlObj);
    return $json->id;
//    return print_r($json);
}
echo goo_gl_short_url($_SERVER['QUERY_STRING']);
//header(goo_gl_short_url($_SERVER['REQUEST_URI']));
die();
?>
