<?php
#
# PHP PTZ Controller (ptzcontrol.php)
#
# Author: 	Ap Rose
# Version:	0.0.1
#
# Device:	EC76-U15 (IPC365) 360Eye S
# Firmware:	General_EC76-U15(P)_V4.16.80
# MAC OID: 	30:4A:26
#
# GitHub:	https://github.com/ap-rose/php-ptz-controller
#
error_reporting(E_ALL);
$actions['up'] = "\xcc\xdd\xee\xff\x77\x4f\x00\x00\xe3\x12\x69\x00\x48\x00\x00\x00\x00\x00\x00\x00\xaf\x93\xc6\x3b\x09\xf7\x4b\x01\x01\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x05\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00";
$actions['down'] = "\xcc\xdd\xee\xff\x77\x4f\x00\x00\xe3\x12\x69\x00\x48\x00\x00\x00\x00\x00\x00\x00\xaf\x93\xc6\x3b\x09\xf7\x4b\x01\x01\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\xfb\xff\xff\xff\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00";
$actions['right'] ="\xcc\xdd\xee\xff\x77\x4f\x00\x00\xe3\x12\x69\x00\x48\x00\x00\x00\x00\x00\x00\x00\xaf\x93\xc6\x3b\x09\xf7\x4b\x01\x01\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x05\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00";
$actions['left'] = "\xcc\xdd\xee\xff\x77\x4f\x00\x00\xe3\x12\x69\x00\x48\x00\x00\x00\x00\x00\x00\x00\xaf\x93\xc6\x3b\x09\xf7\x4b\x01\x01\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\xfb\xff\xff\xff\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00";
if(empty($_GET["host"])) 	die( "Host Missing or Invalid");
if(empty($_GET["port"])) 	die( "Port Missing or Invalid");
if(empty($_GET["action"])) 	die( "Action Missing or Invalid");
$address 		= $_GET["host"]; //'192.168.1.68';
$service_port 	= $_GET["port"]; //23456;
$action			= $_GET["action"]; 
$in 			= $actions[$action];
$socket 		= socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket === false) { echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n"; }
$result = socket_connect($socket, $address, $service_port);
if ($result === false) { echo "socket_connect() failed.\nReason: ($result) " . socket_strerror(socket_last_error($socket)) . "\n";}
socket_write($socket, $in);
socket_close($socket);
?>
