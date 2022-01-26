
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue';
import vSelect from 'vue-select';
import Datepicker from 'vuejs-datepicker';
import * as VueGoogleMaps from 'vue2-google-maps'
import excel from 'vue-excel-export' 



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('categoria', require('./components/Categoria.vue'));
Vue.component('articulo', require('./components/Articulo.vue'));
Vue.component('cliente', require('./components/Cliente.vue'));
Vue.component('productor', require('./components/Productor.vue'));
Vue.component('rol', require('./components/Rol.vue'));
Vue.component('user', require('./components/User.vue'));
Vue.component('finca', require('./components/Finca.vue'));
Vue.component('cultivo', require('./components/Cultivo.vue'));
Vue.component('categoriamora', require('./components/categoriaMora.vue'));
Vue.component('v-select', vSelect);
Vue.component('v-datepicker', Datepicker);
Vue.component('venta', require('./components/Venta.vue'));
Vue.component('lugarventa', require('./components/LugarVenta.vue'));
Vue.component('encuestafitosanitaria', require('./components/EncuestaFitosanitaria.vue'));
Vue.component('visita', require('./components/EncuestaAsofrut.vue'));
Vue.component('cosecha', require('./components/Cosecha.vue'));
Vue.component('predio', require('./components/PredioCultivo.vue'));
Vue.component('poda', require('./components/Poda.vue'));
Vue.component('plaga', require('./components/Plaga.vue'));
Vue.component('nutricion', require('./components/Nutricion.vue'));
Vue.component('tutorado', require('./components/Tutorado.vue'));
Vue.component('riego', require('./components/Riego.vue'));
Vue.component('practica', require('./components/Practica.vue'));
Vue.component('enfermedad', require('./components/Enfermedad.vue'));
Vue.component('vocacion', require('./components/Vocacion.vue'));
Vue.component('suelo', require('./components/Suelo.vue'));
Vue.component('dashboard', require('./components/Dashboard.vue'));
Vue.component('gpx', require('./components/GpxUpload.vue'));
Vue.component('fitosanitario', require('./components/ProductoFitosanitario.vue'));
Vue.component('backup', require('./components/Backup.vue'));
Vue.component('gpxzone', require('./components/GpxZone.vue'));
Vue.component('gastos', require('./components/GastosEstablecimiento.vue'));
Vue.component('adecuacion', require('./components/GastosAdecuacion.vue'));
Vue.component('produccion', require('./components/GastosProduccion.vue'));
Vue.component('resumen', require('./components/Resumen.vue'));
Vue.component('aplicacionq', require('./components/AplicacionQuimico.vue'));
Vue.component('fertilizante', require('./components/ProductoFertilizante.vue'));


//Vistas Productor
Vue.component('fincaproductor', require('./components/FincaProductor.vue'));
Vue.component('productorpro', require('./components/ProductorPro.vue'));
Vue.component('cultivoproductor', require('./components/CultivoProductor.vue'));
Vue.component('ventaproductor', require('./components/VentaProductor.vue'));

//Vistas Tecnico
Vue.component('ventatecnico', require('./components/VentaTecnico.vue'));

//Vista Contador
Vue.component('ventacontador', require('./components/VentaContador.vue'));
Vue.component('gmap',require('./components/gmap.vue'));
const app = new Vue({
    el: '#app',
    data:{
        menu:0
    }
});

Vue.use(VueGoogleMaps, {
    load: {
      key: 'AIzaSyC0E8xMKzvXrCY0_OyX1ODMEkIs8fSXy6Q',
      libraries: 'places', // This is required if you use the Autocomplete plugin
      // OR: libraries: 'places,drawing'
      // OR: libraries: 'places,drawing,visualization'
      // (as you require)
   
      //// If you want to set the version, you can do so:
      // v: '3.26',
    },
    installComponents: true
    });

Vue.use(excel);    