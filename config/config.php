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

#define("BASETITLE", "Portal curricular");
#define("URLBASE", "http://localhost");
#define("USERDB", "root");
#define("PASSDB", "");
#define("HOSTDB", "localhost");
#define("NAMEDB", "test");
define("BASETITLE", "Portal curricular");
define("URLBASE", "http://localhost");
define("USERDB", "kjbjoiuszzve1ph1");
define("PASSDB", "hrmtv8naal552pxa");
define("HOSTDB", "lcpbq9az4jklobvq.cbetxkdyhwsb.us-east-1.rds.amazonaws.com");
define("NAMEDB", "inyz5u2ef0mbxjiq");

define("CHARSETDB", "utf8mb4");
