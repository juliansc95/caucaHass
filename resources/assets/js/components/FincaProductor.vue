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
                        <i class="fa fa-align-justify"></i> Fincas
                         <export-excel
                    class   = "button btn btn-success" 
                    :data   = arrayFinca
                    worksheet = "Fincas"
                    name    = "fincas.xls">
                    Excel
                   </export-excel>
                    <export-excel
                    class   = "button btn btn-success"
                    :data   = arrayFinca
                    type="csv"
                    name    = "fincas.xls">
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
                                    <input type="text" v-model="buscar" @keyup.enter="listarFinca(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarFinca(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div class='table-responsive'>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Productor</th>
                                    <th>Area Predio</th>
                                    <th>Distancia al lote</th>
                                    <th>Distancia del lote a la via</th>
                                    <th>Latitud Predio</th>
                                    <th>Longitud Predio</th>
                                    <th>Altitud Predio</th>
                                    <th>Vereda</th>
                                    <th>Resguardo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="finca in arrayFinca" :key="finca.id">
                                    <td v-text="finca.nombre"></td>
                                    <td v-text="finca.nombre_persona"></td>                                    
                                    <td v-text="finca.areaPredio"></td>
                                    <td v-text="finca.distanciaAlLote"></td>
                                    <td v-text="finca.distanciaLoteVia"></td>
                                    <td v-text="finca.latitudPredio"></td>
                                    <td v-text="finca.longitudPredio"></td>
                                    <td v-text="finca.altitudPredio"></td>
                                    <td v-text="finca.nombre_vereda"></td>
                                    <td v-text="finca.nombre_resguardo"></td>
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
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombre"  class="form-control" placeholder="Nombre de la finca">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Productor</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="productor_id">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="productor_id in arrayProductor" :key="productor_id.id" :value="productor_id.id" v-text="productor_id.nombre" ></option>
                                      </select>  
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Linea</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="linea_id">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="linea_id in arrayLinea" :key="linea_id.id" :value="linea_id.id" v-text="linea_id.nombre" ></option>
                                      </select>  
                                    </div>
                                </div>                               

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="number-input">Area predio</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="areaPredio"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="number-input">Latitud Predio</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="latitudPredio"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="number-input">Longitud Predio</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="longitudPredio"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="number-input">Altitud Predio</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="altitudPredio"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Departamento</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="departamento_id">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="departamento in arrayDepartamento" :key="departamento.id" :value="departamento.id" v-text="departamento.nombre" ></option>
                                      </select>  
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Municipio</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="municipio_id">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="municipio in arrayMunicipio" :key="municipio.id" :value="municipio.id" v-text="municipio.nombre" ></option>
                                      </select>  
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Vereda</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="vereda_id">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="vereda in arrayVereda" :key="vereda.id" :value="vereda.id" v-text="vereda.nombre" ></option>
                                      </select>  
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Resguardo</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="resguardo_id">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="resguardo in arrayResguardo" :key="resguardo.id" :value="resguardo.id" v-text="resguardo.nombre" ></option>
                                      </select>  
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Forma adquisicion predio</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="posesion_id">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="posesion in arrayPosesion" :key="posesion.id" :value="posesion.id" v-text="posesion.nombre" ></option>
                                      </select>  
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="number-input">Distancia del lote a la finca</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="distanciaAlLote"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="number-input">Distancia del lote a la via carreteable</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="distanciaLoteVia"  class="form-control" placeholder="">
                                    </div>
                                </div>  
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Coordenadas Finca</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="coordenadasFinca"  class="form-control" placeholder="">
                                    </div>
                                </div>                                     
                                <div v-show="errorFinca" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjFinca" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarFinca()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarFinca()">Actualizar</button>
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
    export default {
        data(){
            return{
                finca_id:0,
                nombre:'',
                productor_id:0,
                linea_id:0,
                posesion_id:0,
                areaPredio :0,
                longitudPredio :0,
                latitudPredio :0,
                altitudPredio :0,
                departamento_id :0,
                municipio_id:0,
                vereda_id:0,
                resguardo_id:0,
                distanciaAlLote:0,
                distanciaLoteVia:0,
                coordenadasFinca:'',   
                arrayFinca: [],
                modal: 0,
                tituloModal : '',
                tipoAccion:0,
                errorFinca : 0,
                errorMostrarMsjFinca:[],
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
                arrayLinea : [],
                arrayPosesion: [],
                arrayDepartamento: [],
                arrayMunicipio: [],
                arrayVereda: [],
                arrayResguardo:[],            
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
            listarFinca(page,buscar,criterio){
                let me =this;
                var url ='fincaP?page='+page + '&buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayFinca= respuesta.fincas.data;
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
                });
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
            selectPosesion(){
                let me =this;
                var url ='posesion/selectPosesion';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayPosesion= respuesta.posesions;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectDepartamento(){
                let me =this;
                var url ='departamento/selectDepartamento';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayDepartamento= respuesta.departamentos;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectMunicipio(){
                let me =this;
                var url ='municipio/selectMunicipio';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayMunicipio= respuesta.municipios;
                })
                .catch(function (error) {
                    console.log(error);
                });
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
                });
            },
            selectResguardo(){
                let me =this;
                var url ='resguardo/selectResguardo';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayResguardo= respuesta.resguardos;
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
                me.listarFinca(page,buscar,criterio);
            },
            registrarFinca(){
            if(this.validarFinca()){
                return;
            }
            let me=this;
            axios.post('finca/registrar',{
                'nombre':this.nombre,
                'productor_id':this.productor_id,
                'linea_id':this.linea_id,
                'areaPredio':this.areaPredio,
                'longitudPredio':this.longitudPredio,
                'latitudPredio':this.latitudPredio,
                'altitudPredio':this.altitudPredio,
                'departamento_id':this.departamento_id,
                'municipio_id':this.municipio_id,
                'vereda_id':this.vereda_id,
                'resguardo_id':this.resguardo_id,
                'posesion_id':this.posesion_id,
                'distanciaAlLote':this.distanciaAlLote,
                'distanciaLoteVia':this.distanciaLoteVia,
                'coordenadasFinca':this.coordenadasFinca
            }).then(function (response) {
                    me.cerrarModal();
                    me.listarFinca(1,'','nombre');
                })
                .catch(function (error) {
                    console.log(error);
                });

        },
        cargarPdf(){
                window.open('/asofrut/public/finca/listarPdf');
            },
            actualizarFinca(){
            if(this.validarFinca()){
                return;
            }
            let me=this;
            console.log(me);
            axios.put('finca/actualizar',{
                'id':this.finca_id,
                'nombre':this.nombre,
                'productor_id':this.productor_id,
                'linea_id':this.linea_id,
                'areaPredio':this.areaPredio,
                'longitudPredio':this.longitudPredio,
                'latitudPredio':this.latitudPredio,
                'altitudPredio':this.altitudPredio,
                'departamento_id':this.departamento_id,
                'municipio_id':this.municipio_id,
                'vereda_id':this.vereda_id,
                'resguardo_id':this.resguardo_id,
                'posesion_id':this.posesion_id,
                'distanciaAlLote':this.distanciaAlLote,
                'distanciaLoteVia':this.distanciaLoteVia,
                'coordenadasFinca':this.coordenadasFinca,
                
            }).then(function (response) {
                    console.log(response);
                    me.cerrarModal();
                    me.listarFinca(1,'','nombre');
                })
                .catch(function (error) {
                    console.log(error);
                });
        },          
            validarFinca(){
            this.errorFinca=0;
            this.errorMostrarMsjFinca=[];

            if(!this.nombre) this.errorMostrarMsjFinca.push("El nombre de la finca no puede estar vacío ");
            if(this.productor_id==0)this.errorMostrarMsjFinca.push("Debe seleccionar un productor.");
            if(this.linea_id==0)this.errorMostrarMsjFinca.push("Seleccione una opcion de linea.");
            if(this.posesion_id==0)this.errorMostrarMsjFinca.push("Seleccione una forma de adquisicion valida.");
            if(this.departamento_id==0)this.errorMostrarMsjFinca.push("Seleccione un departamento.");
            if(this.municipio_id==0)this.errorMostrarMsjFinca.push("Seleccione un municipio.");
            if(this.vereda_id==0)this.errorMostrarMsjFinca.push("Seleccione una vereda.");
            if(this.resguardo_id==0)this.errorMostrarMsjFinca.push("Seleccione un resguardo.");

            if(this.errorMostrarMsjFinca.length) this.errorFinca=1;

            return this.errorFinca;
        },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombre='',
                this.productor_id=0,
                this.linea_id=0,
                this.areaPredio=0,
                this.longitudPredio=0,
                this.latitudPredio=0,
                this.altitudPredio=0,
                this.departamento_id=0,
                this.municipio_id=0,
                this.vereda_id=0,
                this.resguardo_id=0,
                this.posesion_id=0,
                this.distanciaAlLote=0,
                this.distanciaLoteVia=0,
                this.coordenadasFinca='',
		        this.errorFinca=0;
        },
            abrirModal(modelo,accion,data = []){
            switch (modelo) {
                case "finca":
                {    
                switch (accion) {
                    case 'registrar':
                    {
                        this.modal = 1;
                        this.tituloModal = 'Registrar Finca';
                        this.nombre = '';
                        this.productor_id=0;
                        this.linea_id=0;
                        this.areaPredio=0;
                        this.longitudPredio=0;
                        this.latitudPredio=0;
                        this.altitudPredio=0;
                        this.departamento_id=0;
                        this.municipio_id=0;
                        this.vereda_id=0;                        
                        this.resguardo_id=0;
                        this.posesion_id=0;
                        this.distanciaAlLote=0;
                        this.distanciaLoteVia=0;
                        this.coordenadasFinca='';
                        this.tipoAccion=1;
                        break;
                    }    
                    case 'actualizar':
                    {
                        this.modal=1;
                        this.tituloModal='Actualizar Finca';
                        this.tipoAccion=2;
                        this.finca_id=data['id'];
                        this.nombre = data['nombre'];
                        this.productor_id=data['productor_id'];
                        this.linea_id=data['linea_id'];
                        this.areaPredio=data['areaPredio'];
                        this.longitudPredio=data['longitudPredio'];
                        this.latitudPredio=data['latitudPredio'];
                        this.altitudPredio=data['altitudPredio'];
                        this.departamento_id=data['departamento_id'];
                        this.municipio_id=data['municipio_id'];
                        this.vereda_id=data['vereda_id'];
                        this.resguardo_id=data['resguardo_id'];
                        this.posesion_id=data['posesion_id'];
                        this.distanciaAlLote=data['distanciaAlLote'];
                        this.distanciaLoteVia=data['distanciaLoteVia'];
                        this.coordenadasFinca=data['coordenadasFinca'];
                        break;
                    }       
                }
                }
            }
            this.selectDepartamento();
            this.selectMunicipio();
            this.selectVereda();
            this.selectResguardo();
            this.selectProductor();
            this.selectLinea();
            this.selectPosesion();
             
        }
        },        
        mounted() {
           this.listarFinca(1,this.buscar,this.criterio);
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