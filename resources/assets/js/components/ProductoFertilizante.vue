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
                        <i class="fa fa-align-justify"></i> Fertilizantes
                        <button type="button" @click="abrirModal('productoFitosanitario','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                         <export-excel
                        class   = "button btn btn-success"
                        :data   = arrayProductoFitosanitarioEx
                        worksheet = "Productos Fertilizantes"
                        name    = "productos.xls">
                        Excel
                        </export-excel>
                        <export-excel
                        class   = "button btn btn-success"
                        :data   = arrayProductoFitosanitarioEx
                        type="csv"
                        name    = "productos.xls">
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
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarProductoFitosanitario(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarProductoFitosanitario(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div class='table-responsive'>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-for="lugarVenta in arrayProductoFitosanitario" :key="lugarVenta.id">
                                    <td>
                                        <button type="button" @click="abrirModal('productoFitosanitario','actualizar',lugarVenta)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                    </td>
                                    <td v-text="lugarVenta.nombre"></td>
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
                                        <input type="text" v-model="nombre"  class="form-control" placeholder="Nombre producto fitosanitario">
                                    </div>
                                </div>                       
                                <div v-show="errorProductoFitosanitario" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjProductoFitosanitario" :key="error" v-text="error">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarProductoFitosanitario()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarProductoFitosanitario()">Actualizar</button>
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
                productoFitosanitario_id:0,
                nombre:'',
                modal: 0,
                tituloModal : '',
                tipoAccion:0,
                errorProductoFitosanitario : 0,
                errorMostrarMsjProductoFitosanitario:[],
                arrayProductoFitosanitario:[],
                arrayProductoFitosanitarioEx:[],
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
            listarProductoFitosanitario(page,buscar,criterio){
                let me =this;
                var url ='producFertilizante?page='+page + '&buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayProductoFitosanitario= respuesta.fertilizantes.data;
                    me.pagination=respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },   
            listarProductoFitosanitarioEx(){
                let me =this;
                var url ='producFertilizante/excel';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayProductoFitosanitarioEx= respuesta.fertilizantes;
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
                me.listarProductoFitosanitario(page,buscar,criterio);
            },
            registrarProductoFitosanitario(){
            if(this.validarProductoFitosanitario()){
                return;
            }
            let me=this;
            axios.post('producFertilizante/registrar',{
                'nombre':this.nombre,                              
            }).then(function (response) {
                    me.cerrarModal();
                    me.listarProductoFitosanitario(1,'','nombre');
                })
                .catch(function (error) {
                    console.log(error);
                });

        },
        cargarPdf(){
                //window.open('/caucahass/public/producFertilizante/listarPdf')
                window.open('http://caucahass.sttmserver.com/producFertilizante/listarPdf');
            },
            actualizarProductoFitosanitario(){
            if(this.validarProductoFitosanitario()){
                return;
            }
            let me=this;
            axios.put('fitosanitario/actualizar',{
                'nombre':this.nombre,
                'id':this.productoFitosanitario_id
            }).then(function (response) {
                    me.cerrarModal();
                    me.listarProductoFitosanitario(1,'','nombre');
                })
                .catch(function (error) {
                    console.log(error);
                });
        },                  
            validarProductoFitosanitario(){
            this.errorProductoFitosanitario=0;
            this.errorMostrarMsjProductoFitosanitario=[];

            if(!this.nombre) this.errorMostrarMsjProductoFitosanitario.push("El nombre del producto no puede estar vacío ");
            if(this.errorMostrarMsjProductoFitosanitario.length) this.errorProductoFitosanitario=1;

            return this.errorProductoFitosanitario;
        },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombre='';
		        this.errorProductoFitosanitario=0;
        },
            abrirModal(modelo,accion,data = []){
            switch (modelo) {
                case "productoFitosanitario":
                {    
                switch (accion) {
                    case 'registrar':
                    {
                        this.modal = 1;
                        this.tituloModal = 'Registrar Producto Fitosanitario';
                        this.nombre = '';
                        this.tipoAccion=1;
                        break;
                    }    
                    case 'actualizar':
                    {
                        this.modal=1;
                        this.tituloModal='Actualizar Producto Fitosanitario';
                        this.tipoAccion=2;
                        this.productoFitosanitario_id=data['id'];
                        this.nombre =data['nombre'];
                        break;
                    }       
                }
                }
            }
        }
        },        
        mounted() {
           this.listarProductoFitosanitario(1,this.buscar,this.criterio);
           this.listarProductoFitosanitarioEx();
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