<?php
function autoLoad()
{
    error_reporting(E_ALL); //Error exception engine, siempre usar E_ALL
    ini_set("ignore_repeated_errors", TRUE);
    ini_set("display_errors", FALSE);
    ini_set("log_errors", TRUE);
    ini_set("error_log", "php-error.log");
    error_log("###########  INICIO DE APLICACION  ###########");
    error_log("##############################################");

    require_once("libs/database.php");
    require_once("classes/errormessages.php");
    require_once("classes/successmessages.php");
    require_once("libs/controller.php");
    require_once("libs/model.php");
    require_once("libs/view.php");
    require_once("classes/etc/session_controller.php");
    require_once("libs/app.php");
}

define("URLBASE", "https://portal-curricular.herokuapp.com");
define("BASETITLE", "Portal curricular");
define("USERDB", "b5c77f95f075d6");
define("PASSDB", "c143cf89");
define("HOSTDB", "us-cdbr-east-06.cleardb.net");
define("NAMEDB", "heroku_60415f786969d9d");
define("CHARSETDB", "utf8mb4");
