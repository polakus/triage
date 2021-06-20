<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sintoma;

class SintomasController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('permission:VerSintomas|FullSintomas')->only('index');
        $this->middleware('permission:EditarSintoma|FullSintomas')->only('update');
        $this->middleware('permission:EliminarSintoma|FullSintomas')->only('destroy');
        $this->middleware('permission:RegistrarSintoma|FullSintomas')->only('store');        
    }
    public function index()
    {
        return view('sintomas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_sintoma' => 'distinct:ignore_case|required|max:4|unique:sintomas,descripcion',
            'dias' => 'numeric|min:0|max:100',
            'horas' => 'numeric|min:0|max:24',
        ],[
            'required' => 'Este campo no puede estar vacio.',
            'nombre_sintoma.max' => 'Este campo tiene más caracteres de lo permitido.',
            'min' => 'Este valor es menor al mínimo permitido.',
            'max' => 'Este valor sobrepasa al máximo permitido.',
            'unique' => 'Este síntoma ya se encuentra almacenado.',
            'numeric' => 'Este valor debe ser de tipo numérico.',
        ]);

        $nuevo= new Sintoma;
        $nuevo->descripcion = $request->get('nombre_sintoma');
        $nuevo->dias = empty($request->get('dias')) ? 0 : $request->get('dias');
        $nuevo->horas = empty($request->get('horas')) ? 0 : $request->get('horas');
        $nuevo->save();
        return response()->json(['mensaje' => "El síntoma se guardo exitosamente.", 'tipo' => "alert-success"]);
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
        //
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
        $request->validate([
            'nombre_sintoma' => 'required|max:4|unique:sintomas,descripcion,'.$id,
            'dias' => 'numeric|min:0|max:100',
            'horas' => 'numeric|min:0|max:24',
        ],[
            'required' => 'Este campo no puede estar vacio.',
            'nombre_sintoma.max' => 'Este campo tiene más caracteres de lo permitido.',
            'min' => 'Este valor es menor al mínimo permitido.',
            'max' => 'Este valor sobrepasa al máximo permitido.',
            'unique' => 'Este síntoma ya se encuentra almacenado.',
            'numeric' => 'Este valor debe ser de tipo numérico.',
            ]);
        $sintoma = Sintoma::find($id);
        $sintoma->descripcion = $request->nombre_sintoma;
        $sintoma->dias = $request->dias;
        $sintoma->horas = $request->horas;
        $sintoma->save();
        return response()->json(["mensaje"=>"El síntoma se actualizó exitosamente","tipo"=>"alert-success"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sintoma=Sintoma::findOrFail($id);
        $aux = $sintoma->descripcion;
        $sintoma->delete();
        return response()->json(["mensaje"=>'El síntoma '.$aux.' se eliminó exitosamente',"tipo"=>"alert-success"]);
        // return redirect('/sintomas');
    }
}
