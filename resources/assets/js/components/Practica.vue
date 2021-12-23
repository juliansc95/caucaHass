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
                        <i class="fa fa-align-justify"></i>Buenas Practicas Agricolas
                        <button type="button" @click="abrirModal('practica','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                         <export-excel
                            class   = "button btn btn-success"
                            :data   = arrayPracticaEx
                            worksheet = "Practicas"
                            name    = "practicas.xls">
                            Excel
                            </export-excel>
                            <export-excel
                            class   = "button btn btn-success"
                            :data   = arrayPracticaEx
                            type="csv"
                            name    = "practicas.xls">
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
                                    <input type="text" v-model="buscar" @keyup.enter="listarPractica(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarPractica(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
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
                                    <th>Vivienda</th>
                                    <th>Bateria Sanitaria</th>
                                    <th>Bodega</th>
                                    <th>Traje de proteccion</th>
                                    <th>Punto Ecologico</th>
                                    <th>Botiquin</th>
                                    <th>Extintor</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr v-for="practica in arrayPractica" :key="practica.id">
                                    <td>
                                        <button type="button" @click="abrirModal('practica','actualizar',practica)" class="btn btn-warning btn-sm">
                                          <i class="icon-eye"></i>
                                        </button> &nbsp;
                                    </td> 
                                    <td v-text="practica.nombre"></td>
                                    <td v-text="practica.nombre_finca"></td> 
                                    <td v-text="practica.vivenda"></td> 
                                    <td v-text="practica.bateriaSanitaria"></td> 
                                    <td v-text="practica.bodegaMateriales"></td> 
                                    <td v-text="practica.trajeProteccion"></td> 
                                    <td v-text="practica.puntoEcologico"></td>  
                                    <td v-text="practica.botiquin"></td>
                                    <td v-text="practica.extintor"></td>                                     
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
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option v-for="finca in arrayFinca" :key="finca.id" :value="finca.id" v-text="finca.nombre" ></option>
                                      </select>  
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Tiene vivienda en el predio</label>
                                    <div class="col-md-3">
                                      <select class="form-control" v-model="vivenda">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                    <label class="col-md-3 form-control-label" for="text-input">Vive en el sitio?</label>
                                    <div class="col-md-3">
                                      <select class="form-control" v-model="viveSitio">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Tiene bateria sanitaria?</label>
                                    <div class="col-md-3">
                                      <select class="form-control" v-model="bateriaSanitaria">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                    <label class="col-md-3 form-control-label" for="text-input">Tiene pozo séptico?</label>
                                    <div class="col-md-3">
                                      <select class="form-control" v-model="pozoSeptico">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Tiene zona de barbecho?</label>
                                    <div class="col-md-3">
                                      <select class="form-control" v-model="zonaBarbecho">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                    <label class="col-md-3 form-control-label" for="text-input">La usa?</label>
                                    <div class="col-md-3">
                                      <select class="form-control" v-model="usaBarbecho">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Tiene area para mezcal de agroquimicos?</label>
                                    <div class="col-md-3">
                                      <select class="form-control" v-model="mezclaAgroquimicos">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                    <label class="col-md-3 form-control-label" for="text-input">La usa?</label>
                                    <div class="col-md-3">
                                      <select class="form-control" v-model="usaAgroquimicos">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Tiene bodega de materiales, herramientas e insumos</label>
                                    <div class="col-md-3">
                                      <select class="form-control" v-model="bodegaMateriales">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                    <label class="col-md-3 form-control-label" for="text-input">La usa?</label>
                                    <div class="col-md-3">
                                      <select class="form-control" v-model="usaBodega">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Dispone de lugar para lavado de canastillas</label>
                                    <div class="col-md-3">
                                      <select class="form-control" v-model="canastillas">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                    <label class="col-md-3 form-control-label" for="text-input">La usa?</label>
                                    <div class="col-md-3">
                                      <select class="form-control" v-model="usaCanastillas">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Tiene traje de proteccion para aplicacion de agroquimicos</label>
                                    <div class="col-md-3">
                                      <select class="form-control" v-model="trajeProteccion">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                    <label class="col-md-3 form-control-label" for="text-input">La usa?</label>
                                    <div class="col-md-3">
                                      <select class="form-control" v-model="usaTraje">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Tiene punto ecologico?</label>
                                    <div class="col-md-3">
                                      <select class="form-control" v-model="puntoEcologico">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                    <label class="col-md-3 form-control-label" for="text-input">La usa?</label>
                                    <div class="col-md-3">
                                      <select class="form-control" v-model="usaPuntoEcologico">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Hace una adecuada disposicion de los envases vacios de agroquimicos</label>
                                    <div class="col-md-3">
                                      <select class="form-control" v-model="agroquimicos">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Tiene botiquin?</label>
                                    <div class="col-md-3">
                                      <select class="form-control" v-model="botiquin">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                    <label class="col-md-3 form-control-label" for="text-input">Lo tiene en funcionamiento?</label>
                                    <div class="col-md-3">
                                      <select class="form-control" v-model="usaBotiquin">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Tiene extintor?</label>
                                    <div class="col-md-3">
                                      <select class="form-control" v-model="extintor">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                    <label class="col-md-3 form-control-label" for="text-input">Lo tiene disponible para funcionamiento?</label>
                                    <div class="col-md-3">
                                      <select class="form-control" v-model="usaExtintor">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Ha recibido capacitaciones de BPA</label>
                                    <div class="col-md-3">
                                      <select class="form-control" v-model="capacitacionesBPA">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                    <label class="col-md-3 form-control-label" for="text-input">Lo certificaron?</label>
                                    <div class="col-md-3">
                                      <select class="form-control" v-model="certificadas">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Quien lo certifico?</label>
                                    <div class="col-md-3">
                                       <input type="text" v-model="institucionCertificado"  class="form-control" placeholder="">
                                    </div> 
                                    <label class="col-md-3 form-control-label" for="text-input">Hace cuanto se capacito?(Años)
                                    </label>
                                    <div class="col-md-3">
                                       <input type="number" v-model="tiempo"  class="form-control" placeholder="">
                                    </div>
                                </div>                                       
                                <div v-show="errorPractica" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjPractica" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarPractica()">Guardar</button>
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
                practica_id:0,
                productor_id:0,
                finca_id:0,
                vivenda:'Seleccione',
                viveSitio:'Seleccione',
                bateriaSanitaria:'Seleccione',
                pozoSeptico:'Seleccione',
                zonaBarbecho:'Seleccione',
                usaBarbecho:'Seleccione',
                mezclaAgroquimicos:'Seleccione',
                usaAgroquimicos:'Seleccione',
                bodegaMateriales:'Seleccione',
                usaBodega:'Seleccione',
                canastillas:'Seleccione',
                usaCanastillas:'Seleccione',
                trajeProteccion:'Seleccione',
                usaTraje:'Seleccione',
                puntoEcologico:'Seleccione',
                usaPuntoEcologico:'Seleccione',
                agroquimicos:'Seleccione',
                botiquin:'Seleccione',
                usaBotiquin:'Seleccione',
                extintor:'Seleccione',
                usaExtintor:'Seleccione',
                capacitacionesBPA:'Seleccione',
                certificadas:'Seleccione',
                institucionCertificado:'',
                tiempo:0,           
                arrayPractica: [],
                arrayPracticaEx: [],
                modal: 0,
                tituloModal : '',
                tipoAccion:0,
                errorPractica : 0,
                errorMostrarMsjPractica:[],
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
            listarPractica(page,buscar,criterio){
                let me =this;
                var url ='practica?page='+page + '&buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayPractica= respuesta.practicas.data;
                    me.pagination=respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
             listarPracticaEx(){
                let me =this;
                var url ='practica/excel';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayPracticaEx= respuesta.practicas;
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
                me.listarPractica(page,buscar,criterio);
            },
            registrarPractica(){
            if(this.validarPractica()){
                return;
            }
            let me=this;
            axios.post('practica/registrar',{
                'productor_id':this.productor_id,
                'finca_id':this.finca_id,
                'vivenda':this.vivenda,
                'viveSitio':this.viveSitio,
                'bateriaSanitaria':this.bateriaSanitaria,
                'pozoSeptico':this.pozoSeptico,
                'zonaBarbecho':this.zonaBarbecho,
                'usaBarbecho':this.usaBarbecho,
                'mezclaAgroquimicos':this.mezclaAgroquimicos,
                'usaAgroquimicos':this.usaAgroquimicos,
                'bodegaMateriales':this.bodegaMateriales,
                'usaBodega':this.usaBodega,
                'canastillas':this.canastillas,
                'usaCanastillas':this.usaCanastillas,
                'trajeProteccion':this.trajeProteccion,
                'usaTraje':this.usaTraje,
                'puntoEcologico':this.puntoEcologico,
                'agroquimicos':this.agroquimicos,
                'usaPuntoEcologico':this.usaPuntoEcologico,
                'botiquin':this.botiquin,
                'usaBotiquin':this.usaBotiquin,
                'extintor':this.extintor,
                'usaExtintor':this.usaExtintor,
                'capacitacionesBPA':this.capacitacionesBPA,
                'certificadas':this.certificadas,
                'institucionCertificado':this.institucionCertificado,
                'tiempo':this.tiempo
            }).then(function (response) {
                    me.cerrarModal();
                    me.listarPractica(1,'','personas');
                })
                .catch(function (error) {
                    console.log(error);
                });

        },
        cargarPdf(){
                window.open('http://gestion.asofrut.org/practica/listarPdf');
            },    
            validarPractica(){
            this.errorPractica=0;
            this.errorMostrarMsjPractica=[];
            if(this.productor_id==0)this.errorMostrarMsjPractica.push("Debe seleccionar un productor");
            if(this.finca_id==0)this.errorMostrarMsjPractica.push("Debe seleccionar una finca.");
            if(this.errorMostrarMsjPractica.length) this.errorPractica=1;

            return this.errorPractica;
        },
            cerrarModal(){
                        this.modal=0;
                        this.tituloModal='';
                        this.productor_id=0;
                        this.finca_id=0;
                        this.vivenda='Seleccione';
                        this.viveSitio='Seleccione';
                        this.bateriaSanitaria='Seleccione';
                        this.pozoSeptico='Seleccione';
                        this.zonaBarbecho='Seleccione';
                        this.usaBarbecho='Seleccione';
                        this.mezclaAgroquimicos='Seleccione';
                        this.usaAgroquimicos='Seleccione';
                        this.bodegaMateriales='Seleccione';
                        this.usaBodega='Seleccione';
                        this.canastillas='Seleccione';
                        this.usaCanastillas='Seleccione';
                        this.trajeProteccion='Seleccione';
                        this.usaTraje='Seleccione';
                        this.puntoEcologico='Seleccione';
                        this.usaPuntoEcologico='Seleccione';
                        this.agroquimicos='Seleccione';
                        this.botiquin='Seleccione';
                        this.usaBotiquin='Seleccione';
                        this.extintor='Seleccione';
                        this.usaExtintor='Seleccione';
                        this.capacitacionesBPA='Seleccione';
                        this.certificadas='Seleccione';
                        this.institucionCertificado='';  
                        this.tiempo=0;                 
		                this.errorPractica=0;
        },
            abrirModal(modelo,accion,data = []){
            switch (modelo) {
                case "practica":
                {    
                switch (accion) {
                    case 'registrar':
                    {
                        this.modal = 1;
                        this.tituloModal = 'Registrar uso de buenas practicas agricolas';
                        this.productor_id=0;
                        this.finca_id=0;
                        this.vivenda='Seleccione';
                        this.viveSitio='Seleccione';
                        this.bateriaSanitaria='Seleccione';
                        this.pozoSeptico='Seleccione';
                        this.zonaBarbecho='Seleccione';
                        this.usaBarbecho='Seleccione';
                        this.mezclaAgroquimicos='Seleccione';
                        this.usaAgroquimicos='Seleccione';
                        this.bodegaMateriales='Seleccione';
                        this.usaBodega='Seleccione';
                        this.canastillas='Seleccione';
                        this.usaCanastillas='Seleccione';
                        this.trajeProteccion='Seleccione';
                        this.usaTraje='Seleccione';
                        this.puntoEcologico='Seleccione';
                        this.usaPuntoEcologico='Seleccione';
                        this.agroquimicos='Seleccione';
                        this.botiquin='Seleccione';
                        this.usaBotiquin='Seleccione';
                        this.extintor='Seleccione';
                        this.usaExtintor='Seleccione';
                        this.capacitacionesBPA='Seleccione';
                        this.certificadas='Seleccione';
                        this.institucionCertificado='';   
                        this.tiempo=0; 
                        this.tipoAccion=1;
                        break;
                    }  case 'actualizar':
                    {
                        this.modal=1;
                        this.tituloModal='Detalle uso de buenas practicas agricolas';
                        this.tipoAccion=2;
                        this.practica_id=data['id'];
                        this.productor_id=data['productor_id'];
                        this.finca_id=data['finca_id'];
                        this.vivenda=data['vivenda'];
                        this.viveSitio=data['viveSitio'];
                        this.bateriaSanitaria=data['bateriaSanitaria'];
                        this.pozoSeptico=data['pozoSeptico'];
                        this.zonaBarbecho=data['zonaBarbecho'];
                        this.usaBarbecho=data['usaBarbecho'];
                        this.mezclaAgroquimicos=data['mezclaAgroquimicos'];
                        this.usaAgroquimicos=data['usaAgroquimicos'];
                        this.bodegaMateriales=data['bodegaMateriales'];
                        this.usaBodega=data['usaBodega'];
                        this.canastillas=data['canastillas'];
                        this.usaCanastillas=data['usaCanastillas'];
                        this.trajeProteccion=data['trajeProteccion'];
                        this.usaTraje=data['usaTraje'];
                        this.puntoEcologico=data['puntoEcologico'];
                        this.usaPuntoEcologico=data['usaPuntoEcologico'];
                        this.agroquimicos=data['agroquimicos'];
                        this.botiquin=data['botiquin'];
                        this.usaBotiquin=data['usaBotiquin'];
                        this.extintor=data['extintor'];
                        this.usaExtintor=data['usaExtintor'];
                        this.capacitacionesBPA=data['capacitacionesBPA'];
                        this.certificadas=data['certificadas'];
                        this.institucionCertificado=data['institucionCertificado'];  
                        this.tiempo=data['tiempo'];
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
           this.listarPractica(1,this.buscar,this.criterio);
           this.listarPracticaEx();
           
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