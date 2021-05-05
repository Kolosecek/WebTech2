<?php
require_once "classes/Database.php";

$type = $_REQUEST["type"];

if ($type == "logout")
{
    session_start();
    $_SESSION = array();
    session_destroy();
    echo "../skuska/index.php";
}
