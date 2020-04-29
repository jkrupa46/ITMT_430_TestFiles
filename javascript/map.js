/*Robert Bacius
 *John Collins
 *Jacob Krupa
 *Andy Kukuc
 *Geldi Omeri
 */
//Here we will ask the user for current information\

//Here the code will be housed for the maps page.

mapboxgl.accessToken='pk.eyJ1IjoiYWt1a3VjIiwiYSI6ImNrNmt3MWZxcjA1anEzam4wOWNxeTgzaGgifQ.og9fg35Kib4vh_bdF4JUOg';
var map=new mapboxgl.Map({
  container:'map',
  style:'mapbox://styles/akukuc/ck6kw1ynk14km1ima516zne9q',
  center:[-94.4247,40.51073],
  zoom:3.25
});
map.addControl(
  new mapboxgl.GeolocateControl({
  positionOptions:{
    enableHighAccuracy:true
  },
  trackUserLocation:true
})
);

var geojson = {
  type: 'FeatureCollection',
  features: [{
    type: 'Feature',
    geometry: {
      type: 'Point',
      coordinates: [-87.6,41.8]
    },
    properties: {
      title: 'Mapbox',
      description: 'Chicago, Illinois'
    }
  },
  {
    type: 'Feature',
    geometry: {
      type: 'Point',
      coordinates: [-122.414, 37.776]
    },
    properties: {
      title: 'Mapbox',
      description: 'San Francisco, California'
    }
  }]
};

// add markers to map
geojson.features.forEach(function(marker) {

  // create a HTML element for each feature
  var el = document.createElement('div');
  el.className = 'marker';

  // make a marker for each feature and add to the map
  new mapboxgl.Marker(el)
    .setLngLat(marker.geometry.coordinates)
    .addTo(map);
});

/*Not functional right now*/
new mapboxgl.Marker(el)
  .setLngLat(marker.geometry.coordinates)
  .setPopup(new mapboxgl.Popup({ offset: 25 }) // add popups
    .setHTML('<h3>' + marker.properties.title + '</h3><p>' + marker.properties.description + '</p>'))
  .addTo(map);

