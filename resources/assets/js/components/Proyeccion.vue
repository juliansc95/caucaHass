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
                        <i class="fa fa-align-justify"></i> Registro Proyeccion
                        <button type="button" @click="abrirModal('predio','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                         <export-excel
                            class   = "button btn btn-success"
                            :data   = arrayPredioCultivoEx
                            worksheet = "Proyecciones"
                            name    = "proyecciones.xls">
                            Excel
                            </export-excel>
                            <export-excel
                            class   = "button btn btn-success"
                            :data   = arrayPredioCultivoEx
                            type="csv"
                            name    = "proyecciones.xls">
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
                                    <input type="text" v-model="buscar" @keyup.enter="listarProyeccion(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarProyeccion(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
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
                                    <th>Arboles Lote Uno</th>
                                    <th>Edad Arboles</th>
                                    <th>Kg Proyectado</th>
                                    <th>Arboles Lote Dos</th>
                                    <th>Edad Arboles</th>
                                    <th>Kg Proyectado</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr v-for="predio in arrayPredioCultivo" :key="predio.id">
                                    <td>
                                        <button type="button" @click="abrirModal('predio','actualizar',predio)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                    </td> 
                                    <td v-text="predio.nombre_productor"></td>
                                    <td v-text="predio.nombre_finca"></td> 
                                    <td v-text="predio.arbolesLoteUno"></td> 
                                    <td v-text="predio.EdadArbolesLoteUno"></td> 
                                    <td v-text="predio.kgProyectadoLoteUno"></td> 
                                    <td v-text="predio.arbolesLoteDos"></td> 
                                    <td v-text="predio.EdadArbolesLoteDos"></td>
                                    <td v-text="predio.kgProyectadoLoteDos"></td>
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
                                    <label class="col-md-3 form-control-label" for="number-input">Numero Arboles Lote Uno</label>
                                    <div class="col-md-9">
                                       <input type="number" v-model="arbolesLoteUno"   class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="number-input">Edad Arboles Lote Uno</label>
                                    <div class="col-md-9">
                                       <input type="number" v-model="EdadArbolesLoteUno"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="number-input">Kg Proyectado Lote Uno</label>
                                    <div class="col-md-9">
                                       <input type="number" v-model="kgProyectadoLoteUno"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="number-input">Numero Arboles Lote Dos</label>
                                    <div class="col-md-9">
                                       <input type="number" v-model="arbolesLoteDos"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="number-input">Edad Arboles Lote Dos</label>
                                    <div class="col-md-9">
                                       <input type="number" v-model="EdadArbolesLoteDos"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="number-input">Kg Proyectado Lote 2</label>
                                    <div class="col-md-9">
                                       <input type="number" v-model="kgProyectadoLoteDos"  class="form-control" placeholder="">
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
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarProyeccion()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarProyeccion()">Actualizar</button>
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
                proyeccion_id:0,
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
                arrayFertilizante:[],
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
            listarProyeccion(page,buscar,criterio){
                let me =this;
                var url ='proyeccion?page='+page + '&buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayPredioCultivo= respuesta.proyeccions.data;
                    me.pagination=respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            listarProyeccionEx(page,buscar,criterio){
                let me =this;
                var url ='proyeccion/excel';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayPredioCultivoEx= respuesta.proyeccions;
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
             selectFertilizante(){
                let me =this;
                var url ='producFertilizante/selectFertilizante';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayFertilizante= respuesta.fertilizantes;
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
                me.listarProyeccion(page,buscar,criterio);
            },
            registrarProyeccion(){
            if(this.validarProyeccion()){
                return;
            }
            let me=this;
            axios.post('proyeccion/registrar',{
                'productor_id':this.productor_id,
                'finca_id':this.finca_id,
                'fechaAplicacion':this.fechaAplicacion, 
                'nombreProducto':this.nombreProducto,
                'arbolesLoteUno':this.arbolesLoteUno,
                'EdadArbolesLoteUno':this.EdadArbolesLoteUno,
                'kgProyectadoLoteUno':this.kgProyectadoLoteUno,
                'arbolesLoteDos':this.arbolesLoteDos,
                'formaAplicacion':this.formaAplicacion,
                'EdadArbolesLoteDos':this.EdadArbolesLoteDos,
                'kgProyectadoLoteDos':this.kgProyectadoLoteDos                                   
            }).then(function (response) {
                    me.cerrarModal();
                    me.listarProyeccion(1,'','personas');
                })
                .catch(function (error) {
                    console.log(error);
                });

        },
         actualizarProyeccion(){
            if(this.validarProyeccion()){
                return;
            }
            let me=this;
            axios.put('proyeccion/actualizar',{
                'productor_id':this.productor_id,
                'finca_id':this.finca_id,
                'fechaAplicacion':this.fechaAplicacion, 
                'nombreProducto':this.nombreProducto,
                'arbolesLoteUno':this.arbolesLoteUno,
                'EdadArbolesLoteUno':this.EdadArbolesLoteUno,
                'kgProyectadoLoteUno':this.kgProyectadoLoteUno,
                'arbolesLoteDos':this.arbolesLoteDos,
                'formaAplicacion':this.formaAplicacion,
                'EdadArbolesLoteDos':this.EdadArbolesLoteDos,
                'kgProyectadoLoteDos':this.kgProyectadoLoteDos,   
                'id':this.proyeccion_id
            }).then(function (response) {
                    me.cerrarModal();
                    me.listarProyeccion(1,'','nombre');
                })
                .catch(function (error) {
                    console.log(error);
                });
        },      
        cargarPdf(){
                //window.open('/caucahass/public/proyeccion/listarPdf');
                window.open('http://caucahass.sttmserver.com/proyeccion/listarPdf');
            },    
            validarProyeccion(){
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
                        this.arbolesLoteUno=0;
                        this.EdadArbolesLoteUno=0;
                        this.kgProyectadoLoteUno=0;
                        this.arbolesLoteDos=0;
                        this.formaAplicacion='Seleccione';
                        this.EdadArbolesLoteDos=0;
                        this.kgProyectadoLoteDos=0;                                        
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
                        this.tituloModal = 'Registro Proyeccion';
                        this.productor_id=0;
                        this.finca_id=0;
                        this.nombreProducto='';
                        this.arbolesLoteUno=0;
                        this.EdadArbolesLoteUno=0;
                        this.kgProyectadoLoteUno=0;
                        this.arbolesLoteDos=0;
                        this.formaAplicacion='Seleccione';
                        this.EdadArbolesLoteDos=0;
                        this.kgProyectadoLoteDos=0;          
                        this.tipoAccion=1;
                        break;
                    }  case 'actualizar':
                    {
                        this.modal=1;
                        this.tituloModal='Editar Proyeccion';
                        this.tipoAccion=2;
                        this.proyeccion_id=data['id'];
                        this.productor_id=data['productor_id'];
                        this.finca_id=data['finca_id'];
                        this.nombreProducto=data['nombreProducto'];
                        this.arbolesLoteUno=data['arbolesLoteUno'];
                        this.EdadArbolesLoteUno=data['EdadArbolesLoteUno'];
                        this.kgProyectadoLoteUno=data['kgProyectadoLoteUno'];
                        this.arbolesLoteDos=data['arbolesLoteDos'];
                        this.formaAplicacion=data['formaAplicacion'];
                        this.EdadArbolesLoteDos=data['EdadArbolesLoteDos'];
                        this.kgProyectadoLoteDos=data['kgProyectadoLoteDos'];             
                        break;
                    }       
                }
                }
            }
            this.selectProductor();
            this.selectFertilizante();
            this.selectFinca(this.productor_id);
            this.selectVereda();   
        }
        },        
        mounted() {
           this.listarProyeccion(1,this.buscar,this.criterio);
           this.listarProyeccionEx();
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