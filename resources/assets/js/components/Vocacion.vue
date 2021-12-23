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
                        <i class="fa fa-align-justify"></i> Vocacion Productor
                        <button type="button" @click="abrirModal('vocacion','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                         <export-excel
                            class   = "button btn btn-success"
                            :data   = arrayVocacionEx
                            worksheet = "Vocacion"
                            name    = "vocacion.xls">
                            Excel
                            </export-excel>
                            <export-excel
                            class   = "button btn btn-success"
                            :data   = arrayVocacionEx
                            type="csv"
                            name    = "vocacion.xls">
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
                                    <input type="text" v-model="buscar" @keyup.enter="listarVocacion(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarVocacion(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
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
                                    <th>Vocacion</th>
                                    <th>Tiempo en el cultivo de mora</th>
                                    <th>Practicas basicas del cultivo de mora</th>
                                    <th>Desea recibir capacitacion</th>
                                    <th>Dias a la semana en el cultivo de mora</th>  
                                    <th>Labores</th>
                                    <th>Motivo por el cual cultiva mora</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr v-for="vocacion in arrayVocacion" :key="vocacion.id">
                                    <td>
                                        <button type="button" @click="abrirModal('vocacion','actualizar',vocacion)" class="btn btn-warning btn-sm">
                                          <i class="icon-eye"></i>
                                        </button> &nbsp;
                                    </td> 
                                    <td v-text="vocacion.nombre"></td>
                                    <td v-text="vocacion.nombre_finca"></td> 
                                    <td v-text="vocacion.vocacion"></td> 
                                    <td v-text="vocacion.tiempo"></td> 
                                    <td v-text="vocacion.practicaBasica"></td> 
                                    <td v-text="vocacion.capacitacionRefuerzo"></td> 
                                    <td v-text="vocacion.diasMora"></td> 
                                    <td v-text="vocacion.labores"></td> 
                                    <td v-text="vocacion.motivo"></td> 
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
                                    <label class="col-md-3 form-control-label" for="text-input">Vocacion del Encuestado</label>
                                    <div class="col-md-9">
                                       <input type="text" v-model="vocacion"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Hace cuanto se dedica al cultivo de mora(años)
                                    </label>
                                    <div class="col-md-9">
                                       <input type="number" v-model="tiempo"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Conoce todas las practicas de produccion del cultivo de mora</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="practicaBasica">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                             <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Considera que es necesario recibir una capacitacion para reforzar sus conocimientos</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="capacitacionRefuerzo">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                             <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">En que temas desea recibir la capacitacion
                                    </label>
                                    <div class="col-md-9">
                                       <input type="text" v-model="temasRefuerzo"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Cuantos dias en la semana dedica al cultivo de mora
                                    </label>
                                    <div class="col-md-9">
                                       <input type="number" v-model="diasMora"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Que labores realiza con mas frecuencia
                                    </label>
                                    <div class="col-md-9">
                                       <input type="text" v-model="labores"  class="form-control" placeholder="">
                                    </div>
                                </div>   
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Que lo motivo a cultivar mora
                                    </label>
                                    <div class="col-md-9">
                                       <input type="text" v-model="motivo"  class="form-control" placeholder="">
                                    </div>
                                </div>                                                    
                                <div v-show="errorVocacion" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjVocacion" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarVocacion()">Guardar</button>
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
                vocacion_id:0,
                productor_id:0,
                finca_id:0,
                vocacion:'',
                tiempo:0,
                practicaBasica:'Seleccione',
                capacitacionRefuerzo:'Seleccione',
                temasRefuerzo:'',
                diasMora:0,
                labores:'',
                motivo:'',  
                arrayVocacion: [],
                arrayVocacionEx: [],
                modal: 0,
                tituloModal : '',
                tipoAccion:0,
                errorVocacion : 0,
                errorMostrarMsjVocacion:[],
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
            listarVocacion(page,buscar,criterio){
                let me =this;
                var url ='vocacion?page='+page + '&buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayVocacion= respuesta.vocacions.data;
                    me.pagination=respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            listarVocacionEx(){
                let me =this;
                var url ='vocacion/excel';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayVocacionEx= respuesta.vocacions;
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
                me.listarVocacion(page,buscar,criterio);
            },
            registrarVocacion(){
            if(this.validarVocacion()){
                return;
            }
            let me=this;
            axios.post('vocacion/registrar',{
                'productor_id':this.productor_id,
                'finca_id':this.finca_id,
                'vocacion':this.vocacion,
                'tiempo':this.tiempo,
                'practicaBasica':this.practicaBasica,
                'capacitacionRefuerzo':this.capacitacionRefuerzo,
                'temasRefuerzo':this.temasRefuerzo,
                'diasMora':this.diasMora,
                'labores':this.labores,
                'motivo':this.motivo  
            }).then(function (response) {
                    me.cerrarModal();
                    me.listarVocacion(1,'','personas');
                })
                .catch(function (error) {
                    console.log(error);
                });

        },
        cargarPdf(){
                window.open('http://gestion.asofrut.org/vocacion/listarPdf');
            },    
            validarVocacion(){
            this.errorVocacion=0;
            this.errorMostrarMsjVocacion=[];
            if(this.productor_id==0)this.errorMostrarMsjVocacion.push("Debe seleccionar un productor");
            if(this.finca_id==0)this.errorMostrarMsjVocacion.push("Debe seleccionar una finca.");
            if(this.errorMostrarMsjVocacion.length) this.errorVocacion=1;

            return this.errorVocacion;
        },
            cerrarModal(){
                        this.modal=0;
                        this.tituloModal='';
                        this.productor_id=0;
                        this.finca_id=0;
                        this.vocacion='';
                        this.tiempo=0;
                        this.practicaBasica='Seleccione';
                        this.capacitacionRefuerzo='Seleccione';
                        this.temasRefuerzo='';
                        this.diasMora=0;
                        this.labores='';
                        this.motivo='';  
        },
            abrirModal(modelo,accion,data = []){
            switch (modelo) {
                case "vocacion":
                {    
                switch (accion) {
                    case 'registrar':
                    {
                        this.modal = 1;
                        this.tituloModal = 'Registrar vocacion';
                        this.productor_id=0;
                        this.finca_id=0;
                        this.vocacion='';
                        this.tiempo=0;
                        this.practicaBasica='Seleccione';
                        this.capacitacionRefuerzo='Seleccione';
                        this.temasRefuerzo='';
                        this.diasMora=0;
                        this.labores='';
                        this.motivo='';  
                        this.tipoAccion=1;
                        break;
                    }  case 'actualizar':
                    {
                        this.modal=1;
                        this.tituloModal='Detalle vocacion';
                        this.tipoAccion=2;
                        this.vocacion_id=data['id'];
                        this.productor_id=data['productor_id'];
                        this.finca_id=data['finca_id'];
                        this.vocacion=data['vocacion'];
                        this.tiempo=data['tiempo'];
                        this.practicaBasica=data['practicaBasica'];
                        this.capacitacionRefuerzo=data['capacitacionRefuerzo'];
                        this.temasRefuerzo=data['temasRefuerzo'];
                        this.diasMora=data['diasMora'];
                        this.labores=data['labores'];
                        this.motivo=data['motivo'];  
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
           this.listarVocacion(1,this.buscar,this.criterio);
           this.listarVocacionEx();
           
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