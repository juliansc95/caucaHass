<template>
<main class="main">
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
    </ol>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                
            </div>
            <div class="car-body">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h4>Usuarios</h4>
                            </div>
                            <div class="card-content">
                                <div class="ct-chart">
                                    <canvas id="ingresos">                                                
                                    </canvas>
                                </div>
                            </div>
                            <div class="card-footer">
                                <p>Usuarios registrados por dia</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h4>Ventas</h4>
                            </div>
                            <div class="card-content">
                                <div class="ct-chart">
                                    <canvas id="ventas">                                                
                                    </canvas>
                                </div>
                            </div>
                            <div class="card-footer">
                                <p>Ventas de los últimos dias.</p>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-md-9">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h4>Compras</h4>
                            </div>
                            <div class="card-content">
                                <div class="ct-chart">
                                    <canvas id="compras">                                                
                                    </canvas>
                                </div>
                            </div>
                            <div class="card-footer">
                                <p>Compras de los últimos dias.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h4>Proyecciones 2021-1</h4>
                            </div>
                            <div class="card-content">
                                <div class="ct-chart">
                                    <canvas id="proyeccion">                                                
                                    </canvas>
                                </div>
                            </div>
                            <div class="card-footer">
                                <p>Proyecciones de cosecha Datos 2021-1.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h4>Proyecciones 2021-2</h4>
                            </div>
                            <div class="card-content">
                                <div class="ct-chart">
                                    <canvas id="proyeccion20212">                                                
                                    </canvas>
                                </div>
                            </div>
                            <div class="card-footer">
                                <p>Proyecciones de cosecha Datos 2021-2.</p>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-md-9">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h4>Proyecciones 2022-1</h4>
                            </div>
                            <div class="card-content">
                                <div class="ct-chart">
                                    <canvas id="proyeccion20221">                                                
                                    </canvas>
                                </div>
                            </div>
                            <div class="card-footer">
                                <p>Proyecciones de cosecha Datos 2022-1.</p>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-md-9">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h4>Proyecciones 2022-2</h4>
                            </div>
                            <div class="card-content">
                                <div class="ct-chart">
                                    <canvas id="proyeccion20222">                                                
                                    </canvas>
                                </div>
                            </div>
                            <div class="card-footer">
                                <p>Proyecciones de cosecha Datos 2022-2.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
</template>
<script>
    export default{
        data(){
            return{
                 varIngreso:null,
                charIngreso:null,
                ingresos:[],
                varTotalIngreso:[],
                varMesIngreso:[], 

                varVenta:null,
                charVenta:null,
                ventas:[],
                varTotalVenta:[],
                varMesVenta:[],

                varCompra:null,
                charCompra:null,
                ventas:[],
                varTotalCompra:[],
                varMesCompra:[],

                varProyeccion:null,
                charProyeccion:null,
                proyeccion:[],
                varTotalProyeccion:[],
                varPeriodoProyeccion:[],

                varProyeccion20212:null,
                charProyeccion20212:null,
                proyeccion20212:[],
                varTotalProyeccion20212:[],

                varProyeccion20221:null,
                charProyeccion20221:null,
                proyeccion20221:[],
                varTotalProyeccion20221:[],

                varProyeccion20222:null,
                charProyeccion20222:null,
                proyeccion20222:[],
                varTotalProyeccion20222:[],
            }
        },
        methods: {
            getIngresos(){
                let me=this;
                var url= 'dashboard';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.ingresos = respuesta.usuarios;
                    //cargamos los datos del chart
                    me.loadIngresos();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getVentas(){
                let me=this;
                var url= 'dashboard';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.ventas = respuesta.ventas;
                    //cargamos los datos del chart
                    me.loadVentas();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getCompras(){
                let me=this;
                var url= 'dashboard';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.compras = respuesta.compras;
                    //cargamos los datos del chart
                    me.loadCompras();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getProyeccion(){
                let me=this;
                var url= 'dashboard';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.proyeccion = respuesta.proyeccions;
                    //cargamos los datos del chart
                    me.loadProyeccion();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getProyeccion20212(){
                let me=this;
                var url= 'dashboard';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.proyeccion20212 = respuesta.proyeccions20212;
                    //cargamos los datos del chart
                    me.loadProyeccion20212();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getProyeccion20221(){
                let me=this;
                var url= 'dashboard';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.proyeccion20221 = respuesta.proyeccions20221;
                    //cargamos los datos del chart
                    me.loadProyeccion20221();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
             getProyeccion20222(){
                let me=this;
                var url= 'dashboard';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.proyeccion20222 = respuesta.proyeccions20222;
                    //cargamos los datos del chart
                    me.loadProyeccion20222();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            loadIngresos(){
                let me=this;
                me.ingresos.map(function(x){
                    me.varMesIngreso.push(x.mes);
                    me.varTotalIngreso.push(x.total);
                });
                me.varIngreso=document.getElementById('ingresos').getContext('2d');

                me.charIngreso = new Chart(me.varIngreso, {
                    type: 'bar',
                    data: {
                        labels: me.varMesIngreso,
                        datasets: [{
                            label: 'Usuarios',
                            data: me.varTotalIngreso,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 0.2)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            },
            loadVentas(){
                let me=this;
                me.ventas.map(function(x){
                    me.varMesVenta.push(x.Fechaa);
                    me.varTotalVenta.push(x.total);
                });
                me.varVenta=document.getElementById('ventas').getContext('2d');

                me.charVenta = new Chart(me.varVenta, {
                    type: 'bar',
                    data: {
                        labels: me.varMesVenta,
                        datasets: [{
                            label: 'Ventas',
                            data: me.varTotalVenta,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 0.2)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            },
            loadCompras(){
                let me=this;
                me.compras.map(function(x){
                    me.varMesCompra.push(x.Fechaa);
                    me.varTotalCompra.push(x.total);
                });
                me.varCompra=document.getElementById('compras').getContext('2d');

                me.charCompra = new Chart(me.varCompra, {
                    type: 'bar',
                    data: {
                        labels: me.varMesCompra,
                        datasets: [{
                            label: 'Compras',
                            data: me.varTotalCompra,
                            backgroundColor: 'rgba(255, 165, 0, 0.2)',
                            borderColor: 'rgba(255, 165, 0, 0.2)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            },
            loadProyeccion(){
                let me=this;
                me.proyeccion.map(function(x){
                    me.varTotalProyeccion.push(x.Nacional);
                    me.varTotalProyeccion.push(x.Exportacion);
                });
                me.varProyeccion=document.getElementById('proyeccion').getContext('2d');

                me.charProyeccion = new Chart(me.varProyeccion, {
                    type: 'bar',
                    data: {
                        labels:['Nacional','Exportacion'],
                        datasets: [{
                            label: 'Total Kg',
                            data: me.varTotalProyeccion,
                            backgroundColor: 'rgba(118, 244, 6, 0.2)',
                            borderColor: 'rgba(118, 244, 6, 0.2)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            },
            loadProyeccion20212(){
                let me=this;
                me.proyeccion20212.map(function(x){
                    me.varTotalProyeccion20212.push(x.Nacional);
                    me.varTotalProyeccion20212.push(x.Exportacion);
                });
                me.varProyeccion20212=document.getElementById('proyeccion20212').getContext('2d');

                me.charProyeccion20212 = new Chart(me.varProyeccion20212, {
                    type: 'bar',
                    data: {
                        labels:['Nacional','Exportacion'],
                        datasets: [{
                            label: 'Total Kg',
                            data: me.varTotalProyeccion20212,
                            backgroundColor: 'rgba(65, 105, 225, 0.2)',
                            borderColor: 'rgba(65, 105, 225, 0.2)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            },
            loadProyeccion20221(){
                let me=this;
                me.proyeccion20221.map(function(x){
                    me.varTotalProyeccion20221.push(x.Nacional);
                    me.varTotalProyeccion20221.push(x.Exportacion);
                });
                me.varProyeccion20221=document.getElementById('proyeccion20221').getContext('2d');

                me.charProyeccion20221 = new Chart(me.varProyeccion20221, {
                    type: 'bar',
                    data: {
                        labels:['Nacional','Exportacion'],
                        datasets: [{
                            label: 'Total Kg',
                            data: me.varTotalProyeccion20221,
                            backgroundColor: 'rgba(255, 215, 0, 0.2)',
                            borderColor: 'rgba(255, 215, 0, 0.2)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            },
            loadProyeccion20222(){
                let me=this;
                me.proyeccion20222.map(function(x){
                    me.varTotalProyeccion20222.push(x.Nacional);
                    me.varTotalProyeccion20222.push(x.Exportacion);
                });
                me.varProyeccion20222=document.getElementById('proyeccion20222').getContext('2d');

                me.charProyeccion20222 = new Chart(me.varProyeccion20222, {
                    type: 'bar',
                    data: {
                        labels:['Nacional','Exportacion'],
                        datasets: [{
                            label: 'Total Kg',
                            data: me.varTotalProyeccion20222,
                            backgroundColor: 'rgba(255, 182, 193, 0.2)',
                            borderColor: 'rgba(255, 182, 193, 0.2)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            }
        },
        mounted() {
            this.getVentas();
            this.getCompras();
            this.getIngresos();
            this.getProyeccion();
            this.getProyeccion20212();
            this.getProyeccion20221();
            this.getProyeccion20222();
        },
    }
</script>
    