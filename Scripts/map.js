var $_GET = {};

document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
    function decode(s) {
        return decodeURIComponent(s.split("+").join(" "));
    }

    $_GET[decode(arguments[1])] = decode(arguments[2]);
});

//http://stackoverflow.com/a/3642265/1869660
function makeSVGElement(tag, attrs) {
    var el= document.createElementNS('http://www.w3.org/2000/svg', tag);
    for (var k in attrs) {
        el.setAttribute(k, attrs[k]);
    }
    return el;
}

var globalPath = [];
var t = 0;
var per = -0.02;
var listofpnts2 = [];

var distanceBetweenCircles = 1;
var timerPeriodMs = 50;
var timerIncrement = 5;
var perStep = 0.02; // 0 <= per <= 1
var pathLength;
var meters = 0;

$( document ).ready(function() {
	$("#mapContainer").click(function(){
		per += perStep;
	});
	
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
		
		var pnts = "";
		var listofpnts = [];
		jQuery.each(shortest, function(idx, val){
			var ch = 'L';
			if (idx == 0)
			{
				ch = 'M';
			}
			if (idx == shortest.length)
			{
				ch = 'Z';
			}
			var wayp = $('#' + val);
			pnts += ch + ' ' + wayp.attr("cx") + ' ' + wayp.attr("cy");
			var x = wayp.attr("cx");
			var y = wayp.attr("cy");
			listofpnts.push({ 'x' : x , 'y' : y});
		});
		var globalPath2 = $(document.createElementNS('http://www.w3.org/2000/svg','path')).attr({
		  d : pnts,
		  fill : 'none',
          'stroke-width': 2,
		  'stroke-dasharray': 2.5,
          //'stroke-dasharray': 50,
		  'stroke-linecap': 'round',
		  'stroke-opacity': 1,
		  stroke: 'red'
		 }).appendTo($("svg"));
		
		var lastp;
		jQuery.each(listofpnts, function(idx, val){
			if (idx != 0)
			{
				var mod = Math.sqrt(Math.pow( lastp.x - val.x, 2) + Math.pow( lastp.y - val.y, 2));
				var i;
				for (i = 0.0; i <= mod; i += distanceBetweenCircles)
				{
					var proc = i / mod;
					listofpnts2.push({ 'x' : lastp.x * (1 - proc) + val.x * proc, 'y' : lastp.y * (1 - proc) + val.y * proc });
				}
				i -= mod;
			}
			lastp = val;
		});
		pathLength = (listofpnts2.length * distanceBetweenCircles);
		console.log('pathLength ' + pathLength);
		
		var intervalID = setInterval(function(){
			//per = t / 100.0;
		    t += timerIncrement;
		    if (t > 100)
		    	t = 0;
		    var sliced = globalPath.slice(0, -10);
		    var i;
		    $(".removable").remove();
		    jQuery.each(listofpnts2, function(idx, val){
			var fillit = Math.abs(idx - (listofpnts2.length * per)) < 2;
			var filltype = 'none';
			if (fillit)
			{
				filltype = '#0f0';
				var el = $(document.createElementNS('http://www.w3.org/2000/svg','circle')).attr({
				  class : 'removable',
				  cx : val.x,
				  cy : val.y,
				  r : 5,
				  fill : filltype,
		          //'stroke-dasharray': 50,
				  'stroke-linecap': 'round',
				  'stroke-opacity': 0,
				  stroke: 'red'
				 });
				$("svg").append(el);
			}
		});
		}, timerPeriodMs);
	});
});
function onMeterChange(meters)
{
	per += perStep;
}
