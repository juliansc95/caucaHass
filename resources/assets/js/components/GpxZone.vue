<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Cargar area finca archivo gpx(Track_2021)</div>
    
                    <div class="card-body">
                        <div v-if="success != ''" class="alert alert-success" role="alert">
                          {{success}}
                        </div>
                        <form @submit="formSubmit" enctype="multipart/form-data">
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
                                    <label class="col-md-3 form-control-label" for="text-input">Archivo GPX</label>
                                    <div class="col-md-9">
                                       <input type="file" class="form-control" v-on:change="onFileChange">
                                    </div>
                                </div>
                        <button class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
   
<script>
    export default {
        mounted() {
            console.log('Component mounted.')
             this.selectProductor();
            this.selectFinca(this.productor_id);   
        },
        data() {
            return {
              name: '',
              productor_id:0,
              finca_id:0,
              file: '',
              success: '',
              arrayProductor : [],
              arrayFinca : []
            };
        },
        methods: {
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
            onFileChange(e){
                console.log(e.target.files[0]);
                this.file = e.target.files[0];
            },
            formSubmit(e) {
                e.preventDefault();
                let currentObj = this;
   
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
    
                let formData = new FormData();
                formData.append('file', this.file);
                formData.append('productor_id', this.productor_id);
                formData.append('finca_id', this.finca_id);
   
                axios.post('gpxzonesubmit', formData, config)
                .then(function (response) {
                    currentObj.success = response.data.success;
                })
                .catch(function (error) {
                    currentObj.output = error;
                });
            }
        }
    }
</script>