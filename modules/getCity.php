<?php

$ipaddress = '';
if (getenv('HTTP_CLIENT_IP'))
    $ipaddress = getenv('HTTP_CLIENT_IP');
else if(getenv('HTTP_X_FORWARDED_FOR'))
    $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
else if(getenv('HTTP_X_FORWARDED'))
    $ipaddress = getenv('HTTP_X_FORWARDED');
else if(getenv('HTTP_FORWARDED_FOR'))
    $ipaddress = getenv('HTTP_FORWARDED_FOR');
else if(getenv('HTTP_FORWARDED'))
    $ipaddress = getenv('HTTP_FORWARDED');
else if(getenv('REMOTE_ADDR'))
    $ipaddress = getenv('REMOTE_ADDR');
else
    $ipaddress = 'UNKNOWN';

$SERVICE_KEY = 'S67AZOQKDNFlfJF';

$url = "http://pro.ip-api.com/json/$ipaddress?key=$SERVICE_KEY&lang=en&fields=city";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$city = curl_exec($ch);

$city = json_decode($city, TRUE);

$key = '3b59eb3c6d9e4307a1de4c83d8e9fa81';
$Y_API_KEY = 'trnsl.1.1.20181119T151542Z.1cf915f1b267c1f0.d43f86e0bced0836856c86d485f5e757d395dadf';

$host = "https://translate.yandex.net/api/v1.5/tr.json/translate";

$text = $city['city'];

$params = "?key=$Y_API_KEY&lang=en-hu&text=$text";


$result = file_get_contents($host.$params, true);
$result = json_decode($result);
$city = array(
    'city' => $result->text[0]
);
$city = json_encode($city);
echo $city;