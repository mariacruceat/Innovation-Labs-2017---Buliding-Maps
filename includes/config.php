<?php

date_default_timezone_set("Europe/Bucharest");

//4TjF83B9dwNj4aRu

/*NONE - no echo, only log;
DISPLAY - will show the error in a nice way using semantic's ui modal; 
FULL- display a <p> with the error when and where it occurs*/
define("DEBUG","NONE"); 
define("MAINTENANCE", FALSE);

$_SESSION["SETTINGS"] = array(
                "maintenance" => "true"
            );

//users
define("SQL_MASTER_USER","root");//sysOP
define("SQL_MASTER_PASS","");//rsxTY7GWZXrDTtPN

define("SQL_MANAGEMENT_USER","user_management"); //user_mg, character limit exceeded on server cidra.ga
define("SQL_MANAGEMENT_PASS","4TjF83B9dwNj4aRu");

define("SQL_READONLY_USER","readonly");
define("SQL_READONLY_PASS","yh9yWVphE49yXSCj");

define("SQL_SERVER_IP","localhost");
define("SQL_SERVER_PORT","3306");
define("SQL_COMPLETE_NAME",SQL_SERVER_IP . (SQL_SERVER_PORT == "" ? "":":" . SQL_SERVER_PORT));
define("SQL_DATABASE","Altf4MainDatabase");
    
define("CAN_REGISTER","any");
define("DEFAULT_ROLE","member");

define("SECURE",FALSE);