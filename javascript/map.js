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
  center:[-92,38],
  zoom:3.5
});
map.addControl(
  new mapboxgl.GeolocateControl({
  positionOptions:{
    enableHighAccuracy:true
  },
  trackUserLocation:true
})
);
