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
                        <i class="fa fa-align-justify"></i> Productores
                        <button type="button" @click="abrirModal('productor','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                        <export-excel
                        class   = "button btn btn-success"
                        :data   = arrayProductorEx
                        worksheet = "Productores"
                        name    = "productores.xls">
                        Excel
                    </export-excel>
                        <export-excel
                        class   = "button btn btn-success"
                        :data   = arrayProductorEx
                        type="csv"
                        name    = "productores.xls">
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
                                      <option value="nombre">Nombre</option>
                                      <option value="num_documento">Numero Documento</option>
                                      <option value="email">Correo electronico</option>
                                      <option value="veredas">Vereda</option>
                                       <option value="resguardos">Resguardo</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarProductor(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarProductor(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div class='table-responsive'>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Tipo documento</th>
                                    <th>Numero documento</th>
                                    <th>Fecha nacimiento</th>
                                    <th>Sexo</th>
                                    <th>Telefono</th>
                                    <th>Correo electronico</th>
                                    <th>Vereda</th>
                                    <th>Fecha de Ingreso</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="persona in arrayProductor" :key="persona.id">
                                    <td>
                                        <button type="button" @click="abrirModal('productor','actualizar',persona)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                    </td>
                                    <td v-text="persona.nombre"></td>
                                    <td v-text="arrayTipoId[persona.tipo_id-1].nombre"></td>
                                    <td v-text="persona.num_documento"></td>
                                    <td v-text="persona.fechaNacimiento"></td>
                                    <td v-text="persona.nombre_sexo"></td>
                                    <td v-text="persona.telefono"></td>
                                    <td v-text="persona.email"></td>
                                    <td v-text="persona.vereda"></td>
                                    <td v-text="persona.fechaIngreso"></td>
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
                                        <input type="text" v-model="nombre"  class="form-control" placeholder="Nombre del productor">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Tipo Identificacion</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="tipo_id">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="tipoId in arrayTipoId" :key="tipoId.id" :value="tipoId.id" v-text="tipoId.nombre" ></option>
                                      </select>  
                                    </div>
                                </div>                            

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="number-input">Numero documento de identificacion</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="num_documento"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Fecha expedicion documento</label>
                                    <div class="col-md-9">
                                        <v-datepicker :inline="true" v-model="fechaExpedicion "></v-datepicker>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Fecha de nacimiento</label>
                                    <div class="col-md-9">
                                       <v-datepicker :inline="true" v-model="fechaNacimiento"></v-datepicker>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Sexo</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="sexo_id">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="sexo in arraySexo" :key="sexo.id" :value="sexo.id" v-text="sexo.nombre" ></option>
                                      </select>  
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="number-input">Telefono</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="telefono"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Correo electronico</label>
                                    <div class="col-md-9">
                                        <input type="email" v-model="email" class="form-control" placeholder="Ingrese su correo electronico">
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
                                        <input type="text" v-model="vereda"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Direccion</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="direccion"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Fecha de ingreso</label>
                                    <div class="col-md-9">
                                         <v-datepicker :inline="true" v-model="fechaIngreso"></v-datepicker>
                                    </div>
                                </div>                           
                                <div v-show="errorProductor" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjProductor" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarProductor()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarProductor()">Actualizar</button>
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
                persona_id:0,
                nombre:'',
                tipo_id:0,
                num_documento : '',
                direccion : '',
                telefono : '',
                email : '',
                fechaExpedicion:'',
                fechaNacimiento:'',
                sexo_id:0,
                etnia_id:0,
                escolaridad_id:0,
                departamento_id:0,
                municipio_id:0,
                vereda:'',
                resguardo_id:0,
                fechaIngreso:'',
                fotocopiaCedula:'',   
                arrayProductor: [],
                arrayProductorEx: [],
                modal: 0,
                tituloModal : '',
                tipoAccion:0,
                errorProductor : 0,
                errorMostrarMsjProductor:[],
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
                arrayTipoId : [],
                arraySexo : [],
                arrayEtnia: [],
                arrayEscolaridad: [],
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
            listarProductor(page,buscar,criterio){
                this.selectTipoId();
                let me =this;
                var url ='productor?page='+page + '&buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayProductor= respuesta.personas.data;
                    me.pagination=respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            listarProductorEx(){
                let me =this;
                var url ='productor/excel';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayProductorEx= respuesta.personas;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectTipoId(){
                let me =this;
                var url ='tipoId/selectTipoId';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayTipoId= respuesta.tipoIds;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectSexo(){
                let me =this;
                var url ='sexo/selectSexo';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arraySexo= respuesta.sexos;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectEtnia(){
                let me =this;
                var url ='etnia/selectEtnia';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayEtnia= respuesta.etnias;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectEscolaridad(){
                let me =this;
                var url ='escolaridad/selectEscolaridad';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayEscolaridad= respuesta.grados;
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
                me.listarProductor(page,buscar,criterio);
            },
            registrarProductor(){
            if(this.validarProductor()){
                return;
            }
            let me=this;
            axios.post('productor/registrar',{                            
                'nombre':this.nombre,
                'tipo_id':this.tipo_id,
                'num_documento':this.num_documento,
                'fechaExpedicion':this.fechaExpedicion,
                'fechaNacimiento':this.fechaNacimiento,
                'sexo_id':this.sexo_id,
                'telefono':this.telefono,
                'email':this.email, 
                'departamento_id':this.departamento_id,
                'municipio_id':this.municipio_id,
                'vereda':this.vereda,
                'direccion':this.direccion,
                'fechaIngreso':this.fechaIngreso,
            }).then(function (response) {
                    console.log(response);
                    me.cerrarModal();
                    me.listarProductor(1,'','nombre');
                })
                .catch(function (error) {
                    console.log(error);
                });

        },
         cargarPdf(){
                //window.open('http://gestion.asofrut.org/productor/listarPdf');
                window.open('/caucahass/public/productor/listarPdf');
        },
            actualizarProductor(){
            if(this.validarProductor()){
                return;
            }
            let me=this;
            axios.put('productor/actualizar',{
                'nombre':this.nombre,
                'tipo_id':this.tipo_id,
                'num_documento':this.num_documento,
                'fechaExpedicion':this.fechaExpedicion,
                'fechaNacimiento':this.fechaNacimiento,
                'sexo_id':this.sexo_id,
                'telefono':this.telefono,
                'email':this.email, 
                'departamento_id':this.departamento_id,
                'municipio_id':this.municipio_id,
                'vereda':this.vereda,
                'direccion':this.direccion,
                'fechaIngreso':this.fechaIngreso,
                'fotocopiaCedula':this.fotocopiaCedula,
                'id':this.persona_id
            }).then(function (response) {
                    me.cerrarModal();
                    me.listarProductor(1,'','nombre');
                })
                .catch(function (error) {
                    console.log(error);
                });
        },          
            validarProductor(){
            this.errorProductor=0;
            this.errorMostrarMsjProductor=[];

            if(!this.nombre) this.errorMostrarMsjProductor.push("El nombre del productor no puede estar vacío ");
            if(this.tipo_id==0)this.errorMostrarMsjProductor.push("Seleccione un tipo de documento.");
            if(!this.num_documento) this.errorMostrarMsjProductor.push("Ingrese un numero de documento valido");
            if(this.sexo_id==0)this.errorMostrarMsjProductor.push("Seleccione una opcion de sexo.");
            if(!this.telefono) this.errorMostrarMsjProductor.push("Ingrese un numero de telefono valido sin lineas ni puntos");
            if(!this.email) this.errorMostrarMsjProductor.push("Ingrese un correo electronico valido");
            if(this.departamento_id==0)this.errorMostrarMsjProductor.push("Seleccione un departamento.");
            if(this.municipio_id==0)this.errorMostrarMsjProductor.push("Seleccione un municipio.");

            if(this.errorMostrarMsjProductor.length) this.errorProductor=1;

            return this.errorProductor;
        },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombre = '';
                this.tipo_id= 0;
                this.num_documento = '';
                this.fechaExpedicion = '';
                this.fechaNacimiento = '';
                this.sexo_id = 0;
                this.etnia_id = 0;
                this.escolaridad_id = 0;
                this.telefono = '';
                this.direccion='';
                this.email = '';
                this.departamento_id = 0;
                this.municipio_id = 0;
                this.vereda_id = 0;
                this.resguardo_id = 0;
                this.fechaIngreso = '';
                this.fotocopiaCedula = '';
		        this.errorProductor=0;
        },
            abrirModal(modelo,accion,data = []){
            switch (modelo) {
                case "productor":
                {    
                switch (accion) {
                    case 'registrar':
                    {
                        this.modal = 1;
                        this.tituloModal = 'Registrar Productor';
                        this.nombre = '';
                        this.tipo_id= 0;
                        this.num_documento = '';
                        this.fechaExpedicion = '';
                        this.fechaNacimiento = '';
                        this.sexo_id = 0;
                        this.telefono = '';
                        this.direccion='';
                        this.email = '';
                        this.departamento_id = 0;
                        this.municipio_id = 0;
                        this.fechaIngreso = '';
                        this.tipoAccion=1;
                        break;
                    }    
                    case 'actualizar':
                    {
                        this.modal=1;
                        this.tituloModal='Actualizar Productor';
                        this.tipoAccion=2;
                        this.persona_id=data['id'];
                        this.nombre = data['nombre'];
                        this.tipo_id= data['tipo_id'];
                        this.num_documento =data ['num_documento'];
                        this.fechaExpedicion = data['fechaExpedicion'];
                        this.fechaNacimiento = data['fechaNacimiento'];
                        this.sexo_id = data['sexo_id'];
                        this.telefono = data['telefono'];
                        this.direccion=data['direccion'];
                        this.email = data['email'];
                        this.departamento_id = data['departamento_id'];
                        this.municipio_id = data['municipio_id'];
                        this.vereda = data['vereda'];
                        this.fechaIngreso = data['fechaIngreso'];
                        break;
                    }       
                }
                }
            }
            this.selectTipoId();
            this.selectSexo();
            this.selectEtnia();
            this.selectEscolaridad();
            this.selectDepartamento();
            this.selectMunicipio();
            this.selectVereda();
            this.selectResguardo(); 
        }
        },        
        mounted() {
           this.listarProductor(1,this.buscar,this.criterio);
           this.listarProductorEx();
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