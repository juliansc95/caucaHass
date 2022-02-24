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
            }
        },
        mounted() {
            this.getVentas();
            this.getCompras();
            this.getIngresos();
            this.getProyeccion();
            this.getProyeccion20212();
        },
    }
</script>
    