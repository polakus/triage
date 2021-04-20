<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\User;

class userRolController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:ModificarRolesUsuario|FullUsuarios');
    }
    public function index()
    {
        
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id){
        
    }

    public function edit($id)
    {
        $useroles = User::find($id)->getRoleNames();
        $roles = Role::all();
        $usuario = User::find($id);
        return view('rolusuario.show', compact('useroles', 'roles', 'usuario'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'useroles'=>'required',//|not_in:'. implode(',', ['Profesional'])
        ],[
            'required'=>'Al menos el rol de Profesional debe ser ingresado',
            // 'not_in'=>'Al menos el rol de Profesional es necesario'
        ]);
        $usuario = User::find($id);
        $usuario->syncRoles($request->useroles);
        return response()->json([
            'tipo'=>'alert-success',
            'mensaje'=>'Los roles se modificaron exitosamente'
        ]);
    }

    public function destroy($id)
    {
        //
    }
}
