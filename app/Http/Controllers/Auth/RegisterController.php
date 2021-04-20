<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/register';//RouteServiceProvider::HOME;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        // event(new Registered($user = $this->create($request->all())));
        $this->create($request->all());
        // $this->guard()->login($user);   
        // if ($response = $this->registered($request, $user)) {
        //     return $response;
        // }
        if (User::all()->count()==1){
            $request->session()->flash('alert-success', 'Se ha registrado exitosamente! Eres el Administrador');
        }else{
            $request->session()->flash('alert-success', 'Se ha registrado exitosamente! Debe esperar a que un administrador acepte su petición de registro.');
        }
        return redirect()->back()->withInput();
        // return $request->wantsJson()
        //         ? new Response('', 201)
        //         : redirect()->back()->withInput();
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'max:20', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'required' =>'Este campo no debe estar vacio.',
            'max' => 'Este campo supera la capacidad máxima de caracteres.',
            'min' => 'Este campo supera la capacidad mínima de caracteres.',
            'string' => 'Este campo requiere un string.',
            'confirmed' => 'Las contraseñas no coinciden.',
            'email' => 'El email ingresado no es válido',
            'unique' => 'Este valor ya se encuentra registrado',
            ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        if (User::all()->count()==0){
            return User::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'estado' => 1,
            ])->assignRole('Administrador');
        }else{
            return User::create([
                'name' => $data['name'],
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'estado' => 0,
            ]);
        }
    }
}
