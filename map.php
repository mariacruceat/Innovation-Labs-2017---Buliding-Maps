<?php
	require_once('includes/db_connect.php');
	include('includes/error_handling.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <?php require_once('/includes/header.php');?>
        <script type="application/javascript" src="js/waypoints.js"></script>
        <script type="application/javascript" src="js/graph.js"></script>
        <script src="addons/shake.js"></script>
        <script type="application/javascript" src="js/map.js"></script>
        <link href="stylesheets/base.css" type="stylesheets"/>
    </head>
<body>
    <h1 style="text-align: center; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif" class="exec">Building maps v 1.2.2</h1>
    <button style="display: block" id="toggleAutoBtn">Auto</button>
    <div id="mapContainer"></div>
    <?php include_once('includes\footer.php'); ?>
</body>
</html>