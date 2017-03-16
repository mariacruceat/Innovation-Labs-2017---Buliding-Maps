<?php
	require_once('includes/db_connect.php');
	include('includes/error_handling.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include_once('includes\header.php'); ?>
<script>
	var startVal;
	var destVal;
	var $_GET = {};

	document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
	    function decode(s) {
	        return decodeURIComponent(s.split("+").join(" "));
	    }

	    $_GET[decode(arguments[1])] = decode(arguments[2]);
	});

	$(document).ready(
			function() {
				$('.ui.dropdown').dropdown(
						{
							onChange : function(value, text) {
								if ($(this).attr('id') == "start")
									startVal = value;
								if ($(this).attr('id') == "dest")
									destVal = value;
								if (startVal != undefined
										&& destVal != undefined) {
									var link = document.createElement('a');
									link.href = "map.html?map=Waypoints&start="
											+ startVal + "&dest=" + destVal;
									document.body.appendChild(link);
									link.click();
								}
							}
						});
				var s = $("div[data-slide='" + $_GET["start"] + "']");
				$("#start").dropdown("set selected", $_GET["start"]);
				$("#start").dropdown("set value", s.html());
				var d = $("div[data-slide='" + $_GET["dest"] + "']");
				$("#dest").dropdown("set selected", $_GET["dest"]);
				$("#dest").dropdown("set value", d.html());
				$('.ui.dropdown').dropdown('refresh');
			});
</script>
<title>Welcome</title>
<meta charset="utf-8" />
<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<style>
body {
	text-align: center;
	padding-top: 150px;
}

@media only screen and (max-width: 700px) {
	body {
		padding-top: 50px;
	}
}

@media only screen and (max-width: 400px) {
	body {
		padding-top: 0px;
	}
}

h1{
	font-size: 2.5em;
	margin: auto;
	text-align: center;
}
h2 {
	font-size: 2em;
	text-decoration: underline;
}

body {
	font: 1.6em Helvetica, sans-serif;
	color: #333;
}

article {
	display: block;
	text-align: left;
	max-width: 650px;
	margin: 0 auto;
}
p {
	margin: auto;
	text-align: center;
	padding-bottom: 1em;
}
a, span {
	color: #dc8100;
	text-decoration: none;
}
</style>
</head>
<body>
	<article>
		<h1>Welcome</h1>
		<div>
			<p>
				Choose where you want to go.
			</p>
		</div>
		<section style="margin: auto; align-items: center;">
			<div id="start" class="ui selection dropdown" style="display: block;">
				<input type="hidden">
				<div class="default text">Start</div>
				<i class="dropdown icon"></i>
				<div class="menu">
					<div class="item" data-value="start">Intrare</div>
					<div class="item" data-value="ie101">Carne</div>
					<div class="item" data-value="ie102">Paine</div>
					<div class="item" data-value="ie104">Legume</div>
					<div class="item" data-value="ie105">Dulciuri</div>
					<div class="item" data-value="butean">Lapte</div>
					<div class="item" data-value="wcm">Bere</div>
					<div class="item" data-value="wcf">Apa</div>
					<div class="item" data-value="ie111">Fructe</div>
					<div class="item" data-value="ie112">Detergent</div>
					<div class="item" data-value="ie113">Altele</div>
				</div>
			</div>

			<div id="dest" class="ui selection dropdown" style="display: block;">
				<input type="hidden">
				<div class="default text">Destinatie</div>
				<i class="dropdown icon"></i>
				<div class="menu">
					<div class="item" data-value="start">Intrare</div>
					<div class="item" data-value="ie101">Carne</div>
					<div class="item" data-value="ie102">Paine</div>
					<div class="item" data-value="ie104">Legume</div>
					<div class="item" data-value="ie105">Dulciuri</div>
					<div class="item" data-value="butean">Lapte</div>
					<div class="item" data-value="wcm">Bere</div>
					<div class="item" data-value="wcf">Apa</div>
					<div class="item" data-value="ie111">Fructe</div>
					<div class="item" data-value="ie112">Detergent</div>
					<div class="item" data-value="ie113">Altele</div>
				</div>
			</div>
		</section>
	</article>
	<article>
		<h2>Dev tools</h2>
		<a href="map-editor.php"><div class="ui button">Map editor</div></a>
	</article>
	<?php include_once('includes\footer.php'); ?>
</body>
</html>
