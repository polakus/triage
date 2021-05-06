<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Profesional;
use Spatie\Permission\Models\Permission;
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

// Route::get('/test',function(){
// 	return view('triagepreguntas.test');
// });
Route::post('atencionclinica/refresh','AtencionClinicaController@refresh')->name("refresh")->middleware('auth');

Route::get('/usuarios/pendientes/{id}/edit', 'usuariosController@aceptar')->middleware('auth');
Route::delete('/usuarios/pendientes/{id}', 'usuariosController@rechazar')->middleware('auth');
Route::get('/usuarios/pendientes', 'usuariosController@pendientes')->middleware('auth');
// Route::get('/triagepreguntas/estado/{triagepreguntas}', 'TriagepreguntasController@estado')->middleware('auth');
// Route::get('/triagepreguntas/analizar', 'TriagepreguntasController@analizar');
Route::get('/turnos/mostrar', 'TurnosController@mostrar')->name('mostrar')->middleware('auth');
Route::get('/turnos/respuesta','TurnosController@respuesta')->middleware('auth');
Route::post('turnos/cargaratencion','TurnosController@cargaratencion')->middleware('auth');
// Route::post('/usuarios/registrar','usuariosController@create')->name('usuarios.registrar');

Route::get('/editar/{id}', 'PacientesController@edit')->middleware('auth');

Route::post('/pacientes/nn','PacientesController@insertarNN')->middleware('auth');
Route::get('/atencionclinica/internacion','AtencionClinicaController@internar')->middleware('auth');

Route::resource('/usuarios/rolusuario','userRolController',['except' => ['index','create','store','show','destroy']]);
Route::resource('/usuarios','usuariosController', ['except'=>['show', 'update','edit']]);
Route::resource('/sintomas','SintomasController',['except'=>['show','edit','create']]); //middleware en constructor
Route::resource('/atencionclinica','AtencionClinicaController')->middleware('auth');
Route::resource('/turnos','TurnosController')->middleware('auth');
Route::resource('/pacientes','PacientesController',['except' => ['show','destroy']]);
Route::resource('/triagepreguntas', 'TriagepreguntasController')->middleware('auth');
Route::resource('/salas', 'salasController', ['except' => ['create','show','edit']]);
Route::resource('/areas', 'areasController', ['except' => ['index', 'show', 'edit', 'create']]);
Route::resource('/protocolos', 'protocolosController',['except' => ['show']]);
Route::get('/profesionales/atenciones','profesionalesController@atenciones')->middleware('auth');
Route::resource('/profesionales', 'profesionalesController', ['except' => ['show','index','destroy', 'edit', 'update']]);
Route::resource('/cie','CieController',['except' => ['create','show','edit']]);
Route::resource('/especialidades','EspecialidadController',['except' => ['create','show','edit']]);
Route::resource('/roles','RolesController',['except' => ['show']]);

Route::post('/turnos/mostrar/conf','TurnosController@cargar_configuracion_areas')->middleware('auth');

Route::get('/pruebas', function(){
    
//     // echo url()->current();
//     $user=User::find(12);
//     $user->estado=0;
//     $user->save();
//     // Permission::create(['name'=>'EditarRolesUsuario']);
//     // return redirect('/prueba2/'.$user);//->route('p2',$user);
$start=microtime(true);
$pacientes= DB::table('pacientes')->where('nombre','!=','nn')->where('apellido','!=','nn')->get();
echo microtime(true)-$start;
});
// Route::get('/prueba2/{user}',function(Request $request, $user){
//     echo $user;
// })->name('p2');

Route::post('/atencionclinica/sala','AtencionClinicaController@cargarSala')->middleware('auth');

Auth::routes();//['register' => false]);
Route::get('/inicio', 'HomeController@index')->name('inicio');

