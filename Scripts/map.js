$( document ).ready(function() {
	$( "#mapContainer" ).load($_GET["map"] + '.svg', function(){
		$('#layer6').toggle(true);
	});
});

var $_GET = {};

document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
    function decode(s) {
        return decodeURIComponent(s.split("+").join(" "));
    }

    $_GET[decode(arguments[1])] = decode(arguments[2]);
});

document.write('debug: ' + 
		'<br>map ' +  $_GET["map"] +
		'<br>entrance ' +  $_GET["entrance"] +
		'<br>dest ' +  $_GET["dest"]);