<template>
<GmapMap
      :center="{lat:2.954829514, lng:-76.269498922}"
      :zoom="15"
      map-type-id="roadmap"
      style="width: 100%; height: 500px" 
      id="googleMap"
    >
        <GmapMarker
            :key="index"
            v-for="(m, index) in  getMarkers()"
           :position="m.position"
            :clickable="true"
            :draggable="false"
            :title="m.title"
            :icon="m.icon"
            @click="clicked()"
        >
        </GmapMarker>

        <gmap-polygon v-for="linea in arrayZonas" :key="linea.id"
         :paths="JSON.parse(linea.linea)">
         </gmap-polygon>
    </GmapMap>
</template>
<script>
export default {
   data(){
            return{
                gps_id:0,
                productor_id:0,
                finca_id:0,
                nombre_productor:'',
                nombre_finca:'',
                latitud:0,
                longitud:0,              
                arrayGps:[],
                arrayPuntos : [],
                arrayZonas:[],
                arrayLinea:[],
                arrayPrueba:[]
            }
        },
  name: "SiteMap",
  props: [],
  methods: {   
    getOptions() {
      return {
        zoomControl: true,
        mapTypeControl: true,
        scaleControl: false,
        streetViewControl: true,
        rotateControl: false,
        fullscreenControl: false,
        disableDefaultUi: false
      };
    },
    clicked() {
     // after click
    },
    getCenter() {     
          return {
            lat: 2.954829514,
            lng: -76.269498922
          };
    },
    getMarkers() {
       let me =this;
       var url ='gps';
        axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayGps= respuesta.gps;
                    me.arrayPuntos= me.arrayGps['data'];
                })
                .catch(function (error) {
                    console.log(error);
                });
      // generating markers for site map
        var markers = [];
        // remove this after lat long received from api.
        const tempLatLong = [
          { lat: 2.954829514, lng:-76.269498922},
          { lat: 2.964829514, lng:-76.279498922}
        ];

        
       for(let i=0;i<me.arrayPuntos.length;i++){
          markers.push({
              position:  { lat: parseFloat(me.arrayGps['data'][i]['latitud']), lng:parseFloat(me.arrayGps['data'][i]['longitud'])},
              title:me.arrayGps['data'][i]['nombre_finca'],
              icon:'img/icono_puntero.ico',        
            });
        }
        return markers;      
    },
    getPolygons() {
       let me =this;
       var url ='gpxzones';
        axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayZonas= respuesta.gps;
                    //me.arrayPrueba = [{lat:3.4298101533 ,lng: -76.5247765370},{lat:3.4298083931 ,lng: -76.5247526485},{lat:3.4298121650 ,lng: -76.5247606952},{lat:3.4298414178 ,lng: -76.5247724298}];
                    //me.arrayPrueba=  [{ lat: 3.429555, lng:-76.524206},
                    //                  { lat: 3.429565, lng:-76.524216}];
                    //var temp = '';
                    //temp = (me.arrayZonas[0]['linea']);
                    //for (let i = 0; i < me.arrayZonas.length; i++) {
                      //  me.arrayLinea[i] = $.parseJSON(me.arrayZonas[i]['linea']);
                      //  }
                    //me.arrayLinea= $.parseJSON(temp);
                    //console.log(me.arrayLinea);
                   //var flightPlanCoordinates = [];
          
                   //var ind = 0;
                   //for (let x of me.arrayLinea) {
                   //flightPlanCoordinates[ind]=new google.maps.LatLng(x.lat, x.lng);
                   //ind++;
                    //}
            //console.log(flightPlanCoordinates);

                })
                .catch(function (error) {
                    console.log(error);
                });   
    },
  },
  components: {},
  created() {},
  mounted() {
    this.getPolygons();
  }
};
</script>