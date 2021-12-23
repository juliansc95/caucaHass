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
                        <i class="fa fa-align-justify"></i> Ventas
                         <export-excel
                        class   = "button btn btn-success"
                        :data   = arrayVenta
                        worksheet = "Ventas"
                        name    = "ventas.xls">
                        Excel
                        </export-excel>
                        <export-excel
                        class   = "button btn btn-success"
                        :data   = arrayVenta
                        type="csv"
                        name    = "ventas.xls">
                        csv
                        </export-excel>
                    </div>
                    <!-- Listado-->
                    <template v-if="listado==1">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="personas">Nombre</option>
                                      <option value="fechaVenta">Fecha-Hora</option>
                                      <option value="totalKilos">Peso total</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarVenta(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarVenta(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Opciones</th>
                                        <th>Productor</th>
                                        <th>Linea</th>
                                        <th>Fecha</th>
                                        <th>Lugar</th>
                                        <th>Peso Total</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="venta in arrayVenta" :key="venta.id">
                                        <td>
                                            <button type="button" @click="verVenta(venta.id)" class="btn btn-success btn-sm">
                                            <i class="icon-eye"></i>
                                            </button> &nbsp;
                                             <button type="button" @click="pdfVenta(venta.id)" class="btn btn-info btn-sm">
                                            <i class="icon-doc"></i>
                                            </button> &nbsp;
                                            <template v-if="venta.estado_id=='1'">
                                                <button type="button" class="btn btn-danger btn-sm" @click="desactivarVenta(venta.id)">
                                                    <i class="icon-trash"></i>
                                                </button>
                                                <button  type="button" class="btn btn-warning btn-sm" @click="pasarFacturacion(venta.id)">
                                                   <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-calculator-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm2 .5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-2zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zM4.5 9a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM4 12.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zM7.5 6a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM7 9.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm.5 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM10 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm.5 2.5a.5.5 0 0 0-.5.5v4a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 0-.5-.5h-1z"/>
                                                    </svg>
                                                </button>
                                            </template>
                                            <template v-if="venta.estado_id=='2'">
                                                 <button  type="button" class="btn btn-secondary btn-sm" @click="pasarDisponiblePago(venta.id)">
                                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-shop" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"/>
                                                    </svg>
                                                </button>
                                            </template>
                                            <template v-if="venta.estado_id=='3'">
                                                 <button  type="button" class="btn btn-info btn-sm" @click="pasarPagado(venta.id)">
                                                    <i class="fa fa-money"></i>
                                                </button>
                                            </template>
                                        </td>
                                        <td v-text="venta.nombre_persona"></td>
                                        <td v-text="venta.nombre_linea"></td>
                                        <td v-text="venta.fechaVenta"></td>
                                        <td v-text="venta.nombre_lugarVenta"></td>
                                        <td v-text="venta.totalKilos"></td>
                                        <td v-text="venta.totalVenta"></td>
                                        <td v-text="venta.nombre_estadoVenta"></td>
                                    </tr>                                
                                </tbody>
                            </table>
                        </div>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    </template>
                    <!--Fin Listado-->
                    <!-- Detalle-->
                    <template v-else-if="listado==0">
                    <div class="card-body">
                        <div class="form-group row border">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Productor(*)</label>
                                    <v-select
                                        :on-search="selectProductor"
                                        label="nombre"
                                        :options="arrayProductor"
                                        placeholder="Buscar Productor..."
                                        :onChange="getDatosProductor"                                        
                                    >
                                    </v-select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Linea(*)</label>
                                    <v-select
                                        :on-search="selectLinea"
                                        label="nombre"
                                        :options="arrayLinea"
                                        placeholder="Buscar Linea..."
                                        :onChange="getDatosLinea"                                        
                                    >
                                    </v-select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Lugar Venta(*)</label>
                                    <v-select
                                        :on-search="selectLugarVenta"
                                        label="nombre"
                                        :options="arrayLugarVenta"
                                        placeholder="Buscar Lugar Venta..."
                                        :onChange="getDatosLugarVenta"                                        
                                    >
                                    </v-select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div v-show="errorVenta" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjVenta" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row border">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Categoria Mora <span style="color:red;" v-show="categoria_id==0">(*Seleccione)</span></label>
                                    <div class="form-inline">
                                        <input type="text" class="form-control" v-model="codigo" @keyup.enter="buscarCategoria()" placeholder="Ingrese categoria">
                                        <button @click="abrirModal()" class="btn btn-primary">...</button>
                                        <input type="text" readonly class="form-control" v-model="categoria">
                                    </div>                                    
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Valor Unitario <span style="color:red;" v-show="valorUnitario==0"></span></label>
                                    <input type="number" value="0" step="any" class="form-control" disabled v-model="valorUnitario">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Peso(Kg) <span style="color:red;" v-show="peso==0">(*Ingrese)</span></label>
                                    <input type="number" value="0" step="any" class="form-control" v-model="peso">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button @click="agregarDetalle()" class="btn btn-success form-control btnagregar"><i class="icon-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row border">
                            <div class="table-responsive col-md-12">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Opciones</th>
                                            <th>Categoria</th>
                                            <th>Peso(Kg)</th>
                                            <th>Valor Unitario</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="arrayDetalle.length">
                                        <tr v-for="(detalle,index) in arrayDetalle" :key="detalle.id">
                                            <td>
                                                <button @click="eliminarDetalle(index)" type="button" class="btn btn-danger btn-sm">
                                                    <i class="icon-close"></i>
                                                </button>
                                            </td>
                                            <td  v-text="detalle.categoria">
                                            </td>
                                            <td>
                                            <input v-model="detalle.peso" type="number" class="form-control">
                                            </td>
                                            <td v-text="detalle.valorUnitario">
                                            </td>
                                            <td>
                                                $ {{(detalle.subtotal=detalle.valorUnitario*detalle.peso).toFixed(0)}}
                                            </td>    
                                        </tr>
                                         <tr style="background-color: #CEECF5;">
                                            <td colspan="4" align="right"><strong>Peso Total(Kg):</strong></td>
                                            <td> {{(totalKilos=calcularTotalKilos)}}</td>
                                        </tr>
                                         <tr style="background-color: #ff4d4d;">
                                            <td colspan="4" align="right"><strong>Descuento Donacion:</strong></td>
                                            <td>$ {{(totalDonacion=calcularTotalDonacion).toFixed(0)}}</td>
                                        </tr>
                                         <tr style="background-color: #ff4d4d;">
                                            <td colspan="4" align="right"><strong>Descuento Transporte:</strong></td>
                                            <td>$ {{(totalTransporte=calcularTotalTransporte).toFixed(0)}}</td>
                                        </tr>
                                         <tr style="background-color: #ff4d4d;">
                                            <td colspan="4" align="right"><strong>Descuento Asohofrucol:</strong></td>
                                            <td>$ {{(totalAsohof=calcularTotalAsohof).toFixed(0)}}</td>
                                        </tr>
                                         <tr style="background-color: #ff4d4d;">
                                            <td colspan="4" align="right"><strong>Descuento 4x1000:</strong></td>
                                            <td>$ {{(totalCuatroXmil=calcularTotalCuatroXmil).toFixed(0)}}</td>
                                        </tr>
                                        <tr style="background-color: #CEECF5;">
                                            <td colspan="4" align="right"><strong>Total Neto:</strong></td>
                                            <td>$ {{(totalVenta=calcularTotal).toFixed(0)}}</td>
                                        </tr>
                                    </tbody>
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="5">
                                                NO hay categorias agregadas
                                            </td>
                                        </tr>
                                    </tbody>                                    
                                </table>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="button" @click="ocultarDetalle()" class="btn btn-secondary">Cerrar</button>
                                <button type="button" class="btn btn-primary" @click="registrarVenta()">Registrar Venta</button>
                            </div>
                        </div>
                    </div>
                    </template>
                    <!-- Fin Detalle-->
                    <!-- Ver ingreso -->
                    <template v-else-if="listado==2">
                    <div class="card-body">
                        <div class="form-group row border">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Productor</label>
                                    <p v-text="productor"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="">Linea</label>
                                <p v-text="linea"></p>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Lugar de Venta</label>
                                    <p v-text="lugarVenta"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Estado</label>
                                    <p v-text="estado"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fecha</label>
                                    <p v-text="fechaVenta"></p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row border">
                            <div class="table-responsive col-md-12">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Categoria</th>
                                            <th>Peso(Kg)</th>
                                            <th>Valor Unitario</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="arrayDetalle.length">
                                        <tr v-for="detalle in arrayDetalle" :key="detalle.id">
                                            <td v-text="detalle.nombre_categoria">
                                            </td>
                                            <td v-text="detalle.peso">
                                            </td>
                                            <td v-text="detalle.valorUnitario">
                                            </td>
                                            <td v-text="detalle.subtotal">
                                            </td>
                                        </tr>
                                       <tr style="background-color: #CEECF5;">
                                            <td colspan="3" align="right"><strong>Peso Total(Kg):</strong></td>
                                            <td v-text="totalKilos"></td>
                                        </tr>
                                         <tr style="background-color: #ff4d4d;">
                                            <td colspan="3" align="right"><strong>Descuento Donacion:</strong></td>
                                            <td v-text="totalDonacion"></td>
                                        </tr>
                                         <tr style="background-color: #ff4d4d;">
                                            <td colspan="3" align="right"><strong>Descuento Transporte:</strong></td>
                                            <td  v-text="totalTransporte"></td>
                                        </tr>
                                         <tr style="background-color: #ff4d4d;">
                                            <td colspan="3" align="right"><strong>Descuento Asohofrucol:</strong></td>
                                            <td  v-text="totalAsohof"></td>
                                        </tr>
                                         <tr style="background-color: #ff4d4d;">
                                            <td colspan="3" align="right"><strong>Descuento 4x1000:</strong></td>
                                            <td  v-text="totalCuatroXmil"></td>
                                        </tr>
                                        <tr style="background-color: #CEECF5;">
                                            <td colspan="3" align="right"><strong>Total Neto:</strong></td>
                                            <td v-text="totalVenta"></td>
                                        </tr>
                                    </tbody>
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="4">
                                                NO hay categorias agregadas
                                            </td>
                                        </tr>
                                    </tbody>                                    
                                </table>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="button" @click="ocultarDetalle()" class="btn btn-secondary">Cerrar</button>
                                
                            </div>
                        </div>
                    </div>
                    </template>
                    <!-- fin ver ingreso -->
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <select class="form-control col-md-3" v-model="criterioA">
                                        <option value="nombre">Nombre</option>
                                        <option value="valorUnitario">Valor Unitario</option>
                                        </select>
                                        <input type="text" v-model="buscarA" @keyup.enter="listarCategoria(buscarA,criterioA)" class="form-control" placeholder="Texto a buscar">
                                        <button type="submit" @click="listarCategoria(buscarA,criterioA)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Opciones</th>
                                            <th>Nombre</th>
                                            <th>Valor Unitario</th>
                                            <th>Valor Donacion</th>
                                            <th>Valor Transporte</th>
                                            <th>Valor Asohofrucol</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="categoria in arrayCategoriaMoras" :key="categoria.id">
                                            <td>
                                                <button type="button" @click="agregarDetalleModal(categoria)" class="btn btn-success btn-sm">
                                                <i class="icon-check"></i>
                                                </button>
                                            </td>
                                            <td v-text="categoria.nombre"></td>
                                            <td v-text="categoria.valorUnitario"></td>
                                            <td v-text="categoria.ValorDonacion"></td>
                                            <td v-text="categoria.valorTransporte"></td>
                                            <td v-text="categoria.valorAsohof"></td>
                                        </tr>                                
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                   
                </div>   
               
            </div>
            <!--Fin del modal-->
        </main>
</template>

<script>
    import vSelect from 'vue-select';
    export default {
        data (){
            return {
                venta_id: 0,
                productor_id:0,
                productor:'',
                linea_id:0,
                linea:'',            
                lugarVenta_id:0,
                lugarVenta:'',
                totalKilos:0.0,
                totalVenta:0.0,
                totalImpuesto: 0.0,
                totalParcial: 0.0,
                arrayVenta : [],
                arrayProductor: [],
                arrayLugarVenta: [],
                arrayLinea:[],
                arrayDetalle : [],
                listado:1,
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorVenta : 0,
                errorMostrarMsjVenta : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'personas',
                buscar : '',
                criterioA:'nombre',
                buscarA: 'Mora',
                arrayCategoriaMoras: [],
                categoria_id: 0,
                categoria:'',
                codigo:0,
                peso:0,
                valorUnitario: 0,
                ValorDonacion: 0,
                valorTransporte:0,
                valorAsohof:0,
                valorCuatroPorMil:0,
                totalSinDescuento:0,
                totalDonacion:0,
                totalTransporte:0,
                totalAsohof:0,
                totalCuatroXmil:0,
                subtotal:0,
                estado:'',
                fechaVenta:'',
            }
        },
        components: {
            vSelect
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            },
            calcularTotal: function(){
                var resultado=0.0;
                for(var i=0;i<this.arrayDetalle.length;i++){
                    resultado=resultado+(this.arrayDetalle[i].valorUnitario*this.arrayDetalle[i].peso)-
                   this.totalDonacion-this.totalTransporte-this.totalAsohof-this.totalCuatroXmil
                }
                               
                return resultado;
            },
             calcularTotalKilos: function(){
                var resultado=0.0;
                for(var i=0;i<this.arrayDetalle.length;i++){
                    resultado =Number(resultado)+Number(this.arrayDetalle[i].peso)
                }
                               
                return resultado;
                
            },
            calcularTotalDonacion: function(){
                var resultado=0.0;
                 for(var i=0;i<this.arrayDetalle.length;i++){
                resultado =Number(resultado)+(Number(this.arrayCategoriaMoras[0].ValorDonacion)*Number(this.arrayDetalle[i].peso));                              
                 }
                return resultado;               
            },
            calcularTotalTransporte: function(){
                var resultado=0.0;
                 for(var i=0;i<this.arrayDetalle.length;i++){
                resultado =Number(resultado)+(Number(this.arrayCategoriaMoras[0].valorTransporte)*Number(this.arrayDetalle[i].peso));                              
                 }
                return resultado;               
            },
            calcularTotalAsohof: function(){
                var resultado=0.0;
                 for(var i=0;i<this.arrayDetalle.length;i++){
                resultado =Number(resultado)+(Number(this.arrayDetalle[i].valorUnitario)*Number(this.arrayDetalle[i].peso)*Number(this.arrayCategoriaMoras[0].valorAsohof));                              
                 }
                return resultado;               
            },
            calcularTotalCuatroXmil: function(){
                var resultado=0.0;
                 for(var i=0;i<this.arrayDetalle.length;i++){
                resultado =Number(resultado)+(Number(this.arrayDetalle[i].valorUnitario)*Number(this.arrayDetalle[i].peso)*Number(this.arrayCategoriaMoras[0].valorCuatroPorMil));                              
                 }
                return resultado;               
            },
           
        },
        methods : {
            listarVenta (page,buscar,criterio){
                let me=this;
                var url= 'venta?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayVenta = respuesta.ventas.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectProductor(search,loading){
                let me=this;
                loading(true)

                var url= 'productor/selectProductor2?filtro='+search;
                axios.get(url).then(function (response) {
                    let respuesta = response.data;
                    q: search
                    me.arrayProductor=respuesta.personas;
                    loading(false)
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getDatosProductor(val1){
                let me = this;
                me.loading = true;
                me.productor_id = val1.id;
            },
            selectLinea(search,loading){
                let me=this;
                loading(true)

                var url= 'linea/selectLinea2?filtro='+search;
                axios.get(url).then(function (response) {
                    let respuesta = response.data;
                    q: search
                    me.arrayLinea=respuesta.lineas;
                    loading(false)
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getDatosLinea(val1){
                let me = this;
                me.loading = true;
                me.linea_id = val1.id;
            },
            selectLugarVenta(search,loading){
                let me=this;
                loading(true)

                var url= 'lugarVenta/selectLugarVenta2?filtro='+search;
                axios.get(url).then(function (response) {
                    let respuesta = response.data;
                    q: search
                    me.arrayLugarVenta=respuesta.lugarVentas;
                    loading(false)
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getDatosLugarVenta(val1){
                let me = this;
                me.loading = true;
                me.lugarVenta_id = val1.id;
            },
            buscarCategoria(){
                let me=this;
                var url= 'categoriaMora/buscarCategoria?filtro=' + me.codigo;

                axios.get(url).then(function (response) {
                   var respuesta= response.data;
                    me.arrayCategoriaMoras = respuesta.categoriaMoras;
                   
                    if (me.arrayCategoriaMoras.length>0){
                        me.categoria=me.arrayCategoriaMoras[0]['nombre'];
                        me.categoria_id=me.arrayCategoriaMoras[0]['id'];
                        me.valorUnitario=me.arrayCategoriaMoras[0]['valorUnitario'];
                        me.ValorDonacion=me.arrayCategoriaMoras[0]['ValorDonacion'];
                        me.valorTransporte=me.arrayCategoriaMoras[0]['valorTransporte'];
                        me.valorAsohof=me.arrayCategoriaMoras[0]['valorAsohof'];
                        me.valorCuatroPorMil=me.arrayCategoriaMoras[0]['valorCuatroPorMil'];
                    }
                    else{
                        me.categoria='No existe categoria';
                        me.categoria_id=0;
                        me.valorUnitario=0;
                        me.ValorDonacion=0;
                        me.valorTransporte=0;
                        me.valorAsohof=0;
                        me.valorCuatroPorMil=0;
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            pdfVenta(id){
                window.open('http://gestion.asofrut.org/asofrut/public/venta/pdf/'+id);
            },
            cargarPdf(){
                window.open('http://gestion.asofrut.org/asofrut/public/venta/listarPdf');
            },
            reporteDiario(){
                window.open('http://gestion.asofrut.org/asofrut/public/venta/listarDiario');
            },
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarVenta(page,buscar,criterio);
            },
            encuentra(id){
                var sw=0;
                for(var i=0;i<this.arrayDetalle.length;i++){
                    if(this.arrayDetalle[i].categoria_id==id){
                        sw=true;
                    }
                }
                return sw;
            },
            eliminarDetalle(index){
                let me = this;
                me.arrayDetalle.splice(index, 1);
            },
            agregarDetalle(){
                let me=this;
                if(me.categoria_id==0){
                }
                else{
                    if(me.encuentra(me.categoria_id)){
                        swal.fire({
                            type: 'error',
                            title: 'Error...',
                            text: 'Esta categoria ya se encuentra agregada!',
                            })
                    }
                    else{
                      
                       me.arrayDetalle.push({
                            categoria_id: me.categoria_id,
                            categoria: me.categoria,
                            peso: me.peso,
                            valorUnitario:me.valorUnitario,
                            subtotal:me.subtotal,
                           
                            });
                        me.codigo="";
                        me.categoria_id=0;
                        me.categoria="";
                        me.peso=0;
                        me.valorUnitario=0;
                        me.subtotal=0;
                        
                    }
                    
                }

                

            },
            agregarDetalleModal(data =[]){
                let me=this;
                if(me.encuentra(data['id'])){
                        swal.fire({
                            type: 'error',
                            title: 'Error...',
                            text: 'Esta categoria ya se encuentra agregada!',
                            })
                    }
                    else{
                       me.arrayDetalle.push({
                            categoria_id: data['id'],
                            categoria: data['nombre'],
                            valorUnitario:data['valorUnitario'],
                            subtotal:data['subtotal'],
                            peso: 1,
                        }); 
                    }
            },
            listarCategoria (buscar,criterio){
                let me=this;
                var url= 'categoriaMora/listarCategoria?buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayCategoriaMoras = respuesta.categoriaMoras.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            registrarVenta(){
                if (this.validarVenta()){
                    return;
                }
                
                let me = this;
                axios.post('venta/registrar',{
                    'productor_id': this.productor_id,
                    'linea_id': this.linea_id,
                    'lugarVenta_id' : this.lugarVenta_id,
                    'totalVenta' : this.totalVenta,
                    'totalKilos' : this.totalKilos,
                    'totalDonacion':this.totalDonacion,
                    'totalTransporte':this.totalTransporte,
                    'totalAsohof':this.totalAsohof,
                    'totalCuatroXmil':this.totalCuatroXmil,
                    'data': this.arrayDetalle

                }).then(function (response) {
                    me.listado=1;
                    me.listarVenta(1,'','personas');
                    me.productor_id=0;
                    me.linea_id=0;
                    me.lugarVenta_id=0;
                    me.totalVenta=0;
                    me.totalKilos=0;
                    
                    me.categoria_id=0;
                    me.categoria='';
                    me.peso=0;
                    me.valorUnitario=0;
                    me.totalDonacion=0;
                    me.totalTransporte=0;
                    me.totalAsohof=0;
                    me.totalCuatroXmil=0;
                    me.codigo='';
                    me.arrayDetalle=[];
                    window.open('http://gestion.asofrut.org/venta/pdf/'+response.data.id);

                }).catch(function (error) {
                    console.log(error);
                });
            },
            validarVenta(){
                this.errorVenta=0;
                this.errorMostrarMsjVenta =[];

                if (this.productor_id==0) this.errorMostrarMsjVenta.push("Seleccione un Productor");
                if (this.linea_id==0) this.errorMostrarMsjVenta.push("Seleccione una linea");
                if (this.lugarVenta_id==0) this.errorMostrarMsjVenta.push("Seleccione un lugar de venta");
                if (this.arrayDetalle.length<=0) this.errorMostrarMsjVenta.push("Ingrese categorias de mora");

                if (this.errorMostrarMsjVenta.length) this.errorVenta = 1;

                return this.errorVenta;
            },
            mostrarDetalle(){
                let me=this;
                me.listado=0;

                me.idproveedor=0;
                me.tipo_comprobante='BOLETA';
                me.serie_comprobante='';
                me.num_comprobante='';
                me.impuesto=0.18;
                me.total=0.0;
                me.idarticulo=0;
                me.articulo='';
                me.cantidad=0;
                me.precio=0;
                me.arrayDetalle=[];
            },
            ocultarDetalle(){
                this.listado=1;
            },
            verVenta(id){
                let me=this;
                me.listado=2;
                
                //Obtener los datos del ingreso
                var arrayVentaT=[];
                var url= 'venta/obtenerCabecera?id=' + id;
                
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    arrayVentaT = respuesta.venta;

                    me.productor = arrayVentaT[0]['nombre_persona'];
                    me.linea=arrayVentaT[0]['nombre_linea'];
                    me.lugarVenta=arrayVentaT[0]['nombre_lugarVenta'];
                    me.estado=arrayVentaT[0]['nombre_estadoVenta'];
                    me.totalVenta=arrayVentaT[0]['totalVenta'];
                    me.totalKilos=arrayVentaT[0]['totalKilos'];
                    me.fechaVenta=arrayVentaT[0]['fechaVenta'];
                    me.totalDonacion=arrayVentaT[0]['totalDonacion'];
                    me.totalTransporte=arrayVentaT[0]['totalTransporte'];
                    me.totalAsohof=arrayVentaT[0]['totalAsohof'];
                    me.totalCuatroXmil=arrayVentaT[0]['totalCuatroXmil'];

                })
                .catch(function (error) {
                    console.log(error);
                });

                //Obtener los datos de los detalles 
                var urld= 'venta/obtenerDetalles?id=' + id;
                
                axios.get(urld).then(function (response) {
                    var respuesta= response.data;
                    me.arrayDetalle = respuesta.ventaCategoria;
                })
                .catch(function (error) {
                    console.log(error);
                });               
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
            }, 
            abrirModal(){               
                this.arrayCategoriaMoras=[];
                this.modal = 1;
                this.tituloModal = 'Seleccione uno o varios artículos';
            },
            desactivarVenta(id){
               swal.fire({
                title: 'Esta seguro de anular esta venta?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('venta/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarVenta(1,'','personas');
                        swal.fire(
                        'Anulado!',
                        'La venta ha sido anulada con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
             pasarFacturacion(id){
               swal.fire({
                title: 'Esta seguro de pasar al estado de Tramite de Facturacion?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('venta/pasarFacturacion',{
                        'id': id
                    }).then(function (response) {
                        me.listarVenta(1,'','personas');
                        swal.fire(
                        'Tramite Facturacion!',
                        'La venta ha pasado al siguiente estado con exito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
              pasarDisponiblePago(id){
               swal.fire({
                title: 'Esta seguro de pasar al estado de Disponible para pago?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('venta/pasarDisponiblePago',{
                        'id': id
                    }).then(function (response) {
                        me.listarVenta(1,'','personas');
                        swal.fire(
                        'Disponible para pago!',
                        'La venta ha pasado al siguiente estado con exito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
               pasarPagado(id){
               swal.fire({
                title: 'Esta seguro de pasar al estado de pagado?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('venta/pasarPagado',{
                        'id': id
                    }).then(function (response) {
                        me.listarVenta(1,'','personas');
                        swal.fire(
                        'Pagado!',
                        'La venta ha pasado al siguiente estado con exito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
        },
        mounted() {
            this.listarVenta(1,this.buscar,this.criterio);
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
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
    @media (min-width: 600px) {
        .btnagregar {
            margin-top: 2rem;
        }
    }
    .modal-dialog{
    overflow-y: initial !important
    }
    .modal-body{
    height: 250px;
    overflow-y: auto;
    }

</style>
