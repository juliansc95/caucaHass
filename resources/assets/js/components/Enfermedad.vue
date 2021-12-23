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
                        <i class="fa fa-align-justify"></i>Enfermedades
                        <button type="button" @click="abrirModal('enfermedad','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                         <export-excel
                            class   = "button btn btn-success"
                            :data   = arrayEnfermedadEx
                            worksheet = "Enfermedades"
                            name    = "enfermedad.xls">
                            Excel
                            </export-excel>
                            <export-excel
                            class   = "button btn btn-success"
                            :data   = arrayEnfermedadEx
                            type="csv"
                            name    = "enfermedad.xls">
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
                                    <input type="text" v-model="buscar" @keyup.enter="listarEnfermedad(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarEnfermedad(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
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
                                    <th>Monitoreo</th>
                                    <th>Frecuencia Monitoreo</th>
                                    <th>Antracnosis</th>
                                    <th>Frecuencia Antracnosis</th>
                                    <th>Botritys</th>
                                    <th>Mildeo</th>
                                    <th>Mildeo Velloso</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr v-for="enfermedad in arrayEnfermedad" :key="enfermedad.id">
                                    <td>
                                        <button type="button" @click="abrirModal('enfermedad','actualizar',enfermedad)" class="btn btn-warning btn-sm">
                                          <i class="icon-eye"></i>
                                        </button> &nbsp;
                                    </td> 
                                    <td v-text="enfermedad.nombre"></td>
                                    <td v-text="enfermedad.nombre_finca"></td> 
                                    <td v-text="enfermedad.monitoreo"></td> 
                                    <td v-text="enfermedad.frecuenciaMonitoreo"></td> 
                                    <td v-text="enfermedad.antracnosis"></td> 
                                    <td v-text="enfermedad.frecuenciaAntra"></td> 
                                    <td v-text="enfermedad.botritys"></td>  
                                    <td v-text="enfermedad.mildeo"></td>
                                    <td v-text="enfermedad.mildeoVelloso"></td>                                     
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
                                    <label class="col-md-3 form-control-label" for="text-input">Realiza Monitoreo</label>
                                    <div class="col-md-3">
                                      <select class="form-control" v-model="monitoreo">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                    <label class="col-md-3 form-control-label" for="text-input">Frecuencia(Dias)
                                    </label>
                                    <div class="col-md-3">
                                       <input type="number" v-model="frecuenciaMonitoreo"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Presencia Antracnosis</label>
                                    <div class="col-md-2">
                                      <select class="form-control" v-model="antracnosis">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                    <label class="col-md-2 form-control-label" for="text-input">Tipo de Manejo</label>
                                    <div class="col-md-2">
                                      <select class="form-control" v-model="tipoManejoAntra">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Trampas">Trampas</option>
                                            <option value="Biologicos">Biologicos</option>
                                            <option value="Biopreparados">Biopreparados</option>
                                            <option value="Caldos Minerales">Caldos Minerales</option>
                                            <option value="Agroquimicos">Agroquimicos</option>
                                            <option value="Otro">Otro</option>                                            
                                      </select>  
                                    </div>
                                     <label class="col-md-2 form-control-label" for="text-input">Frecuencia(Dias)
                                    </label>
                                    <div class="col-md-2">
                                       <input type="number" v-model="frecuenciaAntra"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                 
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Presencia Botritys</label>
                                    <div class="col-md-2">
                                      <select class="form-control" v-model="botritys">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                    <label class="col-md-2 form-control-label" for="text-input">Tipo de Manejo</label>
                                    <div class="col-md-2">
                                      <select class="form-control" v-model="tipoManejoBotritys">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Trampas">Trampas</option>
                                            <option value="Biologicos">Biologicos</option>
                                            <option value="Biopreparados">Biopreparados</option>
                                            <option value="Caldos Minerales">Caldos Minerales</option>
                                            <option value="Agroquimicos">Agroquimicos</option>
                                            <option value="Otro">Otro</option>                                            
                                      </select>  
                                    </div>
                                     <label class="col-md-2 form-control-label" for="text-input">Frecuencia(Dias)
                                    </label>
                                    <div class="col-md-2">
                                       <input type="number" v-model="frecuenciaBotritys"  class="form-control" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Presencia Mildeo Polvoso</label>
                                    <div class="col-md-2">
                                      <select class="form-control" v-model="mildeo">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                    <label class="col-md-2 form-control-label" for="text-input">Tipo de Manejo</label>
                                    <div class="col-md-2">
                                      <select class="form-control" v-model="tipoManejoMildeo">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Trampas">Trampas</option>
                                            <option value="Biologicos">Biologicos</option>
                                            <option value="Biopreparados">Biopreparados</option>
                                            <option value="Caldos Minerales">Caldos Minerales</option>
                                            <option value="Agroquimicos">Agroquimicos</option>
                                            <option value="Otro">Otro</option>                                            
                                      </select>  
                                    </div>
                                     <label class="col-md-2 form-control-label" for="text-input">Frecuencia(Dias)
                                    </label>
                                    <div class="col-md-2">
                                       <input type="number" v-model="frecuenciaMildeo"  class="form-control" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Presencia Mildeo Velloso</label>
                                    <div class="col-md-2">
                                      <select class="form-control" v-model="mildeoVelloso">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                    <label class="col-md-2 form-control-label" for="text-input">Tipo de Manejo</label>
                                    <div class="col-md-2">
                                      <select class="form-control" v-model="tipoManejoMildeoVelloso">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Trampas">Trampas</option>
                                            <option value="Biologicos">Biologicos</option>
                                            <option value="Biopreparados">Biopreparados</option>
                                            <option value="Caldos Minerales">Caldos Minerales</option>
                                            <option value="Agroquimicos">Agroquimicos</option>
                                            <option value="Otro">Otro</option>                                            
                                      </select>  
                                    </div>
                                     <label class="col-md-2 form-control-label" for="text-input">Frecuencia(Dias)
                                    </label>
                                    <div class="col-md-2">
                                       <input type="number" v-model="frecuenciaMildeoVelloso"  class="form-control" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Usa adherentes o coadyuvantes</label>
                                    <div class="col-md-2">
                                      <select class="form-control" v-model="adherentes">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                     <label class="col-md-2 form-control-label" for="text-input">Nombre
                                    </label>
                                    <div class="col-md-2">
                                       <input type="text" v-model="nombreAdherente"  class="form-control" placeholder="">
                                    </div>
                                    
                                     <label class="col-md-2 form-control-label" for="text-input">Dosis(cm3/g)
                                    </label>
                                    <div class="col-md-2">
                                       <input type="number" v-model="dosisAplicacion"  class="form-control" placeholder="">
                                    </div>
                                </div>                    
                                <div v-show="errorEnfermedad" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjPractica" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarEnfermedad()">Guardar</button>
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
                enfermedad_id:0,
                productor_id:0,
                finca_id:0,
                monitoreo:'Seleccione',
                frecuenciaMonitoreo:0,
                antracnosis:'Seleccione',
                tipoManejoAntra:'Seleccione',
                frecuenciaAntra:0,
                botritys:'Seleccione',
                tipoManejoBotritys:'Seleccione',
                frecuenciaBotritys:0,
                mildeo:'Seleccione',
                tipoManejoMildeo:'Seleccione',
                frecuenciaMildeo:0,
                mildeoVelloso:'Seleccione',
                tipoManejoMildeoVelloso:'Seleccione',
                frecuenciaMildeoVelloso:0,
                adherentes:'Seleccione',
                nombreAdherente:'',
                dosisAplicacion:0,               
                arrayEnfermedad: [],
                arrayEnfermedadEx: [],
                modal: 0,
                tituloModal : '',
                tipoAccion:0,
                errorEnfermedad : 0,
                errorMostrarMsjPractica:[],
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
            listarEnfermedad(page,buscar,criterio){
                let me =this;
                var url ='enfermedad?page='+page + '&buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayEnfermedad= respuesta.enfermedads.data;
                    me.pagination=respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
             listarEnfermedadEx(){
                let me =this;
                var url ='enfermedad/excel';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayEnfermedadEx= respuesta.enfermedads;
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
                me.listarEnfermedad(page,buscar,criterio);
            },
            registrarEnfermedad(){
            if(this.validarEnfermedad()){
                return;
            }
            let me=this;
            axios.post('enfermedad/registrar',{
                'productor_id':this.productor_id,
                'finca_id':this.finca_id,
                'monitoreo':this.monitoreo,
                'frecuenciaMonitoreo':this.frecuenciaMonitoreo,
                'antracnosis':this.antracnosis,
                'tipoManejoAntra':this.tipoManejoAntra,
                'frecuenciaAntra':this.frecuenciaAntra,
                'botritys':this.botritys,
                'tipoManejoBotritys':this.tipoManejoBotritys,
                'frecuenciaBotritys':this.frecuenciaBotritys,
                'mildeo':this.mildeo,
                'tipoManejoMildeo':this.tipoManejoMildeo,
                'frecuenciaMildeo':this.frecuenciaMildeo,
                'mildeoVelloso':this.mildeoVelloso,
                'tipoManejoMildeoVelloso':this.tipoManejoMildeoVelloso,
                'frecuenciaMildeoVelloso':this.frecuenciaMildeoVelloso,
                'adherentes':this.adherentes,
                'nombreAdherente':this.nombreAdherente,
                'dosisAplicacion':this.dosisAplicacion     
            }).then(function (response) {
                    me.cerrarModal();
                    me.listarEnfermedad(1,'','personas');
                })
                .catch(function (error) {
                    console.log(error);
                });

        }, 
        cargarPdf(){
                window.open('http://gestion.asofrut.org/enfermedad/listarPdf');
            },   
            validarEnfermedad(){
            this.errorEnfermedad=0;
            this.errorMostrarMsjPractica=[];
            if(this.productor_id==0)this.errorMostrarMsjPractica.push("Debe seleccionar un productor");
            if(this.finca_id==0)this.errorMostrarMsjPractica.push("Debe seleccionar una finca.");
            if(this.errorMostrarMsjPractica.length) this.errorEnfermedad=1;

            return this.errorEnfermedad;
        },
            cerrarModal(){
                        this.modal=0;
                        this.tituloModal='';
                        this.productor_id=0;
                        this.finca_id=0;
                        this.monitoreo='Seleccione';
                        this.frecuenciaMonitoreo=0;
                        this.antracnosis='Seleccione';
                        this.tipoManejoAntra='Seleccione';
                        this.frecuenciaAntra=0;
                        this.botritys='Seleccione';
                        this.tipoManejoBotritys='Seleccione';
                        this.frecuenciaBotritys=0;
                        this.mildeo='Seleccione';
                        this.tipoManejoMildeo='Seleccione';
                        this.frecuenciaMildeo=0;
                        this.mildeoVelloso='Seleccione';
                        this.tipoManejoMildeoVelloso='Seleccione';
                        this.frecuenciaMildeoVelloso=0;
                        this.adherentes='Seleccione';
                        this.nombreAdherente='';
                        this.dosisAplicacion=0 ;          
		                this.errorEnfermedad=0;
        },
            abrirModal(modelo,accion,data = []){
            switch (modelo) {
                case "enfermedad":
                {    
                switch (accion) {
                    case 'registrar':
                    {
                        this.modal = 1;
                        this.tituloModal = 'Registrar enfermedades';
                        this.productor_id=0;
                        this.finca_id=0;
                        this.monitoreo='Seleccione';
                        this.frecuenciaMonitoreo=0;
                        this.antracnosis='Seleccione';
                        this.tipoManejoAntra='Seleccione';
                        this.frecuenciaAntra=0;
                        this.botritys='Seleccione';
                        this.tipoManejoBotritys='Seleccione';
                        this.frecuenciaBotritys=0;
                        this.mildeo='Seleccione';
                        this.tipoManejoMildeo='Seleccione';
                        this.frecuenciaMildeo=0;
                        this.mildeoVelloso='Seleccione';
                        this.tipoManejoMildeoVelloso='Seleccione';
                        this.frecuenciaMildeoVelloso=0;
                        this.adherentes='Seleccione';
                        this.nombreAdherente='';
                        this.dosisAplicacion=0 ;  
                        this.tipoAccion=1;
                        break;
                    }  case 'actualizar':
                    {
                        this.modal=1;
                        this.tituloModal='Detalle enfermedades';
                        this.tipoAccion=2;
                        this.enfermedad_id=data['id'];
                        this.productor_id=data['productor_id'];
                        this.finca_id=data['finca_id'];
                        this.monitoreo=data['monitoreo'];
                        this.frecuenciaMonitoreo=data['frecuenciaMonitoreo'];
                        this.antracnosis=data['antracnosis'];
                        this.tipoManejoAntra=data['tipoManejoAntra'];
                        this.frecuenciaAntra=data['frecuenciaAntra'];
                        this.botritys=data['botritys'];
                        this.tipoManejoBotritys=data['tipoManejoBotritys'];
                        this.frecuenciaBotritys=data['frecuenciaBotritys'];
                        this.mildeo=data['mildeo'];
                        this.tipoManejoMildeo=data['tipoManejoMildeo'];
                        this.frecuenciaMildeo=data['frecuenciaMildeo'];
                        this.mildeoVelloso=data['mildeoVelloso'];
                        this.tipoManejoMildeoVelloso=data['tipoManejoMildeoVelloso'];
                        this.frecuenciaMildeoVelloso=data['frecuenciaMildeoVelloso'];
                        this.adherentes=data['adherentes'];
                        this.nombreAdherente=data['nombreAdherente'];
                        this.dosisAplicacion=data['dosisAplicacion']; 
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
           this.listarEnfermedad(1,this.buscar,this.criterio);
           this.listarEnfermedadEx();
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