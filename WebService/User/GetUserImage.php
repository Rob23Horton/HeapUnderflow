<?php

header('Content-Type: application/json; charset=utf-8');

if (!isset($_GET["user_id"]))
{
    include($_SERVER['DOCUMENT_ROOT']."/scripts/BadRequest.php");
}

$user_id = $_GET["user_id"];

include_once($_SERVER["DOCUMENT_ROOT"]."/scripts/connection.php");

if ($conn == null)
{
    include($_SERVER['DOCUMENT_ROOT']."/scripts/BadRequest.php");   
}

include_once($_SERVER["DOCUMENT_ROOT"]."/scripts/UserInfoFunctions.php");
$user_image_id = GetProfileImageCodeFromUserCode($conn, $user_id);


echo '{ "image_id":' . $user_image_id . ' }';



?>