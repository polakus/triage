<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Especialidad;
use App\Area;
use DB;

class EspecialidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $especialidades = DB::table('Especialidades as esp')
                            ->join('det_especialidad_area as det','det.id_especialidad','=','esp.id')
                            ->join('Areas as a','a.id','=','det.id_area')
                            ->select('esp.id','esp.nombre','esp.descripcion','a.tipo_dato')
                            ->get();
        //$especialidades = Especialidad::all();
        $areas = Area::all();
        return view('especialidades.index',compact('especialidades','areas'));
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
        $this->validarEspecialidad($request);
        $esp = new Especialidad;
        $esp->nombre = $request->esp_nombre;
        $esp->descripcion= $request->descripcion;
        $esp->save();
        return redirect()->action('EspecialidadController@index');
    }
    public function validarEspecialidad($request){
        $mensajes = [
            'required' =>'Este campo no debe estar vacio.',
            'max' => 'Este campo supera la capacidad máxima de caracteres.',
        ];
        return $request->validate([
            'nombre' => 'required|max:30',
            'descripcion' => 'required|max:255',
            ''
        ], $mensajes);
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
        //  

        $update = Especialidad::findOrFail($id);

        if($request->editarnom !=""){
            $update->nombre= $request->editarnom;

        }
        if($request->des != ""){
            $update->descripcion = $request->des;
            
        }
        $update->save();
        return redirect()->action("EspecialidadController@index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
