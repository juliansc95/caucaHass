<template>
           <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Control Plagas
                        <button type="button" @click="abrirModal('plaga','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                         <export-excel
                            class   = "button btn btn-success"
                            :data   = arrayPlagaEx
                            worksheet = "Plaga"
                            name    = "plaga.xls">
                            Excel
                            </export-excel>
                            <export-excel
                            class   = "button btn btn-success"
                            :data   = arrayPlagaEx
                            type="csv"
                            name    = "plaga.xls">
                            csv
                        </export-excel>
                        <button type="button" @click="cargarPdf()" class="btn btn-info">
                            <i class="icon-doc"></i>&nbsp;PDF
                    </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="personas">Productor</option>
                                      
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarPlaga(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarPlaga(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div class='table-responsive'>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Detalle</th>
                                    <th>Productor</th>
                                    <th>Finca</th>
                                    <th>Monitoreo Plagas</th>
                                    <th>Perla de Tierras</th>
                                    <th>Barrenador en el cultivo</th>
                                    <th>Trips en el cultivo</th>
                                    <th>Afidios o pulgones</th>
                                    <th>Presencia Acaros</th>
                                    <th>Cochinilla</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr v-for="plaga in arrayPlaga" :key="plaga.id">
                                    <td>
                                        <button type="button" @click="abrirModal('plaga','actualizar',plaga)" class="btn btn-warning btn-sm">
                                          <i class="icon-eye"></i>
                                        </button> &nbsp;
                                    </td> 
                                    <td v-text="plaga.nombre"></td>
                                    <td v-text="plaga.nombre_finca"></td> 
                                    <td v-text="plaga.monitoreo"></td> 
                                    <td v-text="plaga.perlaTierra"></td> 
                                    <td v-text="plaga.barrenadorCultivo"></td> 
                                    <td v-text="plaga.tripsCultivo"></td> 
                                    <td v-text="plaga.afidiosCultivos"></td>  
                                    <td v-text="plaga.acarosCultivos"></td>
                                    <td v-text="plaga.cochinillaCultivos"></td>                                     
                                </tr>
                            </tbody>
                        </table>
                        </div>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1"> 
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page==isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar':modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg"  role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Productor</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="productor_id" @click="selectFinca(productor_id)" @change="selectFinca(productor_id)">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="productor in arrayProductor" :key="productor.id" :value="productor.id" v-text="productor.nombre" ></option>
                                      </select>  
                                    </div>
                                </div>                                  
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Finca</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="finca_id">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option v-for="finca in arrayFinca" :key="finca.id" :value="finca.id" v-text="finca.nombre" ></option>
                                      </select>  
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Realiza monitoreo de plagas</label>
                                    <div class="col-md-3">
                                      <select class="form-control" v-model="monitoreo">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                    <label class="col-md-3 form-control-label" for="text-input">Frecuencia Aplicacion(Meses)</label>
                                    <div class="col-md-3">
                                       <input type="number" v-model="frecuenciaMonitoreo"  class="form-control" placeholder="">
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Presencia de perla de tierra</label>
                                    <div class="col-md-2">
                                      <select class="form-control" v-model="perlaTierra">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                    <label class="col-md-2 form-control-label" for="text-input">Tipo de Manejo</label>
                                    <div class="col-md-2">
                                      <select class="form-control" v-model="tipoManejoPerla">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Trampas">Trampas</option>
                                            <option value="Biologicos">Biologicos</option>
                                            <option value="Biopreparados">Biopreparados</option>
                                            <option value="Caldos minerales">Caldos minerales</option>
                                            <option value="Agroquimicos">Agroquimicos</option>
                                      </select>
                                    </div> 
                                    <label class="col-md-2 form-control-label" for="text-input">Frecuencia Aplicacion(Meses)</label>
                                    <div class="col-md-2">
                                       <input type="number" v-model="frecuenciaAplicacionPerla"  class="form-control" placeholder="">
                                    </div>
                                </div>     
                                       

                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Presencia de barrenador en el cultivo</label>
                                    <div class="col-md-2">
                                      <select class="form-control" v-model="barrenadorCultivo">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                    <label class="col-md-2 form-control-label" for="text-input">Tipo de Manejo</label>
                                    <div class="col-md-2">
                                      <select class="form-control" v-model="tipoManejoBarrenador">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Trampas">Trampas</option>
                                            <option value="Biologicos">Biologicos</option>
                                            <option value="Biopreparados">Biopreparados</option>
                                            <option value="Caldos minerales">Caldos minerales</option>
                                            <option value="Agroquimicos">Agroquimicos</option>
                                      </select>
                                    </div> 
                                    <label class="col-md-2 form-control-label" for="text-input">Frecuencia Aplicacion(Meses)</label>
                                    <div class="col-md-2">
                                       <input type="number" v-model="frecuenciaAplicacionBarrenador"  class="form-control" placeholder="">
                                    </div>
                                </div> 

                                 <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Presencia de trips en el cultivo</label>
                                    <div class="col-md-2">
                                      <select class="form-control" v-model="tripsCultivo">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                    <label class="col-md-2 form-control-label" for="text-input">Tipo de Manejo</label>
                                    <div class="col-md-2">
                                      <select class="form-control" v-model="tipoManejoTrips">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Trampas">Trampas</option>
                                            <option value="Biologicos">Biologicos</option>
                                            <option value="Biopreparados">Biopreparados</option>
                                            <option value="Caldos minerales">Caldos minerales</option>
                                            <option value="Agroquimicos">Agroquimicos</option>
                                      </select>
                                    </div> 
                                    <label class="col-md-2 form-control-label" for="text-input">Frecuencia Aplicacion(Meses)</label>
                                    <div class="col-md-2">
                                       <input type="number" v-model="frecuenciaAplicacionTrips"  class="form-control" placeholder="">
                                    </div>
                                </div> 

                                 <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Presencia de Afidios o pulgones en el cultivo</label>
                                    <div class="col-md-2">
                                      <select class="form-control" v-model="afidiosCultivos">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                    <label class="col-md-2 form-control-label" for="text-input">Tipo de Manejo</label>
                                    <div class="col-md-2">
                                      <select class="form-control" v-model="tipoManejoAfidios">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Trampas">Trampas</option>
                                            <option value="Biologicos">Biologicos</option>
                                            <option value="Biopreparados">Biopreparados</option>
                                            <option value="Caldos minerales">Caldos minerales</option>
                                            <option value="Agroquimicos">Agroquimicos</option>
                                      </select>
                                    </div> 
                                    <label class="col-md-2 form-control-label" for="text-input">Frecuencia Aplicacion(Meses)</label>
                                    <div class="col-md-2">
                                       <input type="number" v-model="frecuenciaAplicacionAfidios"  class="form-control" placeholder="">
                                    </div>
                                </div> 

                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Presencia Ácaros en el cultivo</label>
                                    <div class="col-md-2">
                                      <select class="form-control" v-model="acarosCultivos">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                    <label class="col-md-2 form-control-label" for="text-input">Tipo de Manejo</label>
                                    <div class="col-md-2">
                                      <select class="form-control" v-model="tipoManejoAcaros">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Trampas">Trampas</option>
                                            <option value="Biologicos">Biologicos</option>
                                            <option value="Biopreparados">Biopreparados</option>
                                            <option value="Caldos minerales">Caldos minerales</option>
                                            <option value="Agroquimicos">Agroquimicos</option>
                                      </select>
                                    </div> 
                                    <label class="col-md-2 form-control-label" for="text-input">Frecuencia Aplicacion(Meses)</label>
                                    <div class="col-md-2">
                                       <input type="number" v-model="frecuenciaAplicacionAcaros"  class="form-control" placeholder="">
                                    </div>
                                </div> 
                                   <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Presencia Cochinilla en el cultivo</label>
                                    <div class="col-md-2">
                                      <select class="form-control" v-model="cochinillaCultivos">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                    <label class="col-md-2 form-control-label" for="text-input">Tipo de Manejo</label>
                                    <div class="col-md-2">
                                      <select class="form-control" v-model="tipoManejoCochinilla">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Trampas">Trampas</option>
                                            <option value="Biologicos">Biologicos</option>
                                            <option value="Biopreparados">Biopreparados</option>
                                            <option value="Caldos minerales">Caldos minerales</option>
                                            <option value="Agroquimicos">Agroquimicos</option>
                                      </select>
                                    </div> 
                                    <label class="col-md-2 form-control-label" for="text-input">Frecuencia Aplicacion(Meses)</label>
                                    <div class="col-md-2">
                                       <input type="number" v-model="frecuenciaAplicacionCochinilla"  class="form-control" placeholder="">
                                    </div>
                                </div> 
                             

                                <div v-show="errorPlaga" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjPlaga" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarPlaga()">Guardar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
        </main>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
import vSelect from 'vue-select';
    export default {
        data(){
            return{
                plaga_id:0,
                productor_id:0,
                finca_id:0,
                monitoreo:'Seleccione', 
                frecuenciaMonitoreo:0,
                perlaTierra:'Seleccione', 
                tipoManejoPerla:'Seleccione',
                frecuenciaAplicacionPerla:0, 
                barrenadorCultivo:'Seleccione',
                tipoManejoBarrenador:'Seleccione',
                frecuenciaAplicacionBarrenador:0,
                tripsCultivo:'Seleccione',
                tipoManejoTrips:'Seleccione',
                frecuenciaAplicacionTrips:0,
                afidiosCultivos:'Seleccione',
                tipoManejoAfidios:'Seleccione', 
                frecuenciaAplicacionAfidios:0,            
                acarosCultivos:'Seleccione', 
                tipoManejoAcaros:'Seleccione',
                frecuenciaAplicacionAcaros:0, 
                cochinillaCultivos:'Seleccione',
                tipoManejoCochinilla:'Seleccione',
                frecuenciaAplicacionCochinilla:0,
                arrayPlaga: [],
                arrayPlagaEx: [],
                modal: 0,
                tituloModal : '',
                tipoAccion:0,
                errorPlaga : 0,
                errorMostrarMsjPlaga:[],
                pagination:{
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset:3,
                criterio: 'personas',
                buscar: '',
                arrayProductor : [],
                arrayFinca : []                  
            }
        },
        computed:{
            isActived:function(){
                return this.pagination.current_page;
            },
            pagesNumber:function(){
                if(!this.pagination.to){
                    return [];
                }
                var from = this.pagination.current_page - this.offset;
                if(from < 1){
                    from=1;
                }
                var to = from + (this.offset * 2);
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }
                var pagesArray=[];
                while(from <= to){
                    pagesArray.push(from);
                    from ++;
                }
                return pagesArray;
            }

        },
        methods: {
            listarPlaga(page,buscar,criterio){
                let me =this;
                var url ='plaga?page='+page + '&buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayPlaga= respuesta.plagas.data;
                    me.pagination=respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
             listarPlagaEx(){
                let me =this;
                var url ='plaga/excel';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayPlagaEx= respuesta.plagas;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectProductor(){
                let me =this;
                var url ='productor/selectProductor';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayProductor= respuesta.personas;
                })
                .catch(function (error) {
                    console.log(error);
                })
            },
            selectFinca(id){
                let me =this;
                var url ='finca/selectFinca/'+id;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayFinca= respuesta.fincas;
                })
                .catch(function (error) {
                    console.log(error);
                })
            },          
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza a la pagina actual
                me.pagination.current_page = page;
                //Envia la peticion para visualizar la data de esa pagina
                me.listarPlaga(page,buscar,criterio);
            },
            registrarPlaga(){
            if(this.validarPlaga()){
                return;
            }
            let me=this;
            axios.post('plaga/registrar',{
                'productor_id':this.productor_id,
                'finca_id':this.finca_id,
                'monitoreo':this.monitoreo, 
                'frecuenciaMonitoreo':this.frecuenciaMonitoreo,
                'perlaTierra':this.perlaTierra, 
                'tipoManejoPerla':this.tipoManejoPerla,
                'frecuenciaAplicacionPerla':this.frecuenciaAplicacionPerla, 
                'barrenadorCultivo':this.barrenadorCultivo,
                'tipoManejoBarrenador':this.tipoManejoBarrenador,
                'frecuenciaAplicacionBarrenador':this.frecuenciaAplicacionBarrenador,
                'tripsCultivo':this.tripsCultivo,
                'tipoManejoTrips':this.tipoManejoTrips,
                'frecuenciaAplicacionTrips':this.frecuenciaAplicacionTrips,
                'afidiosCultivos':this.afidiosCultivos, 
                'tipoManejoAfidios':this.tipoManejoAfidios, 
                'frecuenciaAplicacionAfidios':this.frecuenciaAplicacionAfidios,            
                'acarosCultivos':this.acarosCultivos, 
                'tipoManejoAcaros':this.tipoManejoAcaros,
                'frecuenciaAplicacionAcaros':this.frecuenciaAplicacionAcaros, 
                'cochinillaCultivos':this.cochinillaCultivos,
                'tipoManejoCochinilla':this.tipoManejoCochinilla,
                'frecuenciaAplicacionCochinilla':this.frecuenciaAplicacionCochinilla
            }).then(function (response) {
                    me.cerrarModal();
                    me.listarPlaga(1,'','personas');
                })
                .catch(function (error) {
                    console.log(error);
                });

        },
         cargarPdf(){
                window.open('http://gestion.asofrut.org/plaga/listarPdf');
            },    
            validarPlaga(){
            this.errorPlaga=0;
            this.errorMostrarMsjPlaga=[];
            if(this.productor_id==0)this.errorMostrarMsjPlaga.push("Debe seleccionar un productor");
            if(this.finca_id==0)this.errorMostrarMsjPlaga.push("Debe seleccionar una finca.");
            if(this.errorMostrarMsjPlaga.length) this.errorPlaga=1;

            return this.errorPlaga;
        },
            cerrarModal(){
                        this.modal=0;
                        this.tituloModal='';
                        this.productor_id=0;
                        this.finca_id=0;
                        this.monitoreo='Seleccione', 
                        this.frecuenciaMonitoreo=0,
                        this.perlaTierra='Seleccione', 
                        this.tipoManejoPerla='Seleccione',
                        this.frecuenciaAplicacionPerla=0, 
                        this.barrenadorCultivo='Seleccione',
                        this.tipoManejoBarrenador='Seleccione',
                        this.frecuenciaAplicacionBarrenador=0,
                        this.tripsCultivo='Seleccione',
                        this.tipoManejoTrips='Seleccione',
                        this.frecuenciaAplicacionTrips=0,
                        this.afidiosCultivos='Seleccione', 
                        this.tipoManejoAfidios='Seleccione', 
                        this.frecuenciaAplicacionAfidios=0,            
                        this.acarosCultivos='Seleccione', 
                        this.tipoManejoAcaros='Seleccione',
                        this.frecuenciaAplicacionAcaros=0, 
                        this.cochinillaCultivos='Seleccione',
                        this.tipoManejoCochinilla='Seleccione',
                        this.frecuenciaAplicacionCochinilla=0
		                    this.errorPlaga=0;
        },
            abrirModal(modelo,accion,data = []){
            switch (modelo) {
                case "plaga":
                {    
                switch (accion) {
                    case 'registrar':
                    {
                        this.modal = 1;
                        this.tituloModal = 'Registrar control de plagas';
                        this.productor_id=0;
                        this.finca_id=0;
                        this.monitoreo='Seleccione', 
                        this.frecuenciaMonitoreo=0,
                        this.perlaTierra='Seleccione', 
                        this.tipoManejoPerla='Seleccione',
                        this.frecuenciaAplicacionPerla=0, 
                        this.barrenadorCultivo='Seleccione',
                        this.tipoManejoBarrenador='Seleccione',
                        this.frecuenciaAplicacionBarrenador=0,
                        this.tripsCultivo='Seleccione',
                        this.tipoManejoTrips='Seleccione',
                        this.frecuenciaAplicacionTrips=0,
                        this.afidiosCultivos='Seleccione', 
                        this.tipoManejoAfidios='Seleccione', 
                        this.frecuenciaAplicacionAfidios=0,            
                        this.acarosCultivos='Seleccione', 
                        this.tipoManejoAcaros='Seleccione',
                        this.frecuenciaAplicacionAcaros=0, 
                        this.cochinillaCultivos='Seleccione',
                        this.tipoManejoCochinilla='Seleccione',
                        this.frecuenciaAplicacionCochinilla=0     
                        this.tipoAccion=1;
                        break;
                    }  case 'actualizar':
                    {
                        this.modal=1;
                        this.tituloModal='Detalle control plagas';
                        this.tipoAccion=2;
                        this.plaga=data['id'];
                        this.productor_id=data['productor_id'];
                        this.finca_id=data['finca_id'];
                         this.monitoreo=data['monitoreo'];
                        this.frecuenciaMonitoreo=data['frecuenciaMonitoreo'];
                        this.perlaTierra=data['perlaTierra'];
                        this.tipoManejoPerla=data['tipoManejoPerla'];
                        this.frecuenciaAplicacionPerla=data['frecuenciaAplicacionPerla'];
                        this.barrenadorCultivo=data['barrenadorCultivo'];
                        this.tipoManejoBarrenador=data['tipoManejoBarrenador'];
                        this.frecuenciaAplicacionBarrenador=data['frecuenciaAplicacionBarrenador'];
                        this.tripsCultivo=data['tripsCultivo'];
                        this.tipoManejoTrips=data['tipoManejoTrips'];
                        this.frecuenciaAplicacionTrips=data['frecuenciaAplicacionTrips'];
                        this.afidiosCultivos=data['afidiosCultivos']; 
                        this.tipoManejoAfidios=data['tipoManejoAfidios'];
                        this.frecuenciaAplicacionAfidios=data['frecuenciaAplicacionAfidios'];         
                        this.acarosCultivos=data['acarosCultivos'];
                        this.tipoManejoAcaros=data['tipoManejoAcaros'];
                        this.frecuenciaAplicacionAcaros=data['frecuenciaAplicacionAcaros'];
                        this.cochinillaCultivos=data['cochinillaCultivos'];
                        this.tipoManejoCochinilla=data['tipoManejoCochinilla'];
                        this.frecuenciaAplicacionCochinilla=data['frecuenciaAplicacionCochinilla'];
                        break;
                    }       
                }
                }
            }
            this.selectProductor();
            this.selectFinca(this.productor_id);   
        }
        },        
        mounted() {
           this.listarPlaga(1,this.buscar,this.criterio);
           this.listarPlagaEx();
        }
    }
</script>
<style>
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display:flex;
        justify-content: center;
    }
    .text-error{
        color:red !important;
        font-weight: bold;
    }
    .modal-dialog{
    overflow-y: initial !important
    }
    .modal-body{
    height: 250px;
    overflow-y: auto;
    }
</style>