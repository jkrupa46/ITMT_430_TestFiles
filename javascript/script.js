/*Robert Bacius
 *John Collins
 *Jacob Krupa
 *Andy Kukuc
 *Geldi Omeri
 */

//Script that executes the vanta stuff
VANTA.NET({
  el: "#vantajs",
  mouseControls: true,
  touchControls: true,
  minHeight: 200.00,
  minWidth: 200.00,
  scale: 1.00,
  scaleMobile: 1.00,
  color: 0x735aef,
  backgroundColor: 0xa0218,
  points: 20.00
})

//Functions for the beacons
var time1=new Date;
var today=time1.getTime();
var buffer=today-270000;
const fetch=require("node-fetch");
const btoa=require('btoa');
global.Headers=fetch.Headers;
let headers = new Headers();
let base64=require('base64-js');
let username='logistics-tracking-ayz';
let password='70210f093ae4df7947b8ccfe4a8181a8';
let authString=`${username}:${password}`
//idenfier for blue 9b863659fd9527ba6b18e62262a4ae11
//let url_green='https://cloud.estimote.com/v3/lte/device_events?identifier=d784a2665ab1f35079bcec89588d5d1d&';
let url_both_info_app='https://cloud.estimote.com/v3/lte/device_events?app_id=yjFaxdjn4z&app_release=0&since='+buffer;
console.log(url_both_info_app);
headers.set('Authorization', 'Basic '+btoa(authString));

var accelerometer;
var device_id;
var temperature;
var rounded;

fetch(url_both_info_app,{method:'GET',headers:headers})
//.then(function(response){console.log(response)return response})
  .then((response)=>{
    return response.json();
  })
  .then(data=>{
    const data2=JSON.stringify(data,null,2);
    console.log(data2);
    //const data_element=data2[];
    data.data.forEach((metadata)=>{
      //var current_time=data.payload.time;
      //var myDate=new Date(current_time);
      //console.log(myDate.toLocaleString());
      accelerometer=metadata.payload.acc;
      device_id=metadata.device_identifier;
      temperature=metadata.payload.temperature;
      var convereted_temperature=(temperature*9/5)+32;
      rounded=Math.round(convereted_temperature*100)/100;
      //console.log(accelerometer);
      //console.log(device_id);
      console.log(device_id+" "+rounded+" Fahrenheit");
    })
  });
