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
                        <i class="fa fa-align-justify"></i> Riego
                        <button type="button" @click="abrirModal('riego','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                         <export-excel
                            class   = "button btn btn-success"
                            :data   = arrayRiegoEx
                            worksheet = "Riego"
                            name    = "riego.xls">
                            Excel
                            </export-excel>
                            <export-excel
                            class   = "button btn btn-success"
                            :data   = arrayRiegoEx
                            type="csv"
                            name    = "riego.xls">
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
                                    <input type="text" v-model="buscar" @keyup.enter="listarRiego(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarRiego(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
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
                                    <th>Riego</th>
                                    <th>Forma adquisicion</th>
                                    <th>Frecuencia(dias)</th>
                                    <th>Tipo de riego</th>
                                    <th>Tiempo de riego</th>
                                    <th>Numero de Jornales</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr v-for="riego in arrayRiego" :key="riego.id">
                                    <td>
                                        <button type="button" @click="abrirModal('riego','actualizar',riego)" class="btn btn-warning btn-sm">
                                          <i class="icon-eye"></i>
                                        </button> &nbsp;
                                    </td> 
                                    <td v-text="riego.nombre"></td>
                                    <td v-text="riego.nombre_finca"></td> 
                                    <td v-text="riego.riego"></td> 
                                    <td v-text="riego.adquisicion"></td> 
                                    <td v-text="riego.frecuencia"></td>
                                    <td v-text="riego.tipo"></td> 
                                    <td v-text="riego.tiempo"></td> 
                                    <td v-text="riego.jornales"></td>  
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
                                    <label class="col-md-3 form-control-label" for="text-input">Tiene riego</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="riego">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                </div>      
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Forma de adquisicion</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="adquisicion">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Inversion propia">Inversion propia</option>
                                            <option value="Financiado">Financiado</option>
                                      </select>  
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Frecuencia de riego(dias)</label>
                                    <div class="col-md-9">
                                       <input type="number" v-model="frecuencia"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Tipo de riego</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="tipo">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Aspersion">Aspersion</option>
                                            <option value="Goteo">Goteo</option>
                                            <option value="Nebulizador">Nebulizador</option>
                                            <option value="Riego Manual">Riego Manual</option>
                                      </select>  
                                    </div>
                                </div>
                                  <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Tiempo de riego(minutos)</label>
                                    <div class="col-md-9">
                                       <input type="number" v-model="tiempo"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Jornales por riego</label>
                                    <div class="col-md-9">
                                       <input type="number" v-model="jornales"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Tiene reservorio?</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="reservorio">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Capacidad Reservorio(Litros)</label>
                                    <div class="col-md-9">
                                       <input type="number" v-model="capacidadR"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Diferencial de Altura(Metros)</label>
                                    <div class="col-md-9">
                                       <input type="number" v-model="alturaR"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div v-show="errorRiego" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjRiego" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarRiego()">Guardar</button>
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
                riego_id:0,
                productor_id:0,
                finca_id:0,       
                riego:'Seleccione', 
                adquisicion:'Seleccione',
                frecuencia:0,
                tipo:'Seleccione',
                tiempo:0,
                jornales:0, 
                reservorio:'Seleccione',
                capacidadR:0,
                alturaR:0,           
                arrayRiego: [],
                arrayRiegoEx: [],
                modal: 0,
                tituloModal : '',
                tipoAccion:0,
                errorRiego : 0,
                errorMostrarMsjRiego:[],
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
            listarRiego(page,buscar,criterio){
                let me =this;
                var url ='riego?page='+page + '&buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayRiego= respuesta.riegos.data;
                    me.pagination=respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
             listarRiegoEx(){
                let me =this;
                var url ='riego/excel';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayRiegoEx= respuesta.riegos;
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
                me.listarRiego(page,buscar,criterio);
            },
            registrarRiego(){
            if(this.validarRiego()){
                return;
            }
            let me=this;
            axios.post('riego/registrar',{
                'productor_id':this.productor_id,
                'finca_id':this.finca_id,
                'riego':this.riego, 
                'adquisicion':this.adquisicion,
                'frecuencia':this.frecuencia,
                'tipo':this.tipo,
                'tiempo':this.tiempo,
                'jornales':this.jornales,
                'reservorio':this.reservorio,
                'capacidadR':this.capacidadR,
                'alturaR':this.alturaR              
            }).then(function (response) {
                    me.cerrarModal();
                    me.listarRiego(1,'','personas');
                })
                .catch(function (error) {
                    console.log(error);
                });

        },
        cargarPdf(){
                window.open('http://gestion.asofrut.org/riego/listarPdf');
            },    
            validarRiego(){
            this.errorRiego=0;
            this.errorMostrarMsjRiego=[];
            if(this.productor_id==0)this.errorMostrarMsjRiego.push("Debe seleccionar un productor");
            if(this.finca_id==0)this.errorMostrarMsjRiego.push("Debe seleccionar una finca.");
            if(this.errorMostrarMsjRiego.length) this.errorRiego=1;
            return this.errorRiego;
        },
            cerrarModal(){
                        this.modal=0;
                        this.tituloModal='';
                        this.productor_id=0;
                        this.riego='Seleccione';
                        this.adquisicion='Seleccione';
                        this.frecuencia=0;
                        this.tipo='Seleccione';
                        this.tiempo=0;
                        this.jornales=0; 
                        this.reservorio='Seleccione';
                        this.capacidadR=0;
                        this.alturaR=0;                                     
                        this.errorRiego=0;
        },
            abrirModal(modelo,accion,data = []){
            switch (modelo) {
                case "riego":
                {    
                switch (accion) {
                    case 'registrar':
                    {
                        this.modal = 1;
                        this.tituloModal = 'Registrar Riego';
                        this.productor_id=0;
                        this.finca_id=0;
                        this.riego='Seleccione';
                        this.adquisicion='Seleccione';
                        this.frecuencia=0;
                        this.tipo='Seleccione';
                        this.tiempo=0;
                        this.jornales=0;
                        this.reservorio='Seleccione';
                        this.capacidadR=0;
                        this.alturaR=0;              
                        this.tipoAccion=1;
                        break;
                    }  case 'actualizar':
                    {
                        this.modal=1;
                        this.tituloModal='Detalle Riego';
                        this.tipoAccion=2;
                        this.riego_id=data['id'];
                        this.productor_id=data['productor_id'];
                        this.finca_id=data['finca_id'];
                        this.riego=data['riego'];
                        this.adquisicion=data['adquisicion'];
                        this.frecuencia=data['frecuencia'];
                        this.tipo=data['tipo'];
                        this.tiempo=data['tiempo'];
                        this.jornales=data['jornales'];
                        this.reservorio=data['reservorio'];
                        this.capacidadR=data['capacidadR'];
                        this.alturaR=data['alturaR'];              
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
           this.listarRiego(1,this.buscar,this.criterio);
           this.listarRiegoEx();
           
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