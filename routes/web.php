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

Route::get('/test',function(){
	return view('triagepreguntas.test');
});
Route::post('atencionclinica/refresh','AtencionClinicaController@refresh')->name("refresh")->middleware('auth');

Route::get('/usuarios/pendientes/{id}/edit', 'usuariosController@aceptar')->middleware('auth');
Route::delete('/usuarios/pendientes/{id}', 'usuariosController@rechazar')->middleware('auth');
Route::get('/usuarios/pendientes', 'usuariosController@pendientes')->middleware('auth');
// Route::get('/triagepreguntas/estado/{triagepreguntas}', 'TriagepreguntasController@estado')->middleware('auth');
//Route::get('/triagepreguntas/analizar', 'TriagepreguntasController@analizar');
Route::get('/pacientes/shows', 'PacientesController@shows')->middleware('auth');
Route::get('/turnos/mostrar', 'TurnosController@mostrar')->name('mostrar')->middleware('auth');
Route::get('/turnos/respuesta','TurnosController@respuesta')->middleware('auth');
Route::post('turnos/cargaratencion','TurnosController@cargaratencion')->middleware('auth');
Route::post('/salas/filtros','salasController@filtro')->name('salas.filtro')->middleware('auth');
// Route::post('/usuarios/registrar','usuariosController@create')->name('usuarios.registrar');

Route::get('/editar/{id}', 'PacientesController@edit')->middleware('auth');

Route::post('/pacientes/nn','PacientesController@insertarNN')->middleware('auth');
Route::get('/atencionclinica/internacion','AtencionClinicaController@internar')->middleware('auth');

Route::resource('/rolusuario','userRolController');
Route::resource('/usuarios','usuariosController', ['except'=>['show', 'update']])->middleware('auth');
Route::resource('/sintomas','SintomasController',['except'=>['show','edit','create']]); //middleware en constructor
Route::resource('/atencionclinica','AtencionClinicaController')->middleware('auth');
Route::resource('/turnos','TurnosController')->middleware('auth');
Route::resource('/pacientes','PacientesController')->middleware('auth');
Route::resource('/triagepreguntas', 'TriagepreguntasController')->middleware('auth');
Route::resource('/salas', 'salasController');
Route::resource('/areas', 'areasController', ['except' => ['index', 'show', 'edit', 'create']]);
Route::resource('/protocolos', 'protocolosController');
Route::get('/profesionales/atenciones','profesionalesController@atenciones')->middleware('auth');
Route::resource('/profesionales', 'profesionalesController', ['except' => ['destroy', 'edit', 'update']]);
Route::resource('/cie','CieController');
Route::resource('/especialidades','EspecialidadController');
Route::resource('/roles','RolesController');
Route::get('/pruebas', function(){
    // User::create([
    //     'name' => "Cristian Zalazar",
    //     'username' => "cz",
    //     'email' => "cz@hotmail.com",
    //     'id_rol' => 2,
    //     'password' => Hash::make("asdfñlkj"),
    //     'estado' => 1,
    // ]);
    // User::create([
    //     'name' => "prueba de usuario",
    //     'username' => "prueba",
    //     'email' => "prueba@hotmail.com",
    //     'id_rol' => 1,
    //     'password' => Hash::make("asdfñlkj"),
    //     'estado' => 1,
    // ]);
    // User::create([
    //     'name' => "prueba2 de usuario",
    //     'username' => "prueba2",
    //     'email' => "prueba2@hotmail.com",
    //     'id_rol' => 1,
    //     'password' => Hash::make("asdfñlkj"),
    //     'estado' => 1,
    // ]);
    // echo url()->current();
    echo route('login');

    // Permission::create(['name'=>'EditarRolesUsuario']);
    // return redirect('/prueba2/'.$user);//->route('p2',$user);
});
Route::get('/prueba2/{user}',function(Request $request, $user){
    echo $user;
})->name('p2');

Route::post('/atencionclinica/sala','AtencionClinicaController@cargarSala')->middleware('auth');

Auth::routes();//['register' => false]);
Route::get('/inicio', 'HomeController@index')->name('inicio');
