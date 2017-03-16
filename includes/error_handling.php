<?php
include_once("config.php");
if (MAINTENANCE === TRUE)   
{
        header("Location: /maintenance.html");
        die();
}
$GLOBALS["logfile"] = fopen("log.txt","a");
$GLOBALS["fullLog"] = "";

function error_min($error_level,$error_message,$error_line, $err_context) {
    if ($error_level > 2000)
        die("Fatal runtime error");
}
    
//custom error handler
function error_debug($error_level,$error_message,$error_context, $error_line) {
    $err = "<p style='font-weight: bold; text-align:center; color:";
    $errMsg = "";
    $color = "red";
    $end = FALSE;
    switch ($error_level)
    {
        case 2: {
            $errMsg = "Warning ";
            $color = "#d7d700";
            break;
        }
        case 8: {
            $errMsg = "Message ";
            $color = "#3366ff";
            break;
        }
        case 256:
        case 512:
        case 1024: {
                $errMsg = "USER_ERROR ";
                $color = "#3366ff";
                break;
        }
        default: {
            $errMsg = "Fatal error ";
            $end = TRUE;
            break;
        }

    }
    $errMsg .= "($error_level): $error_message ( in $error_context at line $error_line  )";
    $errDisplay = "$err $color;'> $errMsg </p>" . ($end?"<p style='color:red'>Ending script</p>":"");
    if ($end)
        echo $errDisplay;
    else
    {
        if(DEBUG === "FULL")
            echo $errDisplay;
        else
            $GLOBALS["fullLog"] .= $errDisplay;
    }
    fwrite($GLOBALS["logfile"],"\r\n[" . date("h:m - d:m:y") . " ip:" . $_SERVER["REMOTE_ADDR"] . "] " . $errMsg);
    if ($end) die();
}
set_error_handler("error_debug");

function push_log($text)
{
    $GLOBALS['fullLog'] .= '<p>' . $text . '</p>';
}