<?php
date_default_timezone_set('PRC');
include_once('../functions/functions.php');  //some function *** required

// online players
$onlinecallback = isset($_GET['onlinecallback']) ? trim($_GET['onlinecallback']) : ''; // *** required for jsonp and json

$path = "E:/Steam/SteamApps/common/Unturned/"; // where is your game root do not delete the last "/" use "/" instead of "\"
$file = $path . "Unturned_Data/Managed/mods/OnlinePlayers/OnlinePlayers.txt"; // do not change this

if (alexReadFile($file)) {
	$fileArr = explode("\r\n", trim(alexReadFile($file)));
	$onlineplayers = end($fileArr);
}



echo $onlinecallback . '(' . $onlineplayers . ')'; // this line required ****
