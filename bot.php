<?php
$access_token = 'v1Dj2r4Kpr7QBTU/FAlxcVPNjsq7hbQ8c8m8MGNZ79VB3e0kTwBTpViLJ8grbnuLjD5kwIp/j0nRFVi01TR/l6c3D9jAqf4zbl+3WyrxqO71QXNtx6fNH2co8Pg1Zupj1TF9FY+7sacgE4ZyWpoz9gdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
?>
