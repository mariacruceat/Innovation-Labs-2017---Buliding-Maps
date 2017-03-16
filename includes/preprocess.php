<?php
require_once('db_connect.php');
//require_once('config.php');

$res = $DBconn->query("SELECT name, value FROM site_settings");



$_SESSION["SETTINGS"] = array(
    "maintenance" => "true",
    "login" => "false",
    "register" => "false",
    "require_mail" => "false",
    "articles_per_page" => 15
);
if ($res->num_rows > 0){
    while($setting = $res->fetch_assoc())
        $_SESSION["SETTINGS"][$setting["name"]] = $setting["value"];
}

if ($_SESSION["SETTINGS"]["maintenance"] == "true"){
    header("Location: /maintenance.html");
    die();
}