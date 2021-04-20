<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Especialidad;
use App\Area;
use App\Det_especialidad_area;
use DB;

class EspecialidadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:VerEspecialidades|FullEspecialidades')->only('index');
        $this->middleware('permission:RegistrarEspecialidad|FullEspecialidades')->only('store');
        $this->middleware('permission:EditarEspecialidad|FullEspecialidades')->only('update');
        $this->middleware('permission:EliminarEspecialidad|FullEspecialidades')->only('destroy');
    }
    public function index()
    {
       // $especialidades = DB::table('Especialidades as esp')
       //                      ->join('det_especialidad_area as det','det.id_especialidad','=','esp.id')
       //                      ->join('Areas as a','a.id','=','det.id_area')
       //                      ->select('esp.id','esp.nombre','esp.descripcion','a.tipo_dato')
       //                      ->get();
        //$especialidades = Especialidad::all();
        $areas = Area::all();
        return view('especialidades.index',compact('areas'));
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
        $dea = new Det_especialidad_area;
        $dea->id_area = $request->area;
        $dea->id_especialidad = $esp->id;
        $dea->save();
        return response()->json();
    }
    
    public function validarEspecialidad($request){
        $mensajes = [
            'required' =>'Este campo no debe estar vacio.',
            'max' => 'Este campo supera la capacidad máxima de caracteres.',
        ];
        return $request->validate([
            'esp_nombre' => 'required|max:30',
            'descripcion' => 'required|max:255',
            'area' => 'required',
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
        $this->validarEspecialidad($request);
        $update = Especialidad::findOrFail($id);

        $update->nombre= $request->esp_nombre;
        $update->descripcion = $request->descripcion;
        $update->save();

        $id_det_area_esp=DB::table('det_especialidad_area')->select('id')->where('id_especialidad','=',$id)->get();
        // $detesparea = Det_especialidad_area::where('id_especialidad', $id);
        $det_area_esp= Det_especialidad_area::findOrFail($id_det_area_esp[0]->id);
        $det_area_esp->id_area=$request->area;
        $det_area_esp->save();
        // echo $detesparea;

        // $array_ids = [];
        // foreach($detesparea as $det){
        //     array_push($array_ids, $det->id);
        // }
        // Det_especialidad_area::destroy($array_ids);
        // // $detesparea->delete();
        // $det = new Det_especialidad_area;
        // $det->id_especialidad = $update->id;
        // $det->id_area = $request->area;
        // // return redirect()->action("EspecialidadController@index");
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
        Especialidad::destroy($id);
        return response()->json();
    }
}
