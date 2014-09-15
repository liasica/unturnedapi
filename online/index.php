<?php
date_default_timezone_set('PRC');
include_once('../functions/functions.php');  //some function *** required

// online players
$onlinecallback = isset($_GET['onlinecallback']) ? trim($_GET['onlinecallback']) : ''; // *** required for jsonp and json

$path = "E:/Steam/SteamApps/common/Unturned/"; // where is your game root do not delete the last "/" use "/" instead of "\"
$file = $path . "Unturned_Data/Managed/mods/OnlinePlayers/OnlinePlayers.txt"; // do not change this

if (empty($_GET['port'])) {
	$data = array(
		'status' => 'error arg p or port can not empty',
	);
	$data = json_encode($data);
} else {
	$port = $_GET['port'];
	exec("netstat -aon|findstr" . " " . $port, $port_return);
	if (!empty($port_return)) {
		$exp = explode("*:*", $port_return[0]);
		$data['status']['pid'] = trimall($exp[1]);
		$data['status']['server_status'] = 'running';
		if (alexReadFile($file)) {
			$fileArr = explode("\r\n", trim(alexReadFile($file)));
			$data = end($fileArr);
		}
	} else {
		$data['status']['pid'] = "NULL";
		$data['status']['server_status'] = "stopped";
		$data = json_encode($data);
	}
}



echo $onlinecallback . $data; // this line required ****
