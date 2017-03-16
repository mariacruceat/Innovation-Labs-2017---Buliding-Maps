<?php
	require_once('includes/db_connect.php');
	include('includes/error_handling.php');
?>
<!doctype html>
<html encoding="UTF-8" lang="en">
    <head>
        <title>Map editor</title>
        <?php require_once('includes/header.php');?>
        <script type="application/javascript" src="js/graph.js"></script>
        <script type="application/javascript" src="js/editor.js"></script>
        <link rel="stylesheet" type="text/stylesheet" href="stylesheets/editor.css"/>
    </head>
    <body>
        <div class="ui padded grid">
            <div class="eight wide column">
                <div id="floorplan-container">

                </div>
            </div>
            <div class="eight wide column">
                <h2 class="ui centered top attached header">
                    Debug info
                </h2>
                <div id="debugInfo" class="ui attached segment">
                    <div id="testBtn" class="ui button">Do the thing</div>
                </div>
            </div>
        </div>
        <?php include_once('includes\footer.php'); ?>
    </body>
</html>