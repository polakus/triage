<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sintoma;

class SintomasController extends Controller
{
    public function __construct(){
        $this->middleware('permission:VerSintoma|FullSintoma');
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
            'nombre_sintoma' => 'distinct:ignore_case|required|max:255|unique:sintomas,descripcion',
            
        ],[
            'required' => 'Este campo no puede estar vacio.',
            'max' => 'Este es demasiado largo.',
            'unique' => 'Este síntoma ya se encuentra almacenado.'
        ]);
        $name = $request->get('nombre_sintoma');

        $nuevo=new Sintoma;
        $nuevo->descripcion=$request->get('nombre_sintoma');
        $nuevo->save();

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
            'nombre' => 'required|max:255|unique:sintomas,descripcion,'.$id,
        ],[
            'required' => 'Este campo no puede estar vacio.',
            'max' => 'Este es demasiado largo.',
            'unique' => 'Este síntoma ya se encuentra almacenado.'
            ]);
        $sintoma = Sintoma::find($id);
        $sintoma->descripcion = $request->nombre;
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
