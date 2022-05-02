/*create array:*/
var marker = new Array();

/*Some Coordinates (here simulating somehow json string)*/
var items = [{"lat":"51.000","lon":"13.000"},{"lat":"52.000","lon":"13.010"},{"lat":"52.000","lon":"13.020"}];

/*pushing items into array each by each and then add markers*/
function itemWrap() {
for(i=0;i<items.length;i++){
    var LamMarker = new L.marker([items[i].lat, items[i].lon]);
    marker.push(LamMarker);
    map.addLayer(marker[i]);
    }
}

/*Going through these marker-items again removing them*/
function markerDelAgain() {
for(i=0;i<marker.length;i++) {
    map.removeLayer(marker[i]);
    }  
}






// Script for adding marker on map click
maps.on('click', onMapClick);

function onMapClick(e) {

    var geojsonFeature = {

        "type": "Feature",
        "properties": {},
        "geometry": {
                "type": "Point",
                "coordinates": [e.latlng.lat, e.latlng.lng]
        }
    }

    var marker;

    L.geoJson(geojsonFeature, {

        pointToLayer: function(feature, latlng){

            marker = L.marker(e.latlng, {

                title: "Resource Location",
                alt: "Resource Location",
                riseOnHover: true,
                draggable: true,

            }).bindPopup("<input type='button' value='Delete this marker' class='marker-delete-buttons'/>");

            marker.on("popupopen", onPopupOpen);

            return marker;
        }
    }).addTo(map);
}

function onPopupOpen() {

var tempMarker = this;

// To remove marker on click of delete button in the popup of marker
$(".marker-delete-button:visible").click(function () {
    map.removeLayer(tempMarker);
});

   }
/*Going through these marker-items again removing them*/
function markerDelAgain() {
for(i=0;i<marker.length;i++) {
    map.removeLayer(marker[i]);
    }  
}


$('.nav .dropdown').hover(function() {
	$(this).addClass('open');
}, function() {
	$(this).removeClass('open');
});