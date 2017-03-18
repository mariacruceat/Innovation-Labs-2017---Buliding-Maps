 <?php
require_once('config.php');

$msg_display = $sql_message = '';
if (!isset($DBconn)) 
    $DBconn = new mysqli(SQL_COMPLETE_NAME,SQL_MASTER_USER,SQL_MASTER_PASS,SQL_DATABASE);
if ($DBconn)
    if($DBconn->connect_error)
    {
        $msg_display = "warning";
        $sql_message = "Database connection failed: " . $DBconn->connect_error;
        header("Location: ../error.php?t=Database error&d=There was a problem while trying to connect to the database.");
    }
    else
    {
        $msg_display = "Success";
        $sql_message = "Connected succesfully with database 'cidra_mainDB'";
    }