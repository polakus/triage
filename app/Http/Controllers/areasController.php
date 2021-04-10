<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;

class areasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('areas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pr = $request->validate([
            'nombre' => 'required|max:255|unique:areas',
        ], [
            'required' =>'Este campo no debe estar vacío.',
            'unique' => 'Este registro ya se encuentra almacenado',
            'max' => 'Este campo supera la capacidad máxima de caracteres.',
        ]);
        $area = Area::create([
            'nombre' => $request->nombre,
        ]);
        // $area = new Area;
        // $area->tipo_dato = $request->nombre;
        // $area->save();
        // $request->session()->flash('alert-success', 'El area fue agregado exitosamen!');
        // return redirect()->back()->withInput();
        return response()->json(["mensaje"=>"El área ".$area->nombre." fue agregado exitosamente",
                                "tipo"=>"alert-success"]);
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
        $area = Area::find($id);
        $request->validate([
            'nombre' => 'required|max:255|unique:areas,nombre,'.$id,
        ], [
            'required' =>'Este campo no debe estar vacío.',
            'unique' => 'Ya existe un área con el mismo nombre',
            'max' => 'Este campo supera la capacidad máxima de caracteres.',
        ]);
        $area->nombre = $request->nombre;
        $area->save();
        return response()->json(["mensaje"=>"El Área ".$area->nombre." se guardó exitosamente",
                                 "tipo"=>"alert-success"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $area = Area::find($id);
        $aux = $area->nombre;
        $area->delete();
        return response()->json(["mensaje"=>"El Área ".$aux." se eliminó exitosamente",
            "tipo"=>"alert-success"]);
    }
}
