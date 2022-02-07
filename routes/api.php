<?php

    use Illuminate\Http\Request;

    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
    */

      
    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });
 
    Route::group([

        'middleware' => 'api',
        'prefix' => 'auth'

    ], function ($router) {

        Route::post('login', ['as' => 'login', 'uses' => 'Auth\LoginController@loginApi']);
        Route::post('register', 'Auth\LoginController@register');
        Route::post('logout', 'Auth\LoginController@logout');
        Route::post('me', 'Auth\LoginController@me');

        //Route::post('refresh', 'Auth2\AuthController@refresh');
    });

    Route::get('/tipoId/selectTipoId','TipoIdController@selectTipoId');
    Route::get('/selects','selectController@select');
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
    Route::get('municipio/{id}', 'MunicipioController@departamentoMunicipio');
    Route::get('vereda/{id}', 'VeredaController@municipioVerera');

    Route::get('/finca','FincaController@indexApi');
    Route::post('/finca/registrar','FincaController@store');
    Route::put('/finca/actualizar','FincaController@update');

    Route::get('/cultivo','CultivoController@indexapi');
    Route::post('/cultivo/registrar','CultivoController@store');
    Route::put('/cultivo/actualizar','CultivoController@update');

    Route::post('/productor/registrar','ProductorController@store');

    Route::post('/fitosanitario/registrar','ProductoFitosanitarioController@store');
    Route::post('/fitosanitaria/registrar', 'EncuestaFitosanitariaController@storeApi');

    Route::post('/predio/registrar', 'PredioCultivoController@store');

    Route::post('/poda/registrar', 'PodaController@store');

    Route::post('/plaga/registrar', 'PlagaController@store');

    Route::post('/nutricion/registrar', 'NutricionController@store');

    Route::post('/tutorado/registrar', 'TutoradoController@store');

    Route::post('/riego/registrar', 'RiegoController@store');

    Route::post('/practica/registrar', 'PracticaController@store');

    Route::post('/enfermedad/registrar', 'EnfermedadController@store');

    Route::post('/suelo/registrar', 'SueloController@store');

    Route::post('/vocacion/registrar', 'VocacionController@store');

    Route::post('/cosecha/registrar', 'CosechaController@store');
