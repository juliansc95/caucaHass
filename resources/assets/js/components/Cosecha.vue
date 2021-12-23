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
                        <i class="fa fa-align-justify"></i> Cosecha
                        <button type="button" @click="abrirModal('cosecha','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                         <export-excel
                            class   = "button btn btn-success"
                            :data   = arrayCosechaEx
                            worksheet = "Cosechas"
                            name    = "cosecha.xls">
                            Excel
                            </export-excel>
                            <export-excel
                            class   = "button btn btn-success"
                            :data   = arrayCosechaEx
                            type="csv"
                            name    = "cosecha.xls">
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
                                    <input type="text" v-model="buscar" @keyup.enter="listarCosecha(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarCosecha(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
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
                                    <th>Tipo de Empaque</th>
                                    <th>Tipo de Transporte</th>
                                    <th>Kilogramos Mensuales Mora de Primera</th>
                                    <th>Kilogramos Mensuales Mora de Segunda</th>
                                    <th>Meses de Produccion en el año</th>
                                    <th>Tiempo de Pago</th>
                                    <th>Tipo de Pago</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr v-for="cosecha in arrayCosecha" :key="cosecha.id">
                                    <td>
                                        <button type="button" @click="abrirModal('cosecha','actualizar',cosecha)" class="btn btn-warning btn-sm">
                                          <i class="icon-eye"></i>
                                        </button> &nbsp;
                                    </td> 
                                    <td v-text="cosecha.nombre"></td>
                                    <td v-text="cosecha.nombre_finca"></td> 
                                    <td v-text="cosecha.empaque"></td> 
                                    <td v-text="cosecha.transporte"></td> 
                                    <td v-text="cosecha.kilogramoMoraPrimera"></td> 
                                    <td v-text="cosecha.kilogramoMoraSegunda"></td> 
                                    <td v-text="cosecha.mesesProduccion"></td> 
                                    <td v-text="cosecha.tiempoPago"></td> 
                                    <td v-text="cosecha.tipoPago"></td> 
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
                                    <label class="col-md-3 form-control-label" for="text-input">Frecuencia de cosecha de fruta(dias)</label>
                                    <div class="col-md-9">
                                       <input type="number" v-model="frecuencia"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Realiza clasificacion de fruta</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="clasificacion">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                             <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Tipo de empaque</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="empaque">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                             <option value="Canastilla">Canastilla</option>
                                            <option value="Baldes">Baldes</option>
                                      </select>  
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Tipo de Transporte</label>
                                    <div class="col-md-9">
                                       <input type="text" v-model="transporte"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Kilogramos producidos mensuales(Mora de Primera)</label>
                                    <div class="col-md-9">
                                       <input type="number" v-model="kilogramoMoraPrimera"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Kilogramos producidos mensuales(Mora de Segunda)</label>
                                    <div class="col-md-9">
                                       <input type="number" v-model="kilogramoMoraSegunda"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Meses de Produccion en el año</label>
                                    <div class="col-md-9">
                                       <input type="number" v-model="mesesProduccion"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Clientes</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="clientes">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                             <option value="Plaza de mercado">Plaza de mercado</option>
                                             <option value="Intermediarios">Intermediarios</option>
                                             <option value="Asociacion">Asociacion</option>
                                             <option value="Otros">Otros</option>
                                      </select>  
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Tiempo de Pago</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="tiempoPago">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                             <option value="Contraentrega">Contraentrega</option>
                                             <option value="Semanal">Semanal</option>
                                             <option value="Quincenal">Quincenal</option>
                                             <option value="Mensual">Mensual</option>
                                      </select>  
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Tipo de Pago</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="tipoPago">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                             <option value="Efectivo">Efectivo</option>
                                             <option value="Cheque">Cheque</option>
                                             <option value="Transferencia">Transferencia</option>
                                      </select>  
                                    </div>
                                </div>
                                <div v-show="errorCosecha" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjCosecha" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarCosecha()">Guardar</button>
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
                frecuencia:0,
                clasificacion:'Seleccione',
                empaque:'Seleccione',
                transporte:'',
                kilogramoMoraPrimera:0,
                kilogramoMoraSegunda:0,
                mesesProduccion:0,
                clientes:'Seleccione',
                tiempoPago:'Seleccione',
                tipoPago:'Seleccione',
                arrayCosecha: [],
                arrayCosechaEx: [],
                modal: 0,
                tituloModal : '',
                tipoAccion:0,
                errorCosecha : 0,
                errorMostrarMsjCosecha:[],
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
            listarCosecha(page,buscar,criterio){
                let me =this;
                var url ='cosecha?page='+page + '&buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayCosecha= respuesta.cosechas.data;
                    me.pagination=respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            listarCosechaEx(){
                let me =this;
                var url ='cosecha/excel';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayCosechaEx= respuesta.cosechas;
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
                me.listarCosecha(page,buscar,criterio);
            },
            registrarCosecha(){
            if(this.validarCosecha()){
                return;
            }
            let me=this;
            axios.post('cosecha/registrar',{
                'productor_id':this.productor_id,
                'finca_id':this.finca_id,
                'frecuencia':this.frecuencia,
                'clasificacion':this.clasificacion,
                'empaque':this.empaque,
                'transporte':this.transporte,
                'kilogramoMoraPrimera':this.kilogramoMoraPrimera,
                'kilogramoMoraSegunda':this.kilogramoMoraSegunda,
                'mesesProduccion':this.mesesProduccion,
                'clientes':this.clientes,
                'tiempoPago':this.tiempoPago,
                'tipoPago':this.tipoPago                          
            }).then(function (response) {
                    me.cerrarModal();
                    me.listarCosecha(1,'','personas');
                })
                .catch(function (error) {
                    console.log(error);
                });

        },
        cargarPdf(){
                window.open('http://gestion.asofrut.org/cosecha/listarPdf');
            },    
            validarCosecha(){
            this.errorCosecha=0;
            this.errorMostrarMsjCosecha=[];
            if(this.productor_id==0)this.errorMostrarMsjCosecha.push("Debe seleccionar un productor");
            if(this.finca_id==0)this.errorMostrarMsjCosecha.push("Debe seleccionar una finca.");
            if(this.errorMostrarMsjCosecha.length) this.errorCosecha=1;

            return this.errorCosecha;
        },
            cerrarModal(){
                        this.modal=0;
                        this.tituloModal='';
                        this.productor_id=0;
                        this.finca_id=0;
                        this.frecuencia=0;
                        this.clasificacion='Seleccione';
                        this.empaque='Seleccione';
                        this.transporte='';
                        this.kilogramoMoraPrimera=0;
                        this.kilogramoMoraSegunda=0;
                        this.mesesProduccion=0;
                        this.clientes='Seleccione';
                        this.tiempoPago='Seleccione';
                        this.tipoPago='Seleccione';
                        this.errorCosecha=0;
        },
            abrirModal(modelo,accion,data = []){
            switch (modelo) {
                case "cosecha":
                {    
                switch (accion) {
                    case 'registrar':
                    {
                        this.modal = 1;
                        this.tituloModal = 'Registrar cosecha';
                        this.productor_id=0;
                        this.finca_id=0;
                        this.frecuencia=0;
                        this.clasificacion='Seleccione';
                        this.empaque='Seleccione';
                        this.transporte='';
                        this.kilogramoMoraPrimera=0;
                        this.kilogramoMoraSegunda=0;
                        this.mesesProduccion=0;
                        this.clientes='Seleccione';
                        this.tiempoPago='Seleccione';
                        this.tipoPago='Seleccione';
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
                        this.frecuencia=data['frecuencia']
                        this.clasificacion=data['clasificacion'];
                        this.empaque=data['empaque'];
                        this.transporte=data['transporte'];
                        this.kilogramoMoraPrimera=data['kilogramoMoraPrimera'];
                        this.kilogramoMoraSegunda=data['kilogramoMoraSegunda'];
                        this.mesesProduccion=data['mesesProduccion'];
                        this.clientes=data['clientes'];
                        this.tiempoPago=data['tiempoPago'];
                        this.tipoPago=data['tipoPago'];
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
           this.listarCosecha(1,this.buscar,this.criterio);
           this.listarCosechaEx();
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