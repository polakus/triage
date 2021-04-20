<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;

class areasController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('permission:RegistrarArea|FullSalas')->only('store');
        $this->middleware('permission:EliminarArea|FullSalas')->only('destroy');
        $this->middleware('permission:EditarArea|FullSalas')->only('update');
    }
    public function index()
    {
        //
    }
    public function create()
    {
        
    }
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
        return response()->json(["mensaje"=>"El área ".$area->nombre." fue agregado exitosamente",
                                "tipo"=>"alert-success",
                                "id"=>$area->id]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

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

    public function destroy($id){
        $area = Area::find($id);
        $aux = $area->nombre;
        $area->delete();
        return response()->json(["mensaje"=>"El Área ".$aux." se eliminó exitosamente",
            "tipo"=>"alert-success"]);
    }
}
