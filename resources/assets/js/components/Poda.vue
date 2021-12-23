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
                        <i class="fa fa-align-justify"></i> Poda
                        <button type="button" @click="abrirModal('poda','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                         <export-excel
                            class   = "button btn btn-success"
                            :data   = arrayPodaEx
                            worksheet = "Poda"
                            name    = "poda.xls">
                            Excel
                            </export-excel>
                            <export-excel
                            class   = "button btn btn-success"
                            :data   = arrayPodaEx
                            type="csv"
                            name    = "poda.xls">
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
                                    <input type="text" v-model="buscar" @keyup.enter="listarPoda(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarPoda(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
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
                                    <th>Estado Vegetativo</th>
                                    <th>Poda de Aclareo</th>
                                    <th>Frecuencia(dias)</th>
                                    <th>Poda de Mantenimiento</th>
                                    <th>Frecuencia(dias)</th>
                                    <th>Poda Fitosanitaria</th>
                                    <th>Frecuencia(dias)</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr v-for="poda in arrayPoda" :key="poda.id">
                                    <td>
                                        <button type="button" @click="abrirModal('poda','actualizar',poda)" class="btn btn-warning btn-sm">
                                          <i class="icon-eye"></i>
                                        </button> &nbsp;
                                    </td> 
                                    <td v-text="poda.nombre"></td>
                                    <td v-text="poda.nombre_finca"></td> 
                                    <td v-text="poda.estadoVegetativo"></td> 
                                    <td v-text="poda.podaAclareo"></td> 
                                    <td v-text="poda.frecuenciaAclareo"></td> 
                                    <td v-text="poda.podaMantenimiento"></td> 
                                    <td v-text="poda.frecuenciaMantenimiento"></td> 
                                    <td v-text="poda.podaFitosanitaria"></td> 
                                    <td v-text="poda.frecuenciaFitosanitaria"></td> 
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
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="finca in arrayFinca" :key="finca.id" :value="finca.id" v-text="finca.nombre" ></option>
                                      </select>  
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Estado Vegetativo</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="estadoVegetativo">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                             <option value="Levante">Levante</option>
                                            <option value="Produccion">Produccion</option>
                                      </select>  
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Poda de Formacion</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="podaFormacion">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                             <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Poda Aclareo</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="podaAclareo">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                             <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Frecuencia(dias)</label>
                                    <div class="col-md-9">
                                       <input type="number" v-model="frecuenciaAclareo"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Poda Mantenimiento</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="podaMantenimiento">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                             <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                </div>
                                  <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Frecuencia(dias)</label>
                                    <div class="col-md-9">
                                       <input type="number" v-model="frecuenciaMantenimiento"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Poda Fitosanitaria</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="podaFitosanitaria">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                             <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Frecuencia(dias)</label>
                                    <div class="col-md-9">
                                       <input type="number" v-model="frecuenciaFitosanitaria"  class="form-control" placeholder="">
                                    </div>
                                </div>                               
                                <div v-show="errorPoda" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjPoda" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarPoda()">Guardar</button>
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
                cosecha_id:0,
                productor_id:0,
                finca_id:0,
                estadoVegetativo:'Seleccione',
                podaFormacion:'Seleccione',
                podaAclareo:'Seleccione',
                frecuenciaAclareo:0,
                podaMantenimiento:'Seleccione',
                frecuenciaMantenimiento:0,
                podaFitosanitaria:'Seleccione',
                frecuenciaFitosanitaria:0,
                arrayPoda: [],
                arrayPodaEx: [],
                modal: 0,
                tituloModal : '',
                tipoAccion:0,
                errorPoda : 0,
                errorMostrarMsjPoda:[],
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
            listarPoda(page,buscar,criterio){
                let me =this;
                var url ='poda?page='+page + '&buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayPoda= respuesta.podas.data;
                    me.pagination=respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
             listarPodaEx(){
                let me =this;
                var url ='poda/excel';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayPodaEx= respuesta.podas;
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
                me.listarPoda(page,buscar,criterio);
            },
            registrarPoda(){
            if(this.validarPoda()){
                return;
            }
            let me=this;
            axios.post('poda/registrar',{
                'productor_id':this.productor_id,
                'finca_id':this.finca_id,
                'estadoVegetativo':this.estadoVegetativo,
                'podaFormacion':this.podaFormacion,
                'podaAclareo':this.podaAclareo,
                'frecuenciaAclareo':this.frecuenciaAclareo,
                'podaMantenimiento':this.podaMantenimiento,
                'frecuenciaMantenimiento':this.frecuenciaMantenimiento,
                'podaFitosanitaria':this.podaFitosanitaria,
                'frecuenciaFitosanitaria':this.frecuenciaFitosanitaria                  
            }).then(function (response) {
                    me.cerrarModal();
                    me.listarPoda(1,'','personas');
                })
                .catch(function (error) {
                    console.log(error);
                });

        },
         cargarPdf(){
                window.open('http://gestion.asofrut.org/poda/listarPdf');
            },    
            validarPoda(){
            this.errorPoda=0;
            this.errorMostrarMsjPoda=[];
            if(this.productor_id==0)this.errorMostrarMsjPoda.push("Debe seleccionar un productor");
            if(this.finca_id==0)this.errorMostrarMsjPoda.push("Debe seleccionar una finca.");
            if(this.errorMostrarMsjPoda.length) this.errorPoda=1;

            return this.errorPoda;
        },
            cerrarModal(){
                        this.modal=0;
                        this.tituloModal='';
                        this.productor_id=0;
                        this.finca_id=0;
                        this.estadoVegetativo='Seleccione';
                        this.podaFormacion='Seleccione';
                        this.podaAclareo='Seleccione';
                        this.frecuenciaAclareo=0;
                        this.podaMantenimiento='Seleccione';
                        this.frecuenciaMantenimiento=0;
                        this.podaFitosanitaria='Seleccione';
                        this.frecuenciaFitosanitaria=0;  
                        this.errorPoda=0;
        },
            abrirModal(modelo,accion,data = []){
            switch (modelo) {
                case "poda":
                {    
                switch (accion) {
                    case 'registrar':
                    {
                        this.modal = 1;
                        this.tituloModal = 'Registrar poda';
                        this.productor_id=0;
                        this.finca_id=0;
                        this.estadoVegetativo='Seleccione';
                        this.podaFormacion='Seleccione';
                        this.podaAclareo='Seleccione';
                        this.frecuenciaAclareo=0;
                        this.podaMantenimiento='Seleccione';
                        this.frecuenciaMantenimiento=0;
                        this.podaFitosanitaria='Seleccione';
                        this.frecuenciaFitosanitaria=0;  
                        this.tipoAccion=1;
                        break;
                    }  case 'actualizar':
                    {
                        this.modal=1;
                        this.tituloModal='Detalle visita extensionista';
                        this.tipoAccion=2;
                        this.encuestaAsofrut_id=data['id'];
                        this.productor_id=data['productor_id'];
                        this.finca_id=data['finca_id'];
                        this.estadoVegetativo=data['estadoVegetativo'];
                        this.podaFormacion=data['podaFormacion'];
                        this.podaAclareo=data['podaAclareo'];
                        this.frecuenciaAclareo=data['frecuenciaAclareo'];
                        this.podaMantenimiento=data['podaMantenimiento'];
                        this.frecuenciaMantenimiento=data['frecuenciaMantenimiento'];
                        this.podaFitosanitaria=data['podaFitosanitaria'];
                        this.frecuenciaFitosanitaria=data['frecuenciaFitosanitaria']; 
                        break
                    }       
                }
                }
            }
            this.selectProductor();
            this.selectFinca(this.productor_id);   
        }
        },        
        mounted() {
           this.listarPoda(1,this.buscar,this.criterio);
           this.listarPodaEx();
           
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