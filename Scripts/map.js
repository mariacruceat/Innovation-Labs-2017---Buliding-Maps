var $_GET = {};

document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
    function decode(s) {
        return decodeURIComponent(s.split("+").join(" "));
    }

    $_GET[decode(arguments[1])] = decode(arguments[2]);
});

$( document ).ready(function() {
	$( "#mapContainer" ).load($_GET["map"] + '.svg', function(){
		console.log('debug: ' +
				'<br>wp ' + JSON.stringify(wp));

	    var graph = new Graph(wp);
		var shortest = graph.findShortestPath($_GET["start"], $_GET["dest"]);
		
		console.log('debug: ' +
		'<br>map ' +  $_GET["map"] +
		'<br>start ' +  $_GET["start"] +
		'<br>dest ' +  $_GET["dest"] + 
		'<br>shortestpath: ' + shortest);
		
		var last = null;
		jQuery.each(shortest, function(idx, val){
			if (last != null) {
				var firstWay = $('#' + last);
				var secondWay = $('#' + val);
			$(document.createElementNS('http://www.w3.org/2000/svg','line')).attr({
			  x1:firstWay.attr("cx"),
			  y1:firstWay.attr("cy"),
			  x2:secondWay.attr("cx"),
			  y2:secondWay.attr("cy"),
			  'stroke-width': 2,
			  'stroke-dasharray': 2.5,
			  'stroke-linecap': 'round',
			  stroke: 'red'
			  }).appendTo($("svg"));
			}
			last = val;
		});
	});
});
