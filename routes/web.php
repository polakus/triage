<?php

use App\Http\Middleware\EsAdmin;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Profesional;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/atencionclinica/atencionsala','AtencionClinicaController@atencionsala')->middleware('auth');

Route::get('/test',function(){
	return view('triagepreguntas.test');
});
Route::post('atencionclinica/refresh','AtencionClinicaController@refresh')->name("refresh");

Route::get('/usuarios/pendientes/{id}/edit', 'usuariosController@aceptar')->middleware('auth');
Route::delete('/usuarios/pendientes/{id}', 'usuariosController@rechazar')->middleware('auth');
Route::get('/usuarios/pendientes', 'usuariosController@pendientes')->middleware('auth');
// Route::get('/triagepreguntas/estado/{triagepreguntas}', 'TriagepreguntasController@estado')->middleware('auth');
//Route::get('/triagepreguntas/analizar', 'TriagepreguntasController@analizar');
Route::get('/pacientes/shows', 'PacientesController@shows')->middleware('auth');
Route::get('/turnos/mostrar', 'TurnosController@mostrar')->name('mostrar')->middleware('auth');
Route::get('/turnos/respuesta','TurnosController@respuesta')->middleware('auth');
Route::post('turnos/cargaratencion','TurnosController@cargaratencion');
Route::post('/salas/filtros','salasController@filtro')->name('salas.filtro')->middleware('auth');
// Route::post('/usuarios/registrar','usuariosController@create')->name('usuarios.registrar');
Route::get('/editar/{id}', 'PacientesController@edit');
Route::post('/pacientes/nn','PacientesController@insertarNN')->middleware('auth');
Route::get('/atencionclinica/internacion','AtencionClinicaController@internar')->middleware('auth');

Route::resource('/usuarios','usuariosController', ['except'=>['show', 'update']])->middleware('auth');
Route::resource('/sintomas','SintomasController')->middleware('auth');
Route::resource('/atencionclinica','AtencionClinicaController')->middleware('auth');
Route::resource('/turnos','TurnosController')->middleware('auth');
Route::resource('/pacientes','PacientesController')->middleware('auth');
Route::resource('/triagepreguntas', 'TriagepreguntasController')->middleware('auth');
Route::resource('/salas', 'salasController')->middleware('auth');
Route::resource('/areas', 'areasController', ['except' => ['destroy', 'show', 'edit']])->middleware('auth');
Route::get('/editarProtocolo/{id}','protocolosController@editar');
Route::resource('/protocolos', 'protocolosController')->middleware('auth');
Route::get('/profesionales/atenciones','profesionalesController@atenciones')->middleware('auth');
Route::resource('/profesionales', 'profesionalesController', ['except' => ['destroy', 'edit', 'update']])->middleware('auth');
Route::resource('/cie','CieController')->middleware('auth');
Route::resource('/especialidades','EspecialidadController')->middleware('auth');
Route::get('/pruebas', function(){
    // $detesp = App\Det_especialidad_area::all();
    // foreach($detesp as $cie){
    //     echo $cie->area->tipo_dato."<br>";
    // }
    // foreach(App\Det_especialidad_area::all() as $det){
    //     echo $det->area->id.'<br>';
    // }
    foreach(App\Protocolo::all() as $esp){
        foreach($esp->detalle_protocolo as $det)
            echo $det->especialidad.'<br>';
    }
    // echo $area_seleccionada = App\Det_especialidad_area::where('id_especialidad', '=', 5)->first()->area->id;
});


Route::post('/atencionclinica/sala','AtencionClinicaController@cargarSala')->middleware('auth');



Auth::routes();#['register' => false]);
Route::get('/inicio', 'HomeController@index')->name('inicio');
