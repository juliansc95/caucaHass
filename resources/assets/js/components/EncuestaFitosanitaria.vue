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
                        <i class="fa fa-align-justify"></i> Control Fitosanitario
                        <button type="button" @click="abrirModal('encuesta','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                        <export-excel
                        class   = "button btn btn-success"
                        :data   = arrayEncuestaEx
                        worksheet = "Control Fitosanitario"
                        name    = "fitosanitario.xls">
                        Excel
                        </export-excel>
                        <export-excel
                        class   = "button btn btn-success"
                        :data   = arrayEncuestaEx
                        type="csv"
                        name    = "fitosanitario.xls">
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
                                    <input type="text" v-model="buscar" @keyup.enter="listarEncuesta(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarEncuesta(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div class='table-responsive'>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Productor</th>
                                    <th>Finca</th>
                                    <th>Fecha de Control</th>
                                    <th>Producto Sembrado</th>
                                    <th>Lote</th>
                                    <th>Numero de plantas</th>
                                    <th>Producto Fitosanitario</th>
                                    <th>Cantidad Dosis</th>
                                    <th>Unidad</th>
                                    <th>Cantidad Aplicacion</th>
                                    <th>Unidad</th>
                                    <th>Equipo de Aplicacion</th>
                                    <th>Metodo de Aplicacion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="encuesta in arrayEncuesta" :key="encuesta.id">
                                    <td v-text="encuesta.nombre"></td>
                                    <td v-text="encuesta.nombre_finca"></td>                                    
                                    <td v-text="encuesta.fechaControl"></td>
                                    <td v-text="encuesta.productoSembrado"></td>
                                    <td v-text="encuesta.lote"></td>
                                    <td v-text="encuesta.numeroPlantas"></td>
                                    <td v-text="encuesta.nombre_producto"></td>
                                    <td v-text="encuesta.cantidad_dosis"></td>
                                    <td v-text="encuesta.unidad_dosis"></td>
                                    <td v-text="encuesta.cantidad_aplicacion"></td>
                                    <td v-text="encuesta.unidad_aplicaciones"></td>
                                    <td v-text="encuesta.equipo_aplicaciones"></td>
                                    <td v-text="encuesta.metodo_aplicaciones"></td>
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
                                        <input type="text" readonly class="form-control" v-model="nombre_productor">                
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
                                    <label class="col-md-3 form-control-label" for="text-input">Fecha de Control</label>
                                    <div class="col-md-9">
                                         <v-datepicker :inline="true" v-model="fechaControl "></v-datepicker>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Producto Sembrado</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="productoSembrado"  class="form-control" placeholder="">
                                    </div>
                                </div>                          
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="number-input">Numero de Lote</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="lote"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Linea</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="linea_id">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="linea in arrayLinea" :key="linea.id" :value="linea.id" v-text="linea.nombre" ></option>
                                      </select>  
                                    </div>
                                </div>  
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="number-input">Numero Plantas</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="numeroPlantas"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="">Producto Fitosanitario(*)</label>
                                    <div class="col-md-9">
                                    <v-select
                                        :on-search="selectProducto2"
                                        label="nombre"
                                        :options="arrayProductoFitosanitario"
                                        placeholder="Buscar Producto Fitosanitario..."
                                        :onChange="getDatosProducto"                                        
                                    >
                                    </v-select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="number-input">Cantidad Dosis</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="cantidad_dosis"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Unidad Dosis</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="unidad_dosis_id">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="dosis in arrayUnidadDosis" :key="dosis.id" :value="dosis.id" v-text="dosis.nombre" ></option>
                                      </select>  
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="number-input">Cantidad Aplicacion</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="cantidad_aplicacion"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Unidad Aplicacion</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="unidad_aplicaciones_id">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="aplicacion in arrayUnidadAplicaciones" :key="aplicacion.id" :value="aplicacion.id" v-text="aplicacion.nombre" ></option>
                                      </select>  
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Equipo Aplicacion</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="equipo_aplicaciones_id">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="equipo in arrayEquipoAplicaciones" :key="equipo.id" :value="equipo.id" v-text="equipo.nombre" ></option>
                                      </select>  
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Metodo Aplicacion</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="metodo_aplicaciones_id">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="metodo in arrayMetodoAplicaciones" :key="metodo.id" :value="metodo.id" v-text="metodo.nombre" ></option>
                                      </select>  
                                    </div>
                                </div>


                                <div v-show="errorEncuesta" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjEncuesta" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarEncuesta()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarCultivo()">Actualizar</button>
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
                encuesta_fitosanitaria_id:0,
                productor_id:0,
                nombre_productor:'',
                finca_id:0,
                fechaControl:'',
                productoSembrado :'',
                lote :0,
                linea_id :0,
                numeroPlantas :0,
                producto_fitosanitario_id :0,
                cantidad_dosis:0,
                unidad_dosis_id:0,
                cantidad_aplicacion:0,
                unidad_aplicaciones_id:0,
                equipo_aplicaciones_id:0,
                metodo_aplicaciones_id:0,
                arrayEncuesta: [],
                arrayEncuestaEx: [],
                modal: 0,
                tituloModal : '',
                tipoAccion:0,
                errorEncuesta : 0,
                errorMostrarMsjEncuesta:[],
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
                arrayLinea: [],
                arrayProductoFitosanitario: [],
                arrayUnidadDosis: [],
                arrayUnidadAplicaciones: [], 
                arrayEquipoAplicaciones: [], 
                arrayMetodoAplicaciones:[]                       
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
            listarEncuesta(page,buscar,criterio){
                let me =this;
                var url ='fitosanitaria?page='+page + '&buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayEncuesta= respuesta.encuestas.data;
                    me.pagination=respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            listarEncuestaEx(){
                let me =this;
                var url ='fitosanitaria/excel';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayEncuestaEx= respuesta.encuestas;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectProducto2(search,loading){
                let me=this;
                loading(true)

                var url= 'producto/selectProducto2?filtro='+search;
                axios.get(url).then(function (response) {
                    let respuesta = response.data;
                    q: search
                    me.arrayProductoFitosanitario=respuesta.productos;
                    loading(false)
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getDatosProducto(val1){
                let me = this;
                me.loading = true;
                me.producto_fitosanitario_id = val1.id;
            },
            selectProductor(){
                let me =this;
                var url ='fitosanitaria/id';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayProductor= respuesta.personas;
                    me.nombre_productor=me.arrayProductor[0]['nombre'];
                    me.productor_id=me.arrayProductor[0]['id'];
                })
                .catch(function (error) {
                    console.log(error);
                })
            },
             selectFinca(){
                let me =this;
                var url ='finca/selectFincaEncuesta';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayFinca= respuesta.fincas;
                })
                .catch(function (error) {
                    console.log(error);
                })
            },
            selectLinea(){
                let me =this;
                var url ='linea/selectLinea';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayLinea= respuesta.lineas;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectUnidadDosis(){
                let me =this;
                var url ='unidadDosis/selectDosis';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayUnidadDosis= respuesta.dosis;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectUnidadAplicacion(){
                let me =this;
                var url ='unidadAplicacion/selectUnidad';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayUnidadAplicaciones= respuesta.unidades;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectEquipoAplicacion(){
                let me =this;
                var url ='equipoAplicacion/selectEquipo';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayEquipoAplicaciones= respuesta.equipos;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectMetodoAplicacion(){
                let me =this;
                var url ='metodoAplicacion/selectMetodo';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayMetodoAplicaciones= respuesta.metodos;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza a la pagina actual
                me.pagination.current_page = page;
                //Envia la peticion para visualizar la data de esa pagina
                me.listarEncuesta(page,buscar,criterio);
            },
            registrarEncuesta(){
            if(this.validarEncuesta()){
                return;
            }
            let me=this;
            axios.post('fitosanitaria/registrar',{
                'finca_id':this.finca_id,
                'fechaControl':this.fechaControl,
                'productoSembrado':this.productoSembrado,
                'lote':this.lote,
                'linea_id':this.linea_id,
                'numeroPlantas':this.numeroPlantas,
                'producto_fitosanitario_id':this.producto_fitosanitario_id,
                'cantidad_dosis':this.cantidad_dosis,
                'unidad_dosis_id':this.unidad_dosis_id,
                'cantidad_aplicacion':this.cantidad_aplicacion,
                'unidad_aplicaciones_id':this.unidad_aplicaciones_id,
                'equipo_aplicaciones_id':this.equipo_aplicaciones_id,
                'metodo_aplicaciones_id':this.metodo_aplicaciones_id
            }).then(function (response) {
                    me.cerrarModal();
                    me.listarEncuesta(1,'','personas');
                })
                .catch(function (error) {
                    console.log(error);
                });

        },
        cargarPdf(){
                window.open('http://gestion.asofrut.org/fitosanitaria/listarPdf');
            },    
            validarEncuesta(){
            this.errorEncuesta=0;
            this.errorMostrarMsjEncuesta=[];

            if(this.finca_id==0)this.errorMostrarMsjEncuesta.push("Debe seleccionar una finca.");
            if(this.linea_id==0)this.errorMostrarMsjEncuesta.push("Debe seleccionar una linea.");
            if(this.producto_fitosanitario_id==0)this.errorMostrarMsjEncuesta.push("Debe seleccionar un producto fitosanitario.");
            if(this.unidad_aplicaciones_id==0)this.errorMostrarMsjEncuesta.push("Debe seleccionar una unidad de medida de aplicacion.");
            if(this.unidad_dosis_id==0)this.errorMostrarMsjEncuesta.push("Debe seleccionar una unidad de medida de la dosis.");
            if(this.equipo_aplicaciones_id==0)this.errorMostrarMsjEncuesta.push("Debe seleccionar uno de los equipos de aplicacion.");
            if(this.metodo_aplicaciones_id==0)this.errorMostrarMsjEncuesta.push("Debe seleccionar un metodo de aplicacion.");
            if(this.errorMostrarMsjEncuesta.length) this.errorEncuesta=1;

            return this.errorEncuesta;
        },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.finca_id=0;
                this.fechaControl='';
                this.productoSembrado='';
                this.lote=0;
                this.linea_id=0;
                this.numeroPlantas=0;
                this.producto_fitosanitario_id=0;
                this.cantidad_dosis=0;
                this.unidad_dosis_id=0;
                this.cantidad_aplicacion=0;
                this.unidad_aplicaciones_id=0;
                this.equipo_aplicaciones_id=0;
                this.metodo_aplicaciones_id=0;
		        this.errorEncuesta=0;
        },
            abrirModal(modelo,accion,data = []){
            switch (modelo) {
                case "encuesta":
                {    
                switch (accion) {
                    case 'registrar':
                    {
                        this.modal = 1;
                        this.tituloModal = 'Registrar control fitosanitario';
                        this.finca_id=0;
                        this.fechaControl='';
                        this.productoSembrado='';
                        this.lote=0;
                        this.linea_id=0;
                        this.numeroPlantas=0;
                        this.producto_fitosanitario_id=0;
                        this.cantidad_dosis=0;
                        this.unidad_dosis_id=0;
                        this.cantidad_aplicacion=0;
                        this.unidad_aplicaciones_id=0;
                        this.equipo_aplicaciones_id=0;
                        this.metodo_aplicaciones_id=0;
                        this.tipoAccion=1;
                        break;
                    }    
                }
                }
            }
            this.selectProductor();
            this.selectFinca();
            this.selectLinea();
            this.selectUnidadDosis();
            this.selectUnidadAplicacion();
            this.selectMetodoAplicacion();
            this.selectEquipoAplicacion();    
        }
        },        
        mounted() {
           this.listarEncuesta(1,this.buscar,this.criterio);
           this.listarEncuestaEx();
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