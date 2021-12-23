<template>
<html>
<head>
<title>Page Title</title>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

<input type="file" name="files" id="files" accept=".gpx"/><br/><br/>
<input type="submit" id="btnSubmitImportar" disabled/>

</body>
<div id="map" style="height: 90vh; width: 100vw;"></div>
</template>
<script>
function initMap(flightPlanCoordinatesRecived) {
	  const map = new google.maps.Map(document.getElementById("map"), {
	    zoom: 3,
	    center: { lat: 37.778194000, lng: -122.391226000 },
	    mapTypeId: "terrain",
	  });
	  if(flightPlanCoordinatesRecived == undefined){
	  		var flightPlanCoordinates = [
		  ];
		} else {
			console.log("Este String es el que capturas desde la BD");
			console.log(flightPlanCoordinatesRecived);
			var flightPlanCoordinates = [];
			var obj = JSON.parse(flightPlanCoordinatesRecived);
            var ind = 0;
            for (x of obj) {
              flightPlanCoordinates[ind]=new google.maps.LatLng(x.lat, x.lon);
              ind++;
            }

		}
	  const flightPath = new google.maps.Polyline({
	    path: flightPlanCoordinates,
	    geodesic: true,
	    strokeColor: "#FF0000",
	    strokeOpacity: 1.0,
	    strokeWeight: 2,
	  });
	  flightPath.setMap(map);
	}

	$("#files").change(function(){
          document.getElementById("btnSubmitImportar").disabled = false;
    });

    $("#btnSubmitImportar").click(function (event) {
    	const fileInput = document.getElementById('files');
		const selectedFile = fileInput.files[0];
		file = selectedFile.name;
		$.get(file, function(lines) {
	         callback(lines);
	      }, 'text');

		function callback(lines){
			var points = [];
			var point = {};
			var result = getFromBetween.get(lines,"<wpt ","><ele>");
			for (i=0;i<result.length;i++){
				lat = getFromBetween.get(result[i],"lat=\"","\"")[0];
				lon = getFromBetween.get(result[i],"lon=\"","\"")[0];
				point = {'lat': lat, 'lon': lon};
				points.push(point);
			}
			var jsonString = JSON.stringify(points);
			console.log("Este String es el que guardas en la BD");
			console.log(jsonString);
			initMap(jsonString);
		}
    });

	var getFromBetween = {
	    results:[],
	    string:"",
	    getFromBetween:function (sub1,sub2) {
	        if(this.string.indexOf(sub1) < 0 || this.string.indexOf(sub2) < 0) return false;
	        var SP = this.string.indexOf(sub1)+sub1.length;
	        var string1 = this.string.substr(0,SP);
	        var string2 = this.string.substr(SP);
	        var TP = string1.length + string2.indexOf(sub2);
	        return this.string.substring(SP,TP);
	    },
	    removeFromBetween:function (sub1,sub2) {
	        if(this.string.indexOf(sub1) < 0 || this.string.indexOf(sub2) < 0) return false;
	        var removal = sub1+this.getFromBetween(sub1,sub2)+sub2;
	        this.string = this.string.replace(removal,"");
	    },
	    getAllResults:function (sub1,sub2) {
	        if(this.string.indexOf(sub1) < 0 || this.string.indexOf(sub2) < 0) return;

	        var result = this.getFromBetween(sub1,sub2);
	        this.results.push(result);
	        this.removeFromBetween(sub1,sub2);

	        if(this.string.indexOf(sub1) > -1 && this.string.indexOf(sub2) > -1) {
	            this.getAllResults(sub1,sub2);
	        }
	        else return;
	    },
	    get:function (string,sub1,sub2) {
	        this.results = [];
	        this.string = string;
	        this.getAllResults(sub1,sub2);
	        return this.results;
	    }
	};
</script>