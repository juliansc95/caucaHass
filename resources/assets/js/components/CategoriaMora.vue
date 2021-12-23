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
                        <i class="fa fa-align-justify"></i> Categorias Mora
                        <button type="button" @click="abrirModal('categoriaMora','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                          <export-excel
                            class   = "button btn btn-success"
                            :data   = arraycategoriaMoraEx
                            worksheet = "Categoria Moras"
                            name    = "categoriasMora.xls">
                            Excel
                            </export-excel>
                            <export-excel
                            class   = "button btn btn-success"
                            :data   = arraycategoriaMoraEx
                            type="csv"
                            name    = "categoriasMora.xls">
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
                                    <input type="text" v-model="buscar" @keyup.enter="listarCategoriaMora(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarCategoriaMora(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div class='table-responsive'>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Valor Unitario</th>
                                    <th>Valor Donacion</th>
                                    <th>Valor Transporte</th>
                                    <th>Valor ASOHOFRUCOL</th>
                                    <th>Valor 4x100</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-for="categoria in arraycategoriaMora" :key="categoria.id">
                                    <td>
                                        <button type="button" @click="abrirModal('categoriaMora','actualizar',categoria)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                    </td>
                                    <td v-text="categoria.nombre"></td>
                                    <td v-text="categoria.valorUnitario"></td>
                                    <td v-text="categoria.ValorDonacion"></td>
                                    <td v-text="categoria.valorTransporte"></td>
                                    <td v-text="categoria.valorAsohof"></td>
                                    <td v-text="categoria.valorCuatroPorMil"></td>
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
                                        <input type="text" v-model="nombre"  class="form-control" placeholder="Nombre de Categoria">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="number-input">Valor Unitario</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="valorUnitario"  class="form-control" placeholder="">
                                    </div>
                                </div>  
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="number-input">Valor Donacion</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="valorDonacion"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="number-input">Valor Transporte</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="valorTransporte"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="number-input">Valor ASOHOF</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="valorAsohof   "  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="number-input">Valor 4x100</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="valorCuatroPorMil   "  class="form-control" placeholder="">
                                    </div>
                                </div>                             
                                <div v-show="errorcategoriaMora" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjcategoriaMora" :key="error" v-text="error">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarCategoriaMora()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarCategoriaMora()">Actualizar</button>
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
                categoriaMora_id:0,
                nombre:'',
                valorUnitario:0,
                valorDonacion :0,
                valorTransporte :0,
                valorAsohof :0,
                valorCuatroPorMil :0,
                modal: 0,
                tituloModal : '',
                tipoAccion:0,
                errorcategoriaMora : 0,
                errorMostrarMsjcategoriaMora:[],
                arraycategoriaMora:[],
                arraycategoriaMoraEx:[],
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
            listarCategoriaMora(page,buscar,criterio){
                let me =this;
                var url ='categoriaMora?page='+page + '&buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arraycategoriaMora= respuesta.categoriaMoras.data;
                    me.pagination=respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },      
            listarCategoriaMoraEx(){
                let me =this;
                var url ='mora/excel';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arraycategoriaMoraEx= respuesta.categoriaMoras;
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
                me.listarCategoriaMora(page,buscar,criterio);
            },
            registrarCategoriaMora(){
            if(this.validarCategoriaMora()){
                return;
            }
            let me=this;
            axios.post('categoriaMora/registrar',{
                'nombre':this.nombre,
                'valorUnitario':this.valorUnitario,
                'valorDonacion' :this.valorDonacion,
                'valorTransporte' :this.valorTransporte,
                'valorAsohof' :this.valorAsohof,
                'valorCuatroPorMil':this.valorCuatroPorMil                              
            }).then(function (response) {
                    me.cerrarModal();
                    me.listarCategoriaMora(1,'','nombre');
                })
                .catch(function (error) {
                    console.log(error);
                });

        },
        cargarPdf(){
                window.open('http://gestion.asofrut.org/mora/listarPdf');
            },
            actualizarCategoriaMora(){
            if(this.validarCategoriaMora()){
                return;
            }
            let me=this;
            axios.put('categoriaMora/actualizar',{
                'nombre':this.nombre,
                'valorUnitario':this.valorUnitario,
                'valorDonacion' :this.valorDonacion,
                'valorTransporte' :this.valorTransporte,
                'valorAsohof' :this.valorAsohof,
                'valorCuatroPorMil':this.valorCuatroPorMil,  
                'id':this.categoriaMora_id
            }).then(function (response) {
                    me.cerrarModal();
                    me.listarCategoriaMora(1,'','nombre');
                })
                .catch(function (error) {
                    console.log(error);
                });
        },                  
            validarCategoriaMora(){
            this.errorcategoriaMora=0;
            this.errorMostrarMsjcategoriaMora=[];

            if(!this.nombre) this.errorMostrarMsjcategoriaMora.push("El nombre de la categoria no puede estar vacío ");
            if(this.errorMostrarMsjcategoriaMora.length) this.errorcategoriaMora=1;

            return this.errorcategoriaMora;
        },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombre='';
                this.valorUnitario=0;
                this.valorDonacion=0;
                this.valorTransporte=0;
                this.valorAsohof=0;
                this.valorCuatroPorMil=0;
		        this.errorcategoriaMora=0;
        },
            abrirModal(modelo,accion,data = []){
            switch (modelo) {
                case "categoriaMora":
                {    
                switch (accion) {
                    case 'registrar':
                    {
                        this.modal = 1;
                        this.tituloModal = 'Registrar Categoria Mora';
                        this.nombre = '';
                        this.valorUnitario=0;
                        this.valorDonacion=0;
                        this.valorTransporte=0;
                        this.valorAsohof=0;
                        this.valorCuatroPorMil=0;
                        this.tipoAccion=1;
                        break;
                    }    
                    case 'actualizar':
                    {
                        this.modal=1;
                        this.tituloModal='Actualizar Categoria Mora';
                        this.tipoAccion=2;
                        this.categoriaMora_id=data['id'];
                        this.nombre =data['nombre'];
                        this.valorUnitario=data['valorUnitario'];
                        this.valorDonacion=data['ValorDonacion'];
                        this.valorTransporte=data['valorTransporte'];
                        this.valorAsohof=data['valorAsohof'];
                        this.valorCuatroPorMil=data['valorCuatroPorMil'];
                        break;
                    }       
                }
                }
            }
        }
        },        
        mounted() {
           this.listarCategoriaMora(1,this.buscar,this.criterio);
           this.listarCategoriaMoraEx();
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