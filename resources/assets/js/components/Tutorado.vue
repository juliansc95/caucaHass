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
                        <i class="fa fa-align-justify"></i> Tutorado
                        <button type="button" @click="abrirModal('tutorado','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                         <export-excel
                            class   = "button btn btn-success"
                            :data   = arrayTutoradoEx
                            worksheet = "Tutorado"
                            name    = "tutorado.xls">
                            Excel
                            </export-excel>
                            <export-excel
                            class   = "button btn btn-success"
                            :data   = arrayTutoradoEx
                            type="csv"
                            name    = "tutorado.xls">
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
                                    <input type="text" v-model="buscar" @keyup.enter="listarTutorado(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarTutorado(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
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
                                    <th>Tutorado</th>
                                    <th>Tipo tutorado</th>
                                    <th>Tipo de madera</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr v-for="tutorado in arrayTutorado" :key="tutorado.id">
                                    <td>
                                        <button type="button" @click="abrirModal('tutorado','actualizar',tutorado)" class="btn btn-warning btn-sm">
                                          <i class="icon-eye"></i>
                                        </button> &nbsp;
                                    </td> 
                                    <td v-text="tutorado.nombre"></td>
                                    <td v-text="tutorado.nombre_finca"></td> 
                                    <td v-text="tutorado.tutorado"></td> 
                                    <td v-text="tutorado.tipoTutorado"></td> 
                                    <td v-text="tutorado.tipoMadera"></td> 
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
                                    <label class="col-md-3 form-control-label" for="text-input">Tiene tutorado</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="tutorado">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                </div>      
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Tipo de tutorado</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="tipoTutorado">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Doble T">Doble T</option>
                                            <option value="T sencilla">T sencilla</option>
                                            <option value="Espaldera sencilla">Espaldera sencilla</option>
                                            <option value="Espaldera doble">Espaldera doble</option>
                                      </select>  
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Tipo de madera usada</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="tipoMadera">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Nativo">Especie de arbol Nativo</option>
                                            <option value="Maderable">Maderable</option>
                                            <option value="Guadua">Guadua</option>
                                            <option value="Postre en concreto">Poste en concreto</option>
                                      </select>  
                                    </div>
                                </div>           
                                <div v-show="errorTutorado" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjTutorado" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarTutorado()">Guardar</button>
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
                tutorado:'Seleccione', 
                tipoTutorado:'Seleccione',
                tipoMadera:'Seleccione',             
                arrayTutorado: [],
                arrayTutorado2: [],
                modal: 0,
                tituloModal : '',
                tipoAccion:0,
                errorTutorado : 0,
                errorMostrarMsjTutorado:[],
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
            listarTutorado(page,buscar,criterio){
                let me =this;
                var url ='tutorado?page='+page + '&buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayTutorado= respuesta.tutorados.data;
                    me.pagination=respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            listarTutoradoEx(){
                let me =this;
                var url ='tutorado/excel';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayTutoradoEx= respuesta.tutorados;
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
                me.listarTutorado(page,buscar,criterio);
            },
            registrarTutorado(){
            if(this.validarTutorado()){
                return;
            }
            let me=this;
            axios.post('tutorado/registrar',{
                'productor_id':this.productor_id,
                'finca_id':this.finca_id,
                'tutorado':this.tutorado, 
                'tipoTutorado':this.tipoTutorado,
                'tipoMadera':this.tipoMadera          
            }).then(function (response) {
                    me.cerrarModal();
                    me.listarTutorado(1,'','personas');
                })
                .catch(function (error) {
                    console.log(error);
                });

        },
        cargarPdf(){
                window.open('http://gestion.asofrut.org/tutorado/listarPdf');
            },    
            validarTutorado(){
            this.errorTutorado=0;
            this.errorMostrarMsjTutorado=[];
            if(this.productor_id==0)this.errorMostrarMsjTutorado.push("Debe seleccionar un productor");
            if(this.finca_id==0)this.errorMostrarMsjTutorado.push("Debe seleccionar una finca.");
            if(this.errorMostrarMsjTutorado.length) this.errorTutorado=1;
            return this.errorTutorado;
        },
            cerrarModal(){
                        this.modal=0;
                        this.tituloModal='';
                        this.productor_id=0;
                        this.tutorado='Seleccione';
                        this.tipoTutorado='Seleccione';
                        this.tipoMadera='Seleccione';                             
                        this.errorTutorado=0;
        },
            abrirModal(modelo,accion,data = []){
            switch (modelo) {
                case "tutorado":
                {    
                switch (accion) {
                    case 'registrar':
                    {
                        this.modal = 1;
                        this.tituloModal = 'Registrar Tutorado';
                        this.productor_id=0;
                        this.finca_id=0;
                        this.tutorado='Seleccione';
                        this.tipoTutorado='Seleccione';
                        this.tipoMadera='Seleccione';
                        this.tipoAccion=1;
                        break;
                    }  case 'actualizar':
                    {
                        this.modal=1;
                        this.tituloModal='Detalle Predio cultivo';
                        this.tipoAccion=2;
                        this.tutorado_id=data['id'];
                        this.productor_id=data['productor_id'];
                        this.finca_id=data['finca_id'];
                        this.tutorado=data['tutorado'];
                        this.tipoTutorado=data['tipoTutorado'];
                        this.tipoMadera=data['tipoMadera'];
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
           this.listarTutorado(1,this.buscar,this.criterio);
           this.listarTutoradoEx();
           
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