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
                        <i class="fa fa-align-justify"></i> Cultivos
                         <export-excel
                        class   = "button btn btn-success"
                        :data   = arrayCultivo
                        worksheet = "Cultivo"
                        name    = "cultivos.xls">
                        Excel
                        </export-excel>
                        <export-excel
                        class   = "button btn btn-success"
                        :data   = arrayCultivo
                        type="csv"
                        name    = "cultivos.xls">
                        csv
                        </export-excel>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre">Nombre</option>
                                      
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarCultivo(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarCultivo(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div class='table-responsive'>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Productor</th>
                                    <th>Finca</th>
                                    <th>Cadena</th>
                                    <th>Area Sembrada</th>
                                    <th>Fecha Siembra</th>
                                    <th>Total ventas año anterior(Kg)</th>
                                    <th>Precio promedio</th>
                                    <th>Total ventas año anterior($)</th>
                                    <th>Lugar de Venta</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="cultivo in arrayCultivo" :key="cultivo.id">
                                    <td v-text="cultivo.nombre_persona"></td>
                                    <td v-text="cultivo.nombre_finca"></td>                                    
                                    <td v-text="cultivo.nombre_cadena"></td>
                                    <td v-text="cultivo.areaSembrada"></td>
                                    <td v-text="cultivo.fechaSiembra"></td>
                                    <td v-text="cultivo.totalVentasKgAnioAnterior"></td>
                                    <td v-text="cultivo.precioPromedio"></td>
                                    <td v-text="cultivo.TotalVentasAnioAnterior"></td>
                                    <td v-text="cultivo.nombre_lugarVenta"></td>
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
                                    <label class="col-md-3 form-control-label" for="text-input">Cadena</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="cadena_id">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="cadena in arrayCadena" :key="cadena.id" :value="cadena.id" v-text="cadena.nombre" ></option>
                                      </select>  
                                    </div>
                                </div>                               

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="number-input">Area Sembrada</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="areaSembrada"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Fecha Siembra</label>
                                    <div class="col-md-9">
                                         <v-datepicker :inline="true" v-model="fechaSiembra "></v-datepicker>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="number-input">Numero Plantulas y Arboles</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="numeroPlantulasArboles"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="number-input">Total Ventas Año anterior(Kg)</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="totalVentasKgAnioAnterior"  class="form-control" placeholder="">
                                    </div>
                                </div>                               
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="number-input">Precio promedio</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="precioPromedio"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="number-input">Total Ventas año Anterior($)</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="TotalVentasAnioAnterior"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Lugar de Venta</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="lugarVenta_id">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="lugarVenta in arrayLugarVenta" :key="lugarVenta.id" :value="lugarVenta.id" v-text="lugarVenta.nombre" ></option>
                                      </select>  
                                    </div>
                                </div>                                  
                                <div v-show="errorCultivo" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjCultivo" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarCultivo()">Guardar</button>
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
    export default {
        data(){
            return{
                cultivo_id:0,
                productor_id:0,
                finca_id:0,
                cadena_id:0,
                areaSembrada :0,
                fechaSiembra :'',
                numeroPlantulasArboles :0,
                totalVentasKgAnioAnterior :0,
                precioPromedio :0,
                TotalVentasAnioAnterior:0,
                lugarVenta_id:0,
                arrayCultivo: [],
                modal: 0,
                tituloModal : '',
                tipoAccion:0,
                errorCultivo : 0,
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
                criterio: 'nombre',
                buscar: '',
                arrayProductor : [],
                arrayFinca : [],
                arrayCadena: [],
                arrayLugarVenta: []           
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
            listarCultivo(page,buscar,criterio){
                let me =this;
                var url ='cultivo?page='+page + '&buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayCultivo= respuesta.cultivos.data;
                    me.pagination=respuesta.pagination;
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
            selectCadena(){
                let me =this;
                var url ='cadena/selectCadena';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayCadena= respuesta.cadenas;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectLugarVenta(){
                let me =this;
                var url ='lugarVenta/selectLugarVenta';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayLugarVenta= respuesta.lugarVentas;
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
                me.listarCultivo(page,buscar,criterio);
            },
            registrarCultivo(){
            if(this.validarCultivo()){
                return;
            }
            let me=this;
            axios.post('cultivo/registrar',{
                'productor_id':this.productor_id,
                'finca_id':this.finca_id,
                'cadena_id':this.cadena_id,
                'areaSembrada':this.areaSembrada,
                'fechaSiembra':this.fechaSiembra,
                'numeroPlantulasArboles':this.numeroPlantulasArboles,
                'totalVentasKgAnioAnterior':this.totalVentasKgAnioAnterior,
                'precioPromedio':this.precioPromedio,
                'TotalVentasAnioAnterior':this.TotalVentasAnioAnterior,
                'lugarVenta_id':this.lugarVenta_id
            }).then(function (response) {
                    me.cerrarModal();
                    me.listarCultivo(1,'','nombre');
                })
                .catch(function (error) {
                    console.log(error);
                });

        },
            actualizarCultivo(){
            if(this.validarCultivo()){
                return;
            }
            let me=this;
            console.log(me);
            axios.put('cultivo/actualizar',{
                'id':this.cultivo_id,
                'productor_id':this.productor_id,
                'finca_id':this.finca_id,
                'cadena_id':this.cadena_id,
                'areaSembrada':this.areaSembrada,
                'fechaSiembra':this.fechaSiembra,
                'numeroPlantulasArboles':this.numeroPlantulasArboles,
                'totalVentasKgAnioAnterior':this.totalVentasKgAnioAnterior,
                'precioPromedio':this.precioPromedio,
                'TotalVentasAnioAnterior':this.TotalVentasAnioAnterior,
                'lugarVenta_id':this.lugarVenta_id
                
            }).then(function (response) {
                    console.log(response);
                    me.cerrarModal();
                    me.listarCultivo(1,'','nombre');
                })
                .catch(function (error) {
                    console.log(error);
                });
        },          
            validarCultivo(){
            this.errorCultivo=0;
            this.errorMostrarMsjCultivo=[];

            
            if(this.productor_id==0)this.errorMostrarMsjCultivo.push("Debe seleccionar un productor.");
            if(this.finca_id==0)this.errorMostrarMsjCultivo.push("Debe seleccionar una finca.");
            if(this.cadena_id==0)this.errorMostrarMsjCultivo.push("Debe seleccionar una cadena de valor.");
            if(this.lugarVenta_id==0)this.errorMostrarMsjCultivo.push("Debe seleccionar un lugar de venta.");
            if(this.errorMostrarMsjCultivo.length) this.errorCultivo=1;

            return this.errorCultivo;
        },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.productor_id=0;
                this.finca_id=0;
                this.cadena_id=0;
                this.areaSembrada=0;
                this.fechaSiembra='';
                this.numeroPlantulasArboles=0;
                this.totalVentasKgAnioAnterior=0;
                this.precioPromedio=0;
                this.TotalVentasAnioAnterior=0;
                this.lugarVenta_id=0;
		        this.errorCultivo=0;
        },
            abrirModal(modelo,accion,data = []){
            switch (modelo) {
                case "cultivo":
                {    
                switch (accion) {
                    case 'registrar':
                    {
                        this.modal = 1;
                        this.tituloModal = 'Registrar Historico Cultivo';
                        this.productor_id=0;
                        this.finca_id=0;
                        this.cadena_id=0;
                        this.areaSembrada=0;
                        this.fechaSiembra='';
                        this.numeroPlantulasArboles=0;
                        this.totalVentasKgAnioAnterior=0;
                        this.precioPromedio=0;
                        this.TotalVentasAnioAnterior=0;
                        this.lugarVenta_id=0;
                        this.tipoAccion=1;
                        break;
                    }    
                    case 'actualizar':
                    {
                        this.modal=1;
                        this.tituloModal='Actualizar Historico Cultivo';
                        this.tipoAccion=2;
                        this.cultivo_id=data['id'];
                        this.productor_id=data['productor_id'];
                        this.finca_id=data['finca_id'];
                        this.cadena_id=data['cadena_id'];
                        this.areaSembrada=data['areaSembrada'];
                        this.fechaSiembra=data['fechaSiembra'];
                        this.numeroPlantulasArboles=data['numeroPlantulasArboles'];
                        this.totalVentasKgAnioAnterior=data['totalVentasKgAnioAnterior'];
                        this.precioPromedio=data['precioPromedio'];
                        this.TotalVentasAnioAnterior=data['TotalVentasAnioAnterior'];
                        this.lugarVenta_id=data['lugarVenta_id'];
                        break;
                    }       
                }
                }
            }
            this.selectProductor();
            this.selectFinca(this.productor_id);
            this.selectCadena();
            this.selectLugarVenta();    
        }
        },        
        mounted() {
           this.listarCultivo(1,this.buscar,this.criterio);
           
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