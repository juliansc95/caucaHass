<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware'=>['guest']],function(){
    //Rutas Login
    Route::get('/','Auth\LoginController@showLoginForm');
    Route::post('/login','Auth\LoginController@login')->name('login');
});

Route::group(['middleware'=>['auth']],function(){

    Route::post('/logout','Auth\LoginController@logout')->name('logout');
    Route::get('/dashboard','DashboardController');

    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');
    

    

     //Rutas de los select
     Route::get('/tipoId/selectTipoId','TipoIdController@selectTipoId');
     Route::get('/sexo/selectSexo','SexoController@selectSexo');
     Route::get('/escolaridad/selectEscolaridad','GradoEscolaridadController@selectGradoEscolaridad');
     Route::get('/etnia/selectEtnia','EtniaController@selectEtnia');
     Route::get('/departamento/selectDepartamento','DepartamentoController@selectDepartamento');
     Route::get('/municipio/selectMunicipio','MunicipioController@selectMunicipio');
     Route::get('/vereda/selectVereda','VeredaController@selectVereda');
     Route::get('/resguardo/selectResguardo','ResguardoController@selectResguardo');
     Route::get('/productor/selectProductor','ProductorController@selectProductor');
     Route::get('/posesion/selectPosesion','PosesionController@selectPosesion');
     Route::get('/linea/selectLinea','LineaController@selectLinea');
     Route::get('/finca/selectFinca/{id}','FincaController@selectFinca');
     Route::get('/finca/selectFincaEncuesta','FincaController@selectFincaEncuesta');
     Route::get('/cadena/selectCadena','CadenaController@selectCadena');
     Route::get('/lugarVenta/selectLugarVenta','LugarVentaController@selectLugarVenta');
     Route::get('/productor/selectProductor2','ProductorController@selectProductor2');
     Route::get('/linea/selectLinea2','LineaController@selectLinea2');
     Route::get('/lugarVenta/selectLugarVenta2','LugarVentaController@selectLugarVenta2');
     Route::get('/equipoAplicacion/selectEquipo','EquipoAplicacionController@selectEquipo');
     Route::get('/metodoAplicacion/selectMetodo','EquipoAplicacionController@selectMetodo');
     Route::get('/unidadAplicacion/selectUnidad','EquipoAplicacionController@selectUnidad');
     Route::get('/unidadDosis/selectDosis','EquipoAplicacionController@selectDosis');
     Route::get('/producto/selectProducto2','EquipoAplicacionController@selectProducto2');
     Route::get('/concepto/selectConcepto','ConceptoGastoController@selectConcepto');


     //Rutas Encuesta fitosanitaria
     Route::get('/fitosanitaria', 'EncuestaFitosanitariaController@index');
     Route::post('/fitosanitaria/registrar', 'EncuestaFitosanitariaController@store');
     Route::get('/fitosanitaria/id', 'EncuestaFitosanitariaController@MostrarId');


     //Rutas Encuesta asofrut
     Route::get('/visita', 'EncuestaAsofrutController@index');
     Route::post('/visita/registrar', 'EncuestaAsofrutController@store');

     //Caracterizacion predio cultivo
     Route::get('/predio', 'PredioCultivoController@index');
     Route::post('/predio/registrar', 'PredioCultivoController@store');

    //Caracterizacion podas
    Route::get('/poda', 'PodaController@index');
     Route::post('/poda/registrar', 'PodaController@store');
    
    //Caracterizacion plagas
    Route::get('/plaga', 'PlagaController@index');
    Route::post('/plaga/registrar', 'PlagaController@store');

    //Caracterizacion nutricion
    Route::get('/nutricion', 'NutricionController@index');
    Route::post('/nutricion/registrar', 'NutricionController@store');

    //Caracterizacion tutorado
    Route::get('/tutorado', 'TutoradoController@index');
    Route::post('/tutorado/registrar', 'TutoradoController@store');

    //Caracterizacion riego
    Route::get('/riego', 'RiegoController@index');
    Route::post('/riego/registrar', 'RiegoController@store');

    //Caracterizacion practica
     Route::get('/practica', 'PracticaController@index');
     Route::post('/practica/registrar', 'PracticaController@store');

    //Caracterizacion Enfermedad
    Route::get('/enfermedad', 'EnfermedadController@index');
    Route::post('/enfermedad/registrar', 'EnfermedadController@store');

     //Caracterizacion vocacion
     Route::get('/vocacion', 'VocacionController@index');
     Route::post('/vocacion/registrar', 'VocacionController@store');

     //Caracterizacion suelo
     Route::get('/suelo', 'SueloController@index');
     Route::post('/suelo/registrar', 'SueloController@store');

    //Caracterizacion cosechas
    Route::get('/cosecha', 'CosechaController@index');
    Route::post('/cosecha/registrar', 'CosechaController@store');

    Route::post('/formSubmit','GpxUploadController@formSubmit');
    Route::post('/gpxzonesubmit','GpxZonesController@formSubmit');
    Route::get('/gpxzones','GpxZonesController@index');

    //Rutas Gastos Establecimiento
    Route::get('/gastos', 'GastosEstablecimientoController@index');
    Route::get('/gastosPro', 'GastosEstablecimientoController@indexProductor');
    Route::post('/gastos/registrar', 'GastosEstablecimientoController@store');
    Route::get('/gastos/excel', 'GastosEstablecimientoController@excel');

    //Rutas Gastos Adecuacion Renovacion
    Route::get('/renovacion', 'AdecuacionRenovacionController@index');
    Route::get('/renovacionPro', 'AdecuacionRenovacionController@indexProductor');
    Route::post('/renovacion/registrar', 'AdecuacionRenovacionController@store');
    Route::get('/renovacion/excel', 'AdecuacionRenovacionController@excel');
  
    //Rutas Gastos Produccion
    Route::get('/produccion', 'GastosProduccionController@index');
    Route::get('/produccionPro', 'GastosProduccionController@indexProductor');
    Route::post('/produccion/registrar', 'GastosProduccionController@store');
    Route::get('/produccion/excel', 'GastosProduccionController@excel');


    //Resumen
    Route::get('/resumen', 'ResumenController@index');
    Route::get('/resumenP', 'ResumenController@indexProductor');


     Route::group(['middleware'=>['Productor']],function(){
        Route::get('/cultivoP','CultivoController@indexProductor');   
        Route::get('/productorP','ProductorController@indexProductor');
        Route::get('/fincaP','FincaController@indexProductor');
        Route::get('/ventaP','ventaController@indexProductor');
        Route::get('/finca/listarPdf','FincaController@listarPdf')->name('fincas_pdf');
        Route::get('/fitosanitaria/listarPdf','EncuestaFitosanitariaController@listarPdf')->name('fitosanitaria_pdf');
        Route::get('/fitosanitaria/excel','EncuestaFitosanitariaController@excel');
       });

       Route::group(['middleware'=>['Contador']],function(){
        Route::put('/venta/pasarFacturacion', 'VentaController@pasarFacturacion');    
        Route::put('/venta/pasarDisponiblePago', 'VentaController@pasarDisponiblePago');    
        Route::put('/venta/pasarPagado', 'VentaController@pasarPagado'); 
        Route::get('/venta', 'VentaController@index');       
        });
  

    Route::group(['middleware'=>['Administrador']],function(){
        Route::post('/formSubmit','GpxUploadController@formSubmit');
        Route::get('/gps','GpxUploadController@index');
        Route::get('/backup', 'BackupController@backupDatabase');
     //Ruta productor fitosanitarios   
     Route::post('/fitosanitario/registrar','ProductoFitosanitarioController@store');
     Route::put('/fitosanitario/actualizar','ProductoFitosanitarioController@update');
     Route::get('/fitosanitario','ProductoFitosanitarioController@index');
   
     //Rutas Ventas
     Route::get('/venta', 'VentaController@index');
     Route::post('/venta/registrar', 'VentaController@store');
     Route::put('/venta/desactivar', 'VentaController@desactivar');
     Route::get('/venta/obtenerCabecera', 'VentaController@obtenerCabecera');
     Route::get('/venta/obtenerDetalles', 'VentaController@obtenerVentaCategoria');
     Route::put('/venta/pasarFacturacion', 'VentaController@pasarFacturacion');    
     Route::put('/venta/pasarDisponiblePago', 'VentaController@pasarDisponiblePago');    
     Route::put('/venta/pasarPagado', 'VentaController@pasarPagado');    
     Route::get('/venta/pdf/{id}','VentaController@pdf')->name('venta_pdf');
     Route::get('/venta/listarPdf','VentaController@listarPdf')->name('ventas_pdf');
     Route::get('/venta/listarDiario','VentaController@listarPdfDiario')->name('ventas_dia_pdf');
    
    //Rutas PDF
    Route::get('/finca/listarPdf','FincaController@listarPdf')->name('fincas_pdf');
    Route::get('/cultivo/listarPdf','CultivoController@listarPdf')->name('cultivos_pdf');
    Route::get('/productor/listarPdf','ProductorController@listarPdf')->name('productores_pdf');           
    Route::get('/fitosanitaria/listarPdf','EncuestaFitosanitariaController@listarPdf')->name('fitosanitaria_pdf');
    Route::get('/producto/listarPdf','ProductoFitosanitarioController@listarPdf')->name('producto_pdf');
    Route::get('/mora/listarPdf','CategoriaMoraController@listarPdf')->name('mora_pdf');
    Route::get('/lugarVenta/listarPdf','LugarVentaController@listarPdf')->name('lugarVenta_pdf');
    Route::get('/user/listarPdf','UserController@listarPdf')->name('users_pdf');
    Route::get('/predioCultivo/listarPdf','PredioCultivoController@listarPdf')->name('predioCultivo_pdf');
    Route::get('/poda/listarPdf','PodaController@listarPdf')->name('poda_pdf');
    Route::get('/plaga/listarPdf','PlagaController@listarPdf')->name('plaga_pdf');
    Route::get('/nutricion/listarPdf','NutricionController@listarPdf')->name('nutricion_pdf');
    Route::get('/tutorado/listarPdf','TutoradoController@listarPdf')->name('tutorado_pdf');
    Route::get('/riego/listarPdf','RiegoController@listarPdf')->name('riego_pdf');
    Route::get('/practica/listarPdf','PracticaController@listarPdf')->name('practica_pdf');
    Route::get('/enfermedad/listarPdf','EnfermedadController@listarPdf')->name('enfermedad_pdf');
    Route::get('/suelo/listarPdf','SueloController@listarPdf')->name('suelo_pdf');
    Route::get('/vocacion/listarPdf','VocacionController@listarPdf')->name('vocacion_pdf');
    Route::get('/cosecha/listarPdf','CosechaController@listarPdf')->name('cosecha_pdf');
    Route::get('/encuesta/listarPdf','EncuestaAsofrutController@listarPdf')->name('encuesta_pdf');


    //Rutas Excel
    Route::get('/finca/excel','FincaController@excel');
    Route::get('/cultivo/excel','CultivoController@excel');
    Route::get('/productor/excel','ProductorController@excel');
    Route::get('/fitosanitaria/excel','EncuestaFitosanitariaController@excel');
    Route::get('/producto/excel','ProductoFitosanitarioController@excel');
    Route::get('/venta/excel','VentaController@excel');
    Route::get('/mora/excel','CategoriaMoraController@excel');
    Route::get('/lugarVenta/excel','LugarVentaController@excel');
    Route::get('/user/excel','UserController@excel');
    Route::get('/predioCultivo/excel','PredioCultivoController@excel');
    Route::get('/poda/excel','PodaController@excel');
    Route::get('/plaga/excel','PlagaController@excel');
    Route::get('/nutricion/excel','NutricionController@excel');
    Route::get('/tutorado/excel','TutoradoController@excel');
    Route::get('/riego/excel','RiegoController@excel');
    Route::get('/practica/excel','PracticaController@excel');
    Route::get('/enfermedad/excel','EnfermedadController@excel');
    Route::get('/suelo/excel','SueloController@excel');
    Route::get('/vocacion/excel','VocacionController@excel');
    Route::get('/cosecha/excel','CosechaController@excel');
    Route::get('/encuesta/excel','EncuestaAsofrutController@excel');
    

     //Rutas Lugares de Venta
     Route::get('/lugarVenta','LugarVentaController@index');
     Route::post('/lugarVenta/registrar','LugarVentaController@store');
     Route::put('/lugarVenta/actualizar','LugarVentaController@update');

    //Rutas Categoria Moras
    Route::get('/categoriaMora','CategoriaMoraController@index');
    Route::post('/categoriaMora/registrar','CategoriaMoraController@store');
    Route::put('/categoriaMora/actualizar','CategoriaMoraController@update');    
    Route::get('/categoriaMora/buscarCategoria','CategoriaMoraController@buscarCategoria');
    Route::get('/categoriaMora/listarCategoria','CategoriaMoraController@listarCategoria');  

    //Rutas Cultivos
    Route::get('/cultivo','CultivoController@index');
    Route::post('/cultivo/registrar','CultivoController@store');
    Route::put('/cultivo/actualizar','CultivoController@update');    

     //Rutas Fincas
    Route::get('/finca','FincaController@index');
    Route::post('/finca/registrar','FincaController@store');
    Route::put('/finca/actualizar','FincaController@update');

     //Rutas productores
     Route::get('/productor','ProductorController@index');
     Route::post('/productor/registrar','ProductorController@store');
     Route::put('/productor/actualizar','ProductorController@update');
     
     
     //Rutas roles
     Route::get('/rol','RolController@index');
     Route::get('/rol/selectRol','RolController@selectRol');
     
     //Rutas usuarios
     Route::get('/user','UserController@index');
     Route::post('/user/registrar','UserController@store');
     Route::put('/user/actualizar','UserController@update');
     Route::put('/user/desactivar','UserController@desactivar');
     Route::put('/user/activar','UserController@activar');

    Route::get('/categoria','CategoriaController@index');
    Route::post('/categoria/registrar','CategoriaController@store');
    Route::put('/categoria/actualizar','CategoriaController@update');
    Route::put('/categoria/desactivar','CategoriaController@desactivar');
    Route::put('/categoria/activar','CategoriaController@activar');
    Route::get('/categoria/selectCategoria','CategoriaController@selectCategoria');
    
    
    Route::get('/articulo','ArticuloController@index');
    Route::post('/articulo/registrar','ArticuloController@store');
    Route::put('/articulo/actualizar','ArticuloController@update');
    Route::put('/articulo/desactivar','ArticuloController@desactivar');
    Route::put('/articulo/activar','ArticuloController@activar');
    
    Route::get('/cliente','ClienteController@index');
    Route::post('/cliente/registrar','ClienteController@store');
    Route::put('/cliente/actualizar','ClienteController@update');
    
    Route::get('/proveedor','ProveedorController@index');
    Route::post('/proveedor/registrar','ProveedorController@store');
    Route::put('/proveedor/actualizar','ProveedorController@update');
    });


    Route::group(['middleware'=>['TecnicoComercial']],function(){
    //Rutas Ventas
    Route::get('/venta', 'VentaController@index');
    Route::post('/venta/registrar', 'VentaController@store');
    Route::put('/venta/desactivar', 'VentaController@desactivar');
    Route::get('/venta/obtenerCabecera', 'VentaController@obtenerCabecera');
    Route::get('/venta/obtenerDetalles', 'VentaController@obtenerVentaCategoria');
    Route::put('/venta/pasarFacturacion', 'VentaController@pasarFacturacion');    
    Route::put('/venta/pasarDisponiblePago', 'VentaController@pasarDisponiblePago');    
    Route::put('/venta/pasarPagado', 'VentaController@pasarPagado');
    Route::get('/venta/pdf/{id}','VentaController@pdf')->name('venta_pdf');
    Route::get('/venta/listarPdf','VentaController@listarPdf')->name('ventas_pdf');
    Route::get('/venta/listarDiario','VentaController@listarPdfDiario')->name('ventas_dia_pdf');
    
    
    
     //Rutas Categoria Moras
    Route::get('/categoriaMora','CategoriaMoraController@index');
    Route::get('/categoriaMora/buscarCategoria','CategoriaMoraController@buscarCategoria');
    Route::get('/categoriaMora/listarCategoria','CategoriaMoraController@listarCategoria'); 
    
     //Rutas Excel
     Route::get('/venta/excel','VentaController@excel');
    });

    Route::group(['middleware'=>['TecnicoExtensionista']],function(){
        //Rutas Fincas
        Route::get('/finca','FincaController@index');
        Route::post('/finca/registrar','FincaController@store');
        Route::put('/finca/actualizar','FincaController@update');
        
        //Rutas Cultivos
        Route::get('/cultivo','CultivoController@index');
        Route::post('/cultivo/registrar','CultivoController@store');
        Route::put('/cultivo/actualizar','CultivoController@update'); 

          //Rutas productores
        Route::get('/productor','ProductorController@index');
        Route::post('/productor/registrar','ProductorController@store');
        Route::put('/productor/actualizar','ProductorController@update');

        //Rutas PDF
    Route::get('/finca/listarPdf','FincaController@listarPdf')->name('fincas_pdf');
    Route::get('/cultivo/listarPdf','CultivoController@listarPdf')->name('cultivos_pdf');
    Route::get('/productor/listarPdf','ProductorController@listarPdf')->name('productores_pdf');           
    Route::get('/fitosanitaria/listarPdf','EncuestaFitosanitariaController@listarPdf')->name('fitosanitaria_pdf');
    Route::get('/producto/listarPdf','ProductoFitosanitarioController@listarPdf')->name('producto_pdf');
    Route::get('/mora/listarPdf','CategoriaMoraController@listarPdf')->name('mora_pdf');
    Route::get('/lugarVenta/listarPdf','LugarVentaController@listarPdf')->name('lugarVenta_pdf');
    Route::get('/user/listarPdf','UserController@listarPdf')->name('users_pdf');
    Route::get('/predioCultivo/listarPdf','PredioCultivoController@listarPdf')->name('predioCultivo_pdf');
    Route::get('/poda/listarPdf','PodaController@listarPdf')->name('poda_pdf');
    Route::get('/plaga/listarPdf','PlagaController@listarPdf')->name('plaga_pdf');
    Route::get('/nutricion/listarPdf','NutricionController@listarPdf')->name('nutricion_pdf');
    Route::get('/tutorado/listarPdf','TutoradoController@listarPdf')->name('tutorado_pdf');
    Route::get('/riego/listarPdf','RiegoController@listarPdf')->name('riego_pdf');
    Route::get('/practica/listarPdf','PracticaController@listarPdf')->name('practica_pdf');
    Route::get('/enfermedad/listarPdf','EnfermedadController@listarPdf')->name('enfermedad_pdf');
    Route::get('/suelo/listarPdf','SueloController@listarPdf')->name('suelo_pdf');
    Route::get('/vocacion/listarPdf','VocacionController@listarPdf')->name('vocacion_pdf');
    Route::get('/cosecha/listarPdf','CosechaController@listarPdf')->name('cosecha_pdf');
    Route::get('/encuesta/listarPdf','EncuestaAsofrutController@listarPdf')->name('encuesta_pdf');


    //Rutas Excel
    Route::get('/finca/excel','FincaController@excel');
    Route::get('/cultivo/excel','CultivoController@excel');
    Route::get('/productor/excel','ProductorController@excel');
    Route::get('/fitosanitaria/excel','EncuestaFitosanitariaController@excel');
    Route::get('/producto/excel','ProductoFitosanitarioController@excel');
    Route::get('/venta/excel','VentaController@excel');
    Route::get('/mora/excel','CategoriaMoraController@excel');
    Route::get('/lugarVenta/excel','LugarVentaController@excel');
    Route::get('/user/excel','UserController@excel');
    Route::get('/predioCultivo/excel','PredioCultivoController@excel');
    Route::get('/poda/excel','PodaController@excel');
    Route::get('/plaga/excel','PlagaController@excel');
    Route::get('/nutricion/excel','NutricionController@excel');
    Route::get('/tutorado/excel','TutoradoController@excel');
    Route::get('/riego/excel','RiegoController@excel');
    Route::get('/practica/excel','PracticaController@excel');
    Route::get('/enfermedad/excel','EnfermedadController@excel');
    Route::get('/suelo/excel','SueloController@excel');
    Route::get('/vocacion/excel','VocacionController@excel');
    Route::get('/cosecha/excel','CosechaController@excel');
    Route::get('/encuesta/excel','EncuestaAsofrutController@excel');
    });

    

    
    
    
    
   
});    

//Route::get('/home', 'HomeController@index')->name('home');
