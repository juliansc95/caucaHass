<template>
   <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                
      <div class="form-row">
        <div class="col-md-12">
          <label class="form-control-label"  for="input-file-import">Carga Archivo de Ventas(Extension xls, xlsx)</label>
          <input type="file" class="form-control" :class="{ ' is-invalid' : error.message }" id="input-file-import" name="file_import" ref="import_file"  @change="onFileChange">
          <div v-if="error.message" class="invalid-feedback">
            
          </div>
        </div>
      
   </div>    
                    <!-- fin ver ingreso -->
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
        </main>
</template>
<script>
  export default {
     data() {
        return {
          error: {},
          import_file: '',
        }
      },
      methods: {
         onFileChange(e) {
        this.import_file = e.target.files[0];
        console.log(this.import_file);
        let formData = new FormData();
        formData.append('import_file', this.import_file);
        console.log(formData);   
        
        axios.post('ventas/import', formData, {
              headers: { 'content-type': 'multipart/form-data' }
            })
            .then(response => {
                console.log(response.status);
                if(response.status === 200) {
                   alert("Sus ventas han sido cargadas con exito");
                }
            })
            .catch(error => {
                // code here when an upload is not valid
                this.uploading = false
                this.error = error.response.data
                console.log('check error: ', this.error);
                alert("Sus ventas no se han podido cargar");
            });
    }

   
      }
  }
</script>