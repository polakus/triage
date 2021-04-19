<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sala;
use App\Especialidad;
use App\Area;
use App\DetalleProfSala;
use App\DetalleAtencion;
use App\Historial;

use DB;

class salasController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:VerSalasAreas|FullSalasAreas|FullSalas');
    }
    public function index(Request $request)
    {
        // $salas = Sala::all();
        $areas = Area::all();
        // $val1 = $request->val1;
      
        return view('salas.index', compact('areas')); 
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
        $mensajes = [
            'required' => 'Este campo no debe estar vacío.',
            'max' => 'Este campo supera la capacidad máxima de caracteres.',
            'min' => 'El valor está por debajo del mínimo.',
        ];
        $pr = $request->validate([
            'nombre' => 'required|max:255',
            'camas' =>'required|numeric|min:0',
            'area' => 'required',
        ], $mensajes);
        
        $sala = Sala::create([
            'nombre' => $request->nombre,
            'camas' => $request->camas,
            'id_area' => $request->area,
            'disponibilidad' => 1,
        ]);
        // $request->session()->flash('alert-success', 'La sala fue agregada exitosamente!');
        // return redirect()->back()->withInput();
        return response()->json(['hola'=> 3]);
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
        
        $sala = Sala::find($id);
        if($sala->disponibilidad == 0){
            $sala->disponibilidad = 1;
        }else{
            $sala->disponibilidad=0;
        }
        $sala->save();
        
        // return redirect()->action('salasController@index',['val1'=>$val1, 'val2'=>$val2]);
        return response()->json(['disp'=>$sala->disponibilidad]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
  
        $id_det_prof_sala=DB::table('det_profesionales_salas')->select('id')->where('id_sala','=',$id)->get();
        if(sizeof($id_det_prof_sala)>0){
            $id_detalle_atencion=DB::table('detalle_atencion')->select('id')->where('id_det_profesional_sala','=',$id_det_prof_sala[0]->id)->get();
            if(sizeof($id_detalle_atencion)>0){
                $id_historial=DB::table('historial')->select('id')->where('id_detalle_atencion','=',$id_detalle_atencion[0]->id)->get();
                if(sizeof($id_historial)>0){
                    Historial::destroy($id_historial[0]->id);
                }
                DetalleAtencion::destroy($id_detalle_atencion[0]->id);
            }
            DetalleProfSala::destroy($id_det_prof_sala[0]->id);
        }
        Sala::destroy($id);
        // $val1 = $_POST['n'];
        // $val2 =$_POST['a'];
        // return redirect()->action('salasController@index',['val1'=>$val1, 'val2'=>$val2]);
        return response()->json();
    }
}
