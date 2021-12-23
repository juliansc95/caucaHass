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
                        <i class="fa fa-align-justify"></i> Conservacion de suelos
                        <button type="button" @click="abrirModal('suelo','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                         <export-excel
                            class   = "button btn btn-success"
                            :data   = arraySueloEx
                            worksheet = "Suelos"
                            name    = "suelo.xls">
                            Excel
                            </export-excel>
                            <export-excel
                            class   = "button btn btn-success"
                            :data   = arraySueloEx
                            type="csv"
                            name    = "suelo.xls">
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
                                    <input type="text" v-model="buscar" @keyup.enter="listarSuelo(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarSuelo(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
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
                                    <th>Tipo trazado</th>
                                    <th>Control de arvenses</th>
                                    <th>Frecuencia de control(meses)</th>
                                    <th>Nombre herbicida</th>
                                    <th>Dosis de aplicacion por litro</th>  
                                    <th>Frecuencia aplicacion herbicida</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr v-for="suelo in arraySuelo" :key="suelo.id">
                                    <td>
                                        <button type="button" @click="abrirModal('suelo','actualizar',suelo)" class="btn btn-warning btn-sm">
                                          <i class="icon-eye"></i>
                                        </button> &nbsp;
                                    </td> 
                                    <td v-text="suelo.nombre"></td>
                                    <td v-text="suelo.nombre_finca"></td> 
                                    <td v-text="suelo.curvasNivel"></td> 
                                    <td v-text="suelo.controlArvenses"></td> 
                                    <td v-text="suelo.frecuencia"></td> 
                                    <td v-text="suelo.herbicida"></td> 
                                    <td v-text="suelo.dosisAplicacionCal"></td> 
                                    <td v-text="suelo.frecuenciaHerbicida"></td> 
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
                                    <label class="col-md-3 form-control-label" for="text-input">Tipo de trazado</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="curvasNivel">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Curvas de nivel">Curvas de nivel</option>
                                            <option value="Curvas en contorno">Curvas en contorno</option>
                                            <option value="Trazado a favor de la pendiente">Trazado a favor de la pendiente</option>
                                      </select>  
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Como realiza el control de arvenses</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="controlArvenses">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                             <option value="Manual">Manual</option>
                                            <option value="Guadaña">Guadaña</option>
                                            <option value="Herbicida">Herbicida</option>
                                            <option value="Otro">Otro</option>
                                      </select>  
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Frecuencia de control(meses)
                                    </label>
                                    <div class="col-md-9">
                                       <input type="number" v-model="frecuencia"  class="form-control" placeholder="">
                                    </div>
                                </div>                               
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Cual herbicida usa
                                    </label>
                                    <div class="col-md-9">
                                       <input type="text" v-model="herbicida"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Dosis de aplicacion por litro
                                    </label>
                                    <div class="col-md-9">
                                       <input type="number" v-model="dosisAplicacionCal"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Frecuencia Aplicacion herbicida(meses)
                                    </label>
                                    <div class="col-md-9">
                                       <input type="number" v-model="frecuenciaHerbicida"  class="form-control" placeholder="">
                                    </div>
                                </div>                                    
                                <div v-show="errorSuelo" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjSuelo" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarSuelo()">Guardar</button>
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
                suelo_id:0,
                productor_id:0,
                finca_id:0,
                curvasNivel:'Seleccione',
                controlArvenses:'Seleccione',
                frecuencia:0,
                herbicida:'', 
                dosisAplicacionCal:0,
                frecuenciaHerbicida:0,
                arraySuelo: [],
                arraySueloEx: [],
                modal: 0,
                tituloModal : '',
                tipoAccion:0,
                errorSuelo : 0,
                errorMostrarMsjSuelo:[],
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
            listarSuelo(page,buscar,criterio){
                let me =this;
                var url ='suelo?page='+page + '&buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arraySuelo= respuesta.suelos.data;
                    me.pagination=respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            listarSueloEx(){
                let me =this;
                var url ='suelo/excel';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arraySueloEx= respuesta.suelos;
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
                me.listarSuelo(page,buscar,criterio);
            },
            registrarSuelo(){
            if(this.validarSuelo()){
                return;
            }
            let me=this;
            axios.post('suelo/registrar',{
                'productor_id':this.productor_id,
                'finca_id':this.finca_id,
                'curvasNivel':this.curvasNivel,
                'controlArvenses':this.controlArvenses,
                'frecuencia':this.frecuencia,
                'herbicida':this.herbicida, 
                'dosisAplicacionCal':this.dosisAplicacionCal,
                'frecuenciaHerbicida':this.frecuenciaHerbicida
            }).then(function (response) {
                    me.cerrarModal();
                    me.listarSuelo(1,'','personas');
                })
                .catch(function (error) {
                    console.log(error);
                });

        },
            cargarPdf(){
                window.open('http://gestion.asofrut.org/suelo/listarPdf');
            },    
            validarSuelo(){
            this.errorSuelo=0;
            this.errorMostrarMsjSuelo=[];
            if(this.productor_id==0)this.errorMostrarMsjSuelo.push("Debe seleccionar un productor");
            if(this.finca_id==0)this.errorMostrarMsjSuelo.push("Debe seleccionar una finca.");
            if(this.errorMostrarMsjSuelo.length) this.errorSuelo=1;

            return this.errorSuelo;
        },
            cerrarModal(){
                        this.modal=0;
                        this.tituloModal='';
                        this.productor_id=0;
                        this.finca_id=0;
                        this.curvasNivel='Seleccione';
                        this.controlArvenses='Seleccione';
                        this.frecuencia=0;
                        this.herbicida='', 
                        this.dosisAplicacionCal=0;
                        this.frecuenciaHerbicida=0; 
        },
            abrirModal(modelo,accion,data = []){
            switch (modelo) {
                case "suelo":
                {    
                switch (accion) {
                    case 'registrar':
                    {
                        this.modal = 1;
                        this.tituloModal = 'Registrar conservacion de suelos';
                        this.productor_id=0;
                        this.finca_id=0;
                        this.curvasNivel='Seleccione';
                        this.controlArvenses='Seleccione';
                        this.frecuencia=0;
                        this.herbicida='', 
                        this.dosisAplicacionCal=0;
                        this.frecuenciaHerbicida=0;
                        this.tipoAccion=1;
                        break;
                    }  case 'actualizar':
                    {
                        this.modal=1;
                        this.tituloModal='Detalle conservacion de suelos';
                        this.tipoAccion=2;
                        this.suelo_id=data['id'];
                        this.productor_id=data['productor_id'];
                        this.finca_id=data['finca_id'];
                        this.curvasNivel=data['curvasNivel'];
                        this.controlArvenses=data['controlArvenses'];
                        this.frecuencia=data['frecuencia'];
                        this.herbicida=data['herbicida'], 
                        this.dosisAplicacionCal=data['dosisAplicacionCal'];
                        this.frecuenciaHerbicida=data['frecuenciaHerbicida'];
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
           this.listarSuelo(1,this.buscar,this.criterio);
           this.listarSueloEx();
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