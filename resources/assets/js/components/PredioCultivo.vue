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
                        <i class="fa fa-align-justify"></i> Aplicacion de fertilizantes
                        <button type="button" @click="abrirModal('predio','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                         <export-excel
                            class   = "button btn btn-success"
                            :data   = arrayPredioCultivoEx
                            worksheet = "Predio Cultivo"
                            name    = "predioCultivo.xls">
                            Excel
                            </export-excel>
                            <export-excel
                            class   = "button btn btn-success"
                            :data   = arrayPredioCultivoEx
                            type="csv"
                            name    = "predioCultivo.xls">
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
                                    <input type="text" v-model="buscar" @keyup.enter="listarPredioCultivo(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarPredioCultivo(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
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
                                    <th>Fecha Siembra</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr v-for="predio in arrayPredioCultivo" :key="predio.id">
                                    <td>
                                        <button type="button" @click="abrirModal('predio','actualizar',predio)" class="btn btn-warning btn-sm">
                                          <i class="icon-eye"></i>
                                        </button> &nbsp;
                                    </td> 
                                    <td v-text="predio.nombre_productor"></td>
                                    <td v-text="predio.nombre_finca"></td> 
                                    <td v-text="predio.fechaAplicacion"></td> 
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
                                    <label class="col-md-3 form-control-label" for="text-input">Fecha de Aplicacion</label>
                                    <div class="col-md-9">
                                         <v-datepicker :inline="true" v-model="fechaAplicacion "></v-datepicker>
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre comercial del producto</label>
                                    <div class="col-md-9">
                                       <input type="text" v-model="nombreProducto"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Ingeniero Agronomo</label>
                                    <div class="col-md-9">
                                       <input type="text" v-model="nombreIngenieroAgronomo"  class="form-control" placeholder="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Concentracion</label>
                                    <div class="col-md-9">
                                       <input type="text" v-model="concentracion"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Registro ICA</label>
                                    <div class="col-md-9">
                                       <input type="text" v-model="RegistroICA"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Dosis(Gramos/cc)</label>
                                    <div class="col-md-9">
                                       <input type="number" v-model="Dosis"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Forma Aplicacion</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="formaAplicacion">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="EDAFICA">Edafica</option>
                                            <option value="FOLIAR">Foliar</option>
                                      </select>  
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Quien recomendó</label>
                                    <div class="col-md-9">
                                       <input type="text" v-model="recomendo"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Quien aplico</label>
                                    <div class="col-md-9">
                                       <input type="text" v-model="Aplico"  class="form-control" placeholder="">
                                    </div>
                                </div>                      
                                <div v-show="errorPredioCultivo" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjCultivo" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarPredioCultivo()">Guardar</button>
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
                tutorado_id:0,
                productor_id:0,
                finca_id:0,
                areaSembradaPredio:0, 
                fechaSiembra:'',
                numeroPlantasTotales:0,
                numeroPlantasProduccion:0,
                plantasErradicadas:0,
                plantasLevante:0,
                TipoMora:'Seleccione',
                vereda_id:0,
                tipoReproduccion:'',
                bolsa:'Seleccione',                
                arrayPredioCultivo: [],
                arrayPredioCultivoEx: [],
                modal: 0,
                tituloModal : '',
                tipoAccion:0,
                errorPredioCultivo : 0,
                errorMostrarMsjCultivo:[],
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
                arrayFinca : [],
                arrayVereda:[]                  
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
            listarPredioCultivo(page,buscar,criterio){
                let me =this;
                var url ='fertilizante?page='+page + '&buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayPredioCultivo= respuesta.fertilizantes.data;
                    me.pagination=respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            listarPredioCultivoEx(page,buscar,criterio){
                let me =this;
                var url ='predioCultivo/excel';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayPredioCultivoEx= respuesta.predios;
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
            selectVereda(){
                let me =this;
                var url ='vereda/selectVereda';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayVereda= respuesta.veredas;
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
                me.listarPredioCultivo(page,buscar,criterio);
            },
            registrarPredioCultivo(){
            if(this.validarPredioCultivo()){
                return;
            }
            let me=this;
            axios.post('fertilizante/registrar',{
                'productor_id':this.productor_id,
                'finca_id':this.finca_id,
                'fechaAplicacion':this.fechaAplicacion, 
                'nombreProducto':this.nombreProducto,
                'nombreIngenieroAgronomo':this.nombreIngenieroAgronomo,
                'concentracion':this.concentracion,
                'RegistroICA':this.RegistroICA,
                'Dosis':this.Dosis,
                'formaAplicacion':this.formaAplicacion,
                'recomendo':this.recomendo,
                'Aplico':this.Aplico                                   
            }).then(function (response) {
                    me.cerrarModal();
                    me.listarPredioCultivo(1,'','personas');
                })
                .catch(function (error) {
                    console.log(error);
                });

        },
        cargarPdf(){
                window.open('http://gestion.asofrut.org/predioCultivo/listarPdf');
            },    
            validarPredioCultivo(){
            this.errorPredioCultivo=0;
            this.errorMostrarMsjCultivo=[];
            if(this.productor_id==0)this.errorMostrarMsjCultivo.push("Debe seleccionar un productor");
            if(this.finca_id==0)this.errorMostrarMsjCultivo.push("Debe seleccionar una finca.");
            if(this.errorMostrarMsjCultivo.length) this.errorPredioCultivo=1;
            return this.errorPredioCultivo;
        },
            cerrarModal(){
                        this.modal=0;
                        this.tituloModal='';
                        this.productor_id=0;
                        this.finca_id=0;
                        this.nombreProducto='';
                        this.nombreIngenieroAgronomo='';
                        this.concentracion='';
                        this.RegistroICA='';
                        this.Dosis=0;
                        this.formaAplicacion='Seleccione';
                        this.recomendo='';
                        this.Aplico='';                                        
                        this.errorPredioCultivo=0;
        },
            abrirModal(modelo,accion,data = []){
            switch (modelo) {
                case "predio":
                {    
                switch (accion) {
                    case 'registrar':
                    {
                        this.modal = 1;
                        this.tituloModal = 'Registro Aplicacion de fertilizantes';
                        this.productor_id=0;
                        this.finca_id=0;
                        this.nombreProducto='';
                        this.nombreIngenieroAgronomo='';
                        this.concentracion='';
                        this.RegistroICA='';
                        this.Dosis=0;
                        this.formaAplicacion='Seleccione';
                        this.recomendo='';
                        this.Aplico='';           
                        this.tipoAccion=1;
                        break;
                    }  case 'actualizar':
                    {
                        this.modal=1;
                        this.tituloModal='Detalle aplicacion de fertilizantes';
                        this.tipoAccion=2;
                        this.tutorado_id=data['id'];
                        this.productor_id=data['productor_id'];
                        this.fechaAplicacion = data['fechaAplicacion'];
                        this.finca_id=data['finca_id'];
                        this.nombreProducto=data['nombreProducto'];
                        this.nombreIngenieroAgronomo=data['nombreIngenieroAgronomo'];
                        this.concentracion=data['concentracion'];
                        this.RegistroICA=data['RegistroICA'];
                        this.Dosis=data['Dosis'];
                        this.formaAplicacion=data['formaAplicacion'];
                        this.recomendo=data['recomendo'];
                        this.Aplico=data['aplico'];           
                        break;
                    }       
                }
                }
            }
            this.selectProductor();
            this.selectFinca(this.productor_id);
            this.selectVereda();   
        }
        },        
        mounted() {
           this.listarPredioCultivo(1,this.buscar,this.criterio);
           this.listarPredioCultivoEx();
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