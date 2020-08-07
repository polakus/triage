<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Rol;
use App\User;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        $roles = Rol::all();
        return view('auth.register', compact('roles'));
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
        
        // $this->guard()->login($user);   
        if ($response = $this->registered($request, $user)) {
            return $response;
        }
        if (User::all()->count()==1){
            $request->session()->flash('alert-success', 'Se ha registrado exitosamente! Eres el Super Administrador');
        }else{
            $request->session()->flash('alert-success', 'Se ha registrado exitosamente! Debe esperar a que el administrador '.User::find(1)->username.' acepte su petición de registro.');
        }
            return $request->wantsJson()
                    ? new Response('', 201)
                    : (redirect()->back()->withInput());
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }
}
