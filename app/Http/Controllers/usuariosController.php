<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Response;
// use App\Providers\RouteServiceProvider;
// use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Rol;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


use Illuminate\Foundation\Auth\RegistersUsers;

class usuariosController extends Controller
{
    public function __construct(){
        $this->middleware('permission:VerUsuarios|FullUsuarios');
        $this->middleware('permission:RegistrarUsuario|FullUsuarios')->only('create');
        $this->middleware('permission:EliminarUsuario|FullUsuarios')->only('destroy');
        $this->middleware('permission:AceptarUsuario|FullUsuarios')->only(['pendientes','aceptar','rechazar']);
    }

    public function index()
    {
       $roles = Rol::all();
        return view('usuarios.index',compact('roles'));
    }

    public function create()
    {
        $roles = Rol::all();
        return view('usuarios.create', compact ('roles'));
    }

    public function store(Request $request)
    {
        return $this->register($request);
    }
    
    public function show($id)
    {
        //
    }
    
    public function edit($id)
    {
        
    }
    public function pendientes(){
        return view('usuarios.pendientes');
    }

    public function aceptar(Request $request, $id){
        $usuario = User::find($id);
        $usuario->estado = 1;
        $usuario->save();
        $tipo='alert-success';
        $mensaje='Se ha aceptado la solicitud del usuario '.$usuario->username;
        return response()->json(['tipo'=>$tipo,'mensaje'=>$mensaje]);
    }

    public function rechazar($id){
        $aux = User::find($id)->username;
        if(User::destroy($id)){
            $tipo='alert-success';
            $mensaje='La solicitud del usuario '.$aux.' fue rechazada exitosamente!';
        }else{
            $tipo='alert-danger';
            $mensaje='Hubo un problema para rechazar al usuario '.$aux;
        }
        return response()->json(['tipo'=>$tipo,'mensaje'=>$mensaje]);
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        $mensaje="";
        $tipo="";
        $aux = User::find($id);
        if(User::destroy($id)){
            $mensaje='El usuario '.$aux->username.' fue eliminado exitosamente!';
            $tipo="alert-success";
        }else{
            $tipo="alert-danger";
            $mensaje='Hubo un problema para eliminar al usuario '.$aux->username;
        }
        
        return response()->json(['mensaje'=>$mensaje,'tipo'=>$tipo]);
    }
    // public function destroy($id)
    // {
    //     $mensaje="";
    //     $tipo="";
    //     $aux = User::find($id);
    //     if(Auth::user()->esAdmin()){ # El usuario logueado es Administrador?
    //         if(! (User::find($id)->esAdmin())){ # El usuario que se quiere eliminar es administrador?
    //             if(User::destroy($id)){
    //                 $mensaje='El usuario '.$aux->username.' fue eliminado exitosamente!';
    //                 $tipo="alert-success";
    //                 // $request->session()->flash('alert-success', 'El usuario '.$aux.' fue eliminado exitosamente!');
    //             }else{
    //                 $tipo="alert-danger";
    //                 $mensaje='Hubo un problema para eliminar al usuario '.$aux->username;
    //                 // $request->session()->flash('alert-danger', 'Hubo un problema para eliminar al usuario '.$aux);
    //             }
    //         }else{
    //             if(Auth::id()==1){ # El usuario logueado es Super Administrador?
    //                 if(! ($aux->id==1)){
    //                     if(User::destroy($id)){
    //                         $mensaje='El usuario '.$aux->username.' fue eliminado exitosamente!';
    //                         $tipo="alert-success";
    //                         // $request->session()->flash('alert-success', 'El usuario '.$aux.' fue eliminado exitosamente!');
    //                     }else{
    //                         $mensaje='Hubo un problema para eliminar al usuario '.$aux->username;
    //                         $tipo="alert-danger";
    //                         // $request->session()->flash('alert-danger', 'Hubo un problema para eliminar al usuario '.$aux);
    //                     }
    //                 }else{
    //                     $mensaje='No puedes eliminar el superusuario. La página dejaría de funcionar si esto se permitiera';
    //                     $tipo="alert-danger";
    //                 }
    //             }else{
    //                 $tipo="alert-warning";
    //                 $mensaje= 'Solo el usuario '.User::find(1)->username.' puede eliminar a los usuarios Administradores!';
    //                 // $request->session()->flash('alert-warning', 'Solo el usuario '.User::find(1)->username.' puede eliminar a los usuarios Administradores!');
    //             }
    //         }
    //     }else{ # Si no es administrador entonces no puede eliminar usuarios
    //         $tipo="alert-warning";
    //         $mensaje=  'Debes ser administrador para eliminar otros usuarios!';
    //         // $request->session()->flash('alert-warning', 'Debes ser administrador para eliminar otros usuarios!');
    //     }
    //     return response()->json(['mensaje'=>$mensaje,'tipo'=>$tipo]);
    // }

    ###################################################################################################


    // public function showRegistrationForm()
    // {
    //     $roles = Rol::all();
    //     return view('auth.register', compact('roles'));
    // }
    public function register(Request $request)
    {
        // if (Auth::user()->esAdmin()){
            $this->validator($request->all())->validate();
            event(new Registered($user = $this->create2($request->all())));
            // $this->guard()->login($user);
            if ($response = $this->registered($request, $user)) {
                return $response;
            }
            $request->session()->flash('alert-success', 'El usuario se ha creado exitosamente!');
            return $request->wantsJson()
                        ? new Response('', 201)
                        : redirect()->back()->withInput();
        // }else{
        //     $request->session()->flash('alert-warning', 'Necesitas ser Administrador para realizar la registración de un nuevo usuario!');
        //     return redirect()->back()->withInput();
        // }
    }

    protected function registered(Request $request, $user)
    {
        // if(User::find($user->id)){
        //     echo "Está registrado";
        //     return "";
        // }else{
        //     echo "No estaba registrado";
        //     return "";
        // }
    }
    // public function redirectPath()
    // {
    //     if (method_exists($this, 'redirectTo')) {
    //         return $this->redirectTo();
    //     }

    //     return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    // }
    protected function guard()
    {
        return Auth::guard();
    }

    // use RegistersUsers;

    // /**
    //  * Where to redirect users after registration.
    //  *
    //  * @var string
    //  */
    // protected $redirectTo = RouteServiceProvider::HOME;

    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    // /**
    //  * Get a validator for an incoming registration request.
    //  *
    //  * @param  array  $data
    //  * @return \Illuminate\Contracts\Validation\Validator
    //  */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'max:20', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],[
            'required' =>'Este campo no debe estar vacio.',
            'max' => 'Este campo supera la capacidad máxima de caracteres.',
            'min' => 'Este campo supera la capacidad mínima de caracteres.',
            'string' => 'Este campo requiere un string.',
            'confirmed' => 'Las contraseñas no coinciden.',
            'email' => 'El email ingresado no es válido',
            'unique' => 'Este valor ya se encuentra registrado',
            ]);
    }

    // /**
    //  * Create a new user instance after a valid registration.
    //  *
    //  * @param  array  $data
    //  * @return \App\User
    //  */
    protected function create2(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'estado' => 1,
        ]);
    }
}