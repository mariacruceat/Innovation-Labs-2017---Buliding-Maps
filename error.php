<?php
    if (!isset($_GET['d']))
    {
        header('Location: /');
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
	    <title><?php echo (!isset($_GET['t'])?'Error!':$_GET['t']); ?></title>
        <meta charset="utf-8" />
        <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	    <link rel="stylesheet" type="text/css" href="/stylesheets/error.css"/>
    </head>
    <body>
	    <article>
	        <h1><?php echo (!isset($_GET['t'])?'Error!':$_GET['t']); ?></h1>
	        <div>
	            <p><?php echo $_GET['d']?></p>
                <p>If this error persists please complete <a href="http://goo.gl/forms/abMgSxxKoD">this form</a>.</p>
	            <p>&mdash; Cidra - Circa Dragos</p>
	        </div>
        </article>
    </body>
</html>
</article>