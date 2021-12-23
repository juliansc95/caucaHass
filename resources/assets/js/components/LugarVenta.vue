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
                        <i class="fa fa-align-justify"></i> Lugares de Venta
                        <button type="button" @click="abrirModal('lugarVenta','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                         <export-excel
                            class   = "button btn btn-success"
                            :data   = arraylugarVentaEx
                            worksheet = "Lugar Venta"
                            name    = "lugarVenta.xls">
                            Excel
                            </export-excel>
                            <export-excel
                            class   = "button btn btn-success"
                            :data   = arraylugarVentaEx
                            type="csv"
                            name    = "lugarVenta.xls">
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
                                    <input type="text" v-model="buscar" @keyup.enter="listarLugarVenta(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarLugarVenta(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
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
                                <tr v-for="lugarVenta in arraylugarVenta" :key="lugarVenta.id">
                                    <td>
                                        <button type="button" @click="abrirModal('lugarVenta','actualizar',lugarVenta)" class="btn btn-warning btn-sm">
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
                                        <input type="text" v-model="nombre"  class="form-control" placeholder="Nombre lugar de venta">
                                    </div>
                                </div>                       
                                <div v-show="errorlugarVenta" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjlugarVenta" :key="error" v-text="error">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarLugarVenta()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarLugarVenta()">Actualizar</button>
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
                lugarVenta_id:0,
                nombre:'',
                modal: 0,
                tituloModal : '',
                tipoAccion:0,
                errorlugarVenta : 0,
                errorMostrarMsjlugarVenta:[],
                arraylugarVenta:[],
                arraylugarVentaEx:[],
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
            listarLugarVenta(page,buscar,criterio){
                let me =this;
                var url ='lugarVenta?page='+page + '&buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arraylugarVenta= respuesta.lugarVentas.data;
                    me.pagination=respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
             listarLugarVentaEx(){
                let me =this;
                var url ='lugarVenta/excel';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arraylugarVentaEx= respuesta.lugarVentas;
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
                me.listarLugarVenta(page,buscar,criterio);
            },
            registrarLugarVenta(){
            if(this.validarLugarVenta()){
                return;
            }
            let me=this;
            axios.post('lugarVenta/registrar',{
                'nombre':this.nombre,                              
            }).then(function (response) {
                    me.cerrarModal();
                    me.listarLugarVenta(1,'','nombre');
                })
                .catch(function (error) {
                    console.log(error);
                });

        },
        cargarPdf(){
                window.open('http://gestion.asofrut.org/lugarVenta/listarPdf');
            },
            actualizarLugarVenta(){
            if(this.validarLugarVenta()){
                return;
            }
            let me=this;
            axios.put('lugarVenta/actualizar',{
                'nombre':this.nombre,
                'id':this.lugarVenta_id
            }).then(function (response) {
                    me.cerrarModal();
                    me.listarLugarVenta(1,'','nombre');
                })
                .catch(function (error) {
                    console.log(error);
                });
        },                  
            validarLugarVenta(){
            this.errorlugarVenta=0;
            this.errorMostrarMsjlugarVenta=[];

            if(!this.nombre) this.errorMostrarMsjlugarVenta.push("El nombre del lugar de Venta no puede estar vacío ");
            if(this.errorMostrarMsjlugarVenta.length) this.errorlugarVenta=1;

            return this.errorlugarVenta;
        },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombre='';
		        this.errorlugarVenta=0;
        },
            abrirModal(modelo,accion,data = []){
            switch (modelo) {
                case "lugarVenta":
                {    
                switch (accion) {
                    case 'registrar':
                    {
                        this.modal = 1;
                        this.tituloModal = 'Registrar Lugar de Venta';
                        this.nombre = '';
                        this.tipoAccion=1;
                        break;
                    }    
                    case 'actualizar':
                    {
                        this.modal=1;
                        this.tituloModal='Actualizar Lugar de Venta';
                        this.tipoAccion=2;
                        this.lugarVenta_id=data['id'];
                        this.nombre =data['nombre'];
                        break;
                    }       
                }
                }
            }
        }
        },        
        mounted() {
           this.listarLugarVenta(1,this.buscar,this.criterio);
           this.listarLugarVentaEx();
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