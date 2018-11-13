<?php 

include("Sms.php");

//Config
$host = "192.168.8.1";
$user = "admin";
$pass = "admin";

$number = $_POST['number'];
$message = $_POST['message'];

$sms = new Sms($host, $user, $pass);
echo json_encode($sms->send($number, $message));