<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Role_Has_Permissions;
use DB;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:VerRoles|FullRoles')->only('index');
        $this->middleware('permission:RegistrarRol|FullRoles')->only(['create','store']);
        $this->middleware('permission:EditarRol|FullRoles')->only(['edit','update']);
        $this->middleware('permission:EliminarRol|FullRoles')->only('destroy');
    }
    
    public function index()
    {
        // $roles = Role::all();
        return view('roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permisos = Permission::all();
        return view('roles.create', compact('permisos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mensajes = [
            'permisos.required' =>'Debe agregar al menos un permiso a la tabla.',
            'required' =>'Este campo no debe estar vacio.',
            'max' => 'Este campo supera la capacidad máxima de caracteres.',
        ];
        $roles = $request->validate([
            'nombre_rol' => 'required',
            'permisos' => 'required'
        ], $mensajes);
        $rol = new Role;
        $rol->name = $request->nombre_rol;
        $rol->save();
        $permisos = $request->permisos;
        for($i=0;$i<count($permisos);$i++){
            DB::table('role_has_permissions')->insert([
                ['permission_id' => $permisos[$i],'role_id' => $rol->id],
            ]);
        }
        return response()->json();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permisos = Permission::all();
        $rol = Role::find($id);

        $permisos_rol = DB::table('roles')
                   ->join('role_has_permissions as rol_perm','rol_perm.role_id','=','roles.id')
                   ->join('permissions as permisos','permisos.id','=','rol_perm.permission_id')
                   ->select('permisos.name as nombre_permiso','permisos.id')
                   ->where('roles.id','=',$id)
                   ->get();
        return view('roles.edit',compact('permisos','rol','permisos_rol','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mensajes = [
            'permisos.required' =>'Debe agregar al menos un permiso a la tabla.',
            'required' =>'Este campo no debe estar vacio.',
            'max' => 'Este campo supera la capacidad máxima de caracteres.',
        ];
        $roles = $request->validate([
            'nombre_rol' => 'required',
            'permisos' => 'required'
        ], $mensajes);
        Role_Has_Permissions::where('role_id', '=', $id)->delete();
        $rol = $rol = Role::find($id);
        $rol->name= $request->nombre_rol;
        $rol->save();
        $permisos = $request->permisos;
        for($i=0;$i<count($permisos);$i++){
            DB::table('role_has_permissions')->insert([
                ['permission_id' => $permisos[$i],'role_id' => $id],

            ]);
        }
        return response()->json();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::where('id','=',$id)->delete();
        return response()->json();
    }
}
