<?php

//TODO CAMBIAR A MAS SEGURO


if (!function_exists("getApiTokenSpotify")) {
    function getApiTokenSpotify()
    {

        $config = json_decode(file_get_contents(__DIR__ . "/../credentials.json"));



        $url = "https://accounts.spotify.com/api/token";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials&client_id=".$config->client_id."&client_secret=".$config->client_secret."");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1000);
        $response = curl_exec($ch);
        return $response;
    }
}


