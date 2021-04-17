<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CIE;
use Illuminate\Support\Facades\Validator;

class CieController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:VerCie|FullCie');
    }
    public function index()
    {
        return view('cie.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $c = $request->validate([
            'nombre' => 'required|max:255',
            'codigo' => 'required|unique:cie',
        ],[
            'required' => 'Este campo no puede estar vacio.',
            'max' => 'Este es demasiado largo.',
            'unique' => 'Este codigo ya se encuentra almacenado.'
        ]);
        $nuevo=new CIE;
        $nuevo->codigo=$request->codigo;
        $nuevo->descripcion=$request->nombre;
        $nuevo->save();
        $tipo ="alert-success";
        $mensaje = "El CIE ".$request->nombre." se agregó correctamente ";
        return response()->json(["tipo"=>$tipo, "mensaje"=>$mensaje]);
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
        $c = $request->validate([
            'nombre' => 'required|max:255',
            'codigo' => 'required',
        ],[
            'required' => 'Este campo no puede estar vacio.',
            'max' => 'Este es demasiado largo.',
        ]);
        $update = CIE::findOrFail($id);
        if ( $update->codigo!=$request->codigo){
            $request->validate(['codigo'=>'unique:cie'],['unique' => 'Este codigo ya se encuentra almacenado.']);
            $update->codigo= $request->codigo;
        }
        $update->descripcion = $request->nombre;
        $update->save();
        return response()->json(["tipo"=>"alert-success","mensaje"=>"El CIE ".$request->codigo." se actualizó exitosamente"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $cie=CIE::findOrFail($id);
        $aux = $cie->codigo;
        $cie->delete();
        return response()->json(["tipo"=>"alert-success","mensaje"=>"El CIE ".$aux." se eliminó exitosamente"]);
    }
}
