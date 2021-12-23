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
                        <i class="fa fa-align-justify"></i> Nutricion
                        <button type="button" @click="abrirModal('nutricion','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                         <export-excel
                            class   = "button btn btn-success"
                            :data   = arrayNutricionEx
                            worksheet = "Nutricion"
                            name    = "nutricion.xls">
                            Excel
                            </export-excel>
                            <export-excel
                            class   = "button btn btn-success"
                            :data   = arrayNutricionEx
                            type="csv"
                            name    = "nutricion.xls">
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
                                    <input type="text" v-model="buscar" @keyup.enter="listarNutricion(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarNutricion(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
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
                                    <th>Analisis</th>
                                    <th>Fecha analisis</th>
                                     <th>Aplicacion Cal</th>
                                    <th>Fecha aplicacion Cal</th>
                                    <th>Aplicacion Materia Organica</th>
                                    <th>Fecha aplicacion materia organica</th>
                                    <th>Fecha ultima fertilizacion</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr v-for="nutricion in arrayNutricion" :key="nutricion.id">
                                    <td>
                                        <button type="button" @click="abrirModal('nutricion','actualizar',nutricion)" class="btn btn-warning btn-sm">
                                          <i class="icon-eye"></i>
                                        </button> &nbsp;
                                    </td> 
                                    <td v-text="nutricion.nombre"></td>
                                    <td v-text="nutricion.nombre_finca"></td> 
                                    <td v-text="nutricion.analisis"></td> 
                                    <td v-text="nutricion.fechaAnalisis"></td> 
                                    <td v-text="nutricion.aplicacionesCal"></td> 
                                    <td v-text="nutricion.fechaCal"></td> 
                                    <td v-text="nutricion.aplicacionesMateriaOrganica"></td>  
                                    <td v-text="nutricion.fechaMateriaOrganica"></td>
                                    <td v-text="nutricion.fechaUltimaFertilizacion"></td> 
                                                                  
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
                                    <label class="col-md-3 form-control-label" for="text-input">Ha realizado en su predio análisis de suelos</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="analisis">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Fecha de analisis</label>
                                    <div class="col-md-9">
                                         <v-datepicker :inline="true" v-model="fechaAnalisis "></v-datepicker>
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Fertiliza según las recomendaciones del analisis</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="fertilizaAnalisis">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Aplicacion de Cal</label>
                                    <div class="col-md-2">
                                      <select class="form-control" v-model="aplicacionesCal">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                    <label class="col-md-2 form-control-label" for="text-input">Aplico en Siembra</label>
                                    <div class="col-md-2">
                                      <select class="form-control" v-model="aplicoSiembraCal">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div> 
                                    <label class="col-md-2 form-control-label" for="text-input">Dosis de aplicacion(cm3/g)</label>
                                    <div class="col-md-2">
                                       <input type="number" v-model="dosisAplicacionCal"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                    
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Forma de aplicacion Cal</label>
                                    <div class="col-md-2">
                                      <select class="form-control" v-model="formaAplicacionCal">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Plato">En el plato</option>
                                            <option value="Lote">En todo el lote</option>
                                      </select>  
                                    </div>
                                    <label class="col-md-2 form-control-label" for="text-input">Frecuencia Aplicacion cal(Meses)</label>
                                    <div class="col-md-2">
                                       <input type="number" v-model="frecuenciaAplicacionCal"  class="form-control" placeholder="">
                                    </div>
                                </div> 
                                  <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Fecha ultima aplicacion</label>
                                    <div class="col-md-9">
                                         <v-datepicker :inline="true" v-model="fechaCal "></v-datepicker>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Aplicacion de Materia Organica</label>
                                    <div class="col-md-2">
                                      <select class="form-control" v-model="aplicacionesMateriaOrganica">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div>
                                    <label class="col-md-2 form-control-label" for="text-input">Aplico en Siembra</label>
                                    <div class="col-md-2">
                                      <select class="form-control" v-model="aplicoSiembraMateriaOrganica">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                      </select>  
                                    </div> 
                                    <label class="col-md-2 form-control-label" for="text-input">Dosis de aplicacion(cm3/g)</label>
                                    <div class="col-md-2">
                                       <input type="number" v-model="dosisAplicacionMateriaOrganica"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Forma de aplicacion Materia Organica</label>
                                    <div class="col-md-2">
                                      <select class="form-control" v-model="formaAplicacionMateriaOrganica">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Plato">En el plato</option>
                                            <option value="Lote">En todo el lote</option>
                                      </select>  
                                    </div>
                                    <label class="col-md-2 form-control-label" for="text-input">Frecuencia Aplicacion Materia Organica(Meses)</label>
                                    <div class="col-md-2">
                                       <input type="number" v-model="frecuenciaAplicacionMateriaOrganica"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Fecha ultima aplicacion materia organica</label>
                                    <div class="col-md-9">
                                         <v-datepicker :inline="true" v-model="fechaMateriaOrganica "></v-datepicker>
                                    </div>
                                </div>
                                  <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Fecha ultima fertilizacion</label>
                                    <div class="col-md-9">
                                         <v-datepicker :inline="true" v-model="fechaUltimaFertilizacion "></v-datepicker>
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="text-input">Forma de aplicacion de los fertilizantes</label>
                                    <div class="col-md-2">
                                      <select class="form-control" v-model="formaAplicacionFert">
                                            <option value="Seleccione" disabled>Seleccione</option>
                                            <option value="Liquida">Liquida Drench</option>
                                            <option value="Foliar">Foliar</option>
                                            <option value="Granulados">Granulados al suelo</option>
                                      </select>  
                                    </div>
                                    <label class="col-md-2 form-control-label" for="text-input">Frecuencia Fertilizacion(Dias)</label>
                                    <div class="col-md-2">
                                       <input type="number" v-model="frecuenciaAplicacionFert"  class="form-control" placeholder="">
                                    </div>
                                </div>

                                <div v-show="errorNutricion" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjNutricion" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarNutricion()">Guardar</button>
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
                nutricion_id:0,
                productor_id:0,
                finca_id:0,
                analisis:'Seleccione', 
                fechaAnalisis:'', 
                fertilizaAnalisis:'Seleccione', 
                aplicacionesCal:'Seleccione',
                aplicoSiembraCal:'Seleccione', 
                dosisAplicacionCal:0,
                formaAplicacionCal:'Seleccione',
                frecuenciaAplicacionCal:0,
                fechaCal:'',
                aplicacionesMateriaOrganica:'Seleccione',
                aplicoSiembraMateriaOrganica:'Seleccione',
                dosisAplicacionMateriaOrganica:'0',
                formaAplicacionMateriaOrganica:'Seleccione',
                frecuenciaAplicacionMateriaOrganica:0,
                fechaMateriaOrganica:'',
                fechaUltimaFertilizacion:'',
                formaAplicacionFert:'Seleccione',
                frecuenciaAplicacionFert:0,
                arrayNutricion: [],
                arrayNutricionEx: [],
                modal: 0,
                tituloModal : '',
                tipoAccion:0,
                errorNutricion : 0,
                errorMostrarMsjNutricion:[],
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
            listarNutricion(page,buscar,criterio){
                let me =this;
                var url ='nutricion?page='+page + '&buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayNutricion= respuesta.nutricions.data;
                    me.pagination=respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            listarNutricionEx(){
                let me =this;
                var url ='nutricion/excel';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayNutricionEx= respuesta.nutricions;
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
                me.listarNutricion(page,buscar,criterio);
            },
            registrarNutricion(){
            if(this.validarNutricion()){
                return;
            }
            let me=this;
            axios.post('nutricion/registrar',{
                'productor_id':this.productor_id,
                'finca_id':this.finca_id,
                'analisis':this.analisis, 
                'fechaAnalisis':this.fechaAnalisis, 
                'fertilizaAnalisis':this.fertilizaAnalisis, 
                'aplicacionesCal':this.aplicacionesCal,
                'aplicoSiembraCal':this.aplicoSiembraCal, 
                'dosisAplicacionCal':this.dosisAplicacionCal,
                'formaAplicacionCal':this.formaAplicacionCal,
                'frecuenciaAplicacionCal':this.frecuenciaAplicacionCal,
                'fechaCal':this.fechaCal,
                'aplicacionesMateriaOrganica':this.aplicacionesMateriaOrganica,
                'aplicoSiembraMateriaOrganica':this.aplicoSiembraMateriaOrganica,
                'dosisAplicacionMateriaOrganica':this.dosisAplicacionMateriaOrganica,
                'formaAplicacionMateriaOrganica':this.formaAplicacionMateriaOrganica,
                'frecuenciaAplicacionMateriaOrganica':this.frecuenciaAplicacionMateriaOrganica,
                'fechaMateriaOrganica':this.fechaMateriaOrganica,
                'fechaUltimaFertilizacion':this.fechaUltimaFertilizacion,
                'formaAplicacionFert':this.formaAplicacionFert,
                'frecuenciaAplicacionFert':this.frecuenciaAplicacionFert
            }).then(function (response) {
                    me.cerrarModal();
                    me.listarNutricion(1,'','personas');
                })
                .catch(function (error) {
                    console.log(error);
                });

        },
        cargarPdf(){
                window.open('http://gestion.asofrut.org/nutricion/listarPdf');
            },    
            validarNutricion(){
            this.errorNutricion=0;
            this.errorMostrarMsjNutricion=[];
            if(this.productor_id==0)this.errorMostrarMsjNutricion.push("Debe seleccionar un productor");
            if(this.finca_id==0)this.errorMostrarMsjNutricion.push("Debe seleccionar una finca.");
            if(this.errorMostrarMsjNutricion.length) this.errorNutricion=1;

            return this.errorNutricion;
        },
            cerrarModal(){
                        this.modal=0;
                        this.tituloModal='';
                        this.productor_id=0;
                        this.finca_id=0;
                        this.analisis='Seleccione';
                        this.fechaAnalisis='';
                        this.fertilizaAnalisis='Seleccione'; 
                        this.aplicacionesCal='Seleccione';
                        this.aplicoSiembraCal='Seleccione';
                        this.dosisAplicacionCal=0;
                        this.formaAplicacionCal='Seleccione';
                        this.frecuenciaAplicacionCal='Seleccione';
                        this.fechaCal='';
                        this.aplicacionesMateriaOrganica='Seleccione';
                        this.aplicoSiembraMateriaOrganica='Seleccione';
                        this.dosisAplicacionMateriaOrganica=0;
                        this.formaAplicacionMateriaOrganica='Seleccione';
                        this.frecuenciaAplicacionMateriaOrganica=0;
                        this.fechaMateriaOrganica='';
                        this.fechaUltimaFertilizacion='';
                        this.formaAplicacionFert='Seleccione';
                        this.frecuenciaAplicacionCal=0;
		                this.errorNutricion=0;
        },
            abrirModal(modelo,accion,data = []){
            switch (modelo) {
                case "nutricion":
                {    
                switch (accion) {
                    case 'registrar':
                    {
                        this.modal = 1;
                        this.tituloModal = 'Registrar nutricion';
                        this.productor_id=0;
                        this.finca_id=0;
                        this.analisis='Seleccione';
                        this.fechaAnalisis='';
                        this.fertilizaAnalisis='Seleccione'; 
                        this.aplicacionesCal='Seleccione';
                        this.aplicoSiembraCal='Seleccione';
                        this.dosisAplicacionCal=0;
                        this.formaAplicacionCal='Seleccione';
                        this.frecuenciaAplicacionCal='Seleccione';
                        this.fechaCal='';
                        this.aplicacionesMateriaOrganica='Seleccione';
                        this.aplicoSiembraMateriaOrganica='Seleccione';
                        this.dosisAplicacionMateriaOrganica=0;
                        this.formaAplicacionMateriaOrganica='Seleccione';
                        this.frecuenciaAplicacionMateriaOrganica=0;
                        this.fechaMateriaOrganica='';
                        this.fechaUltimaFertilizacion='';
                        this.formaAplicacionFert='Seleccione';
                        this.frecuenciaAplicacionCal=0;
                        this.tipoAccion=1;
                        break;
                    }  case 'actualizar':
                    {
                        this.modal=1;
                        this.tituloModal='Detalle nutricion';
                        this.tipoAccion=2;
                        this.nutricion_id=data['id'];
                        this.productor_id=data['productor_id'];
                        this.finca_id=data['finca_id'];
                         this.analisis=data['analisis'];
                        this.fechaAnalisis=data['fechaAnalisis'];
                        this.fertilizaAnalisis=data['fertilizaAnalisis']; 
                        this.aplicacionesCal=data['aplicacionesCal'];
                        this.aplicoSiembraCal=data['aplicoSiembraCal'];
                        this.dosisAplicacionCal=data['dosisAplicacionCal'];
                        this.formaAplicacionCal=data['formaAplicacionCal'];
                        this.frecuenciaAplicacionCal=data['frecuenciaAplicacionCal'];
                        this.fechaCal=data['fechaCal'];
                        this.aplicacionesMateriaOrganica=data['aplicacionesMateriaOrganica'];
                        this.aplicoSiembraMateriaOrganica=data['aplicoSiembraMateriaOrganica'];
                        this.dosisAplicacionMateriaOrganica=data['dosisAplicacionMateriaOrganica'];
                        this.formaAplicacionMateriaOrganica=data['formaAplicacionMateriaOrganica'];
                        this.frecuenciaAplicacionMateriaOrganica=data['frecuenciaAplicacionMateriaOrganica'];
                        this.fechaMateriaOrganica=data['fechaMateriaOrganica'];
                        this.fechaUltimaFertilizacion=data['fechaUltimaFertilizacion'];
                        this.formaAplicacionFert=data['formaAplicacionFert'];
                        this.frecuenciaAplicacionFert=data['frecuenciaAplicacionFert'];
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
           this.listarNutricion(1,this.buscar,this.criterio);
           this.listarNutricionEx();

           
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