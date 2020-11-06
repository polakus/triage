<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Protocolo;
use App\Codigo;
use App\Sintoma;
use App\Detalle_Sintoma_Protocolo;
use App\Especialidad;
use App\DetalleProtocolo;
use DB;

class protocolosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $protocolo = Protocolo::find(9);
        // $var =  $protocolo->det_sintomas_protocolos()->get();
        // foreach($var as $v){
        //     echo $v->id_sintoma;
        // }


        $protocolos = Protocolo::all();
        $det_sintomas_protocolos = Detalle_Sintoma_Protocolo::all();
        // foreach($protocolos as $protocolo){
        //     foreach($protocolo->det_sintomas_protocolos()->where('id_protocolo', 9)->get() as $det){
        //         echo $det;
        //     }
        // }
        return view('protocolos.index',compact('protocolos', 'det_sintomas_protocolos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $codigos = Codigo::all();
        $sintomas = Sintoma::all();
        $especialidades = Especialidad::all();
        return view('protocolos.create', compact('codigos', 'sintomas','especialidades'));
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
            'required' =>'Este campo no debe estar vacio.',
            'max' => 'Este campo supera la capacidad máxima de caracteres.',
        ];
        $prot = $request->validate([
            'desc' => 'required|max:255',
        ], $mensajes);
        $protocolo = new Protocolo;
        $protocolo->id_codigo_triage= $request->codigo;
        $protocolo->descripcion= $request->desc;
        $protocolo->save();

        $sintomas = $_POST['cbs'];
        foreach($sintomas as $sintoma){
            $dsp = new Detalle_Sintoma_Protocolo;
            $dsp->id_protocolo = $protocolo->id;
            $dsp->id_sintoma = $sintoma;
            $dsp->save();
        }
        $det_protocolo = new DetalleProtocolo;
        $det_protocolo->id_especialidad = $request->especialidad;
        $det_protocolo->id_protocolo = $protocolo->id;
        $det_protocolo->save();
        
        $request->session()->flash('alert-success', 'El protocolo fue agregado exitosamente!');
        return redirect()->back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sintomas_protocolo = Detalle_Sintoma_Protocolo::where('id_protocolo', $id)
            ->leftJoin('Sintomas', 'Sintomas.id', '=', 'id_sintoma')->get();
        $especialidad_protocolo = DB::table('det_protocolos as det_pro')
                                    ->join('Especialidades as esp','esp.id','=','det_pro.id_especialidad')
                                    ->select('esp.nombre')
                                    ->where('det_pro.id_protocolo','=',$id)
                                    ->get();
        $protocolo = Protocolo::find($id);

        return view('protocolos.show', compact('sintomas_protocolo', 'protocolo','especialidad_protocolo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        $protocolo=DB::table('protocolos as prot')
                        ->join('CodigosTriage as cod','cod.id','=','prot.id_codigo_triage')
                        ->join('det_protocolos as det','det.id_protocolo','=','prot.id')
                        ->join('Especialidades as esp','esp.id','=','det.id_especialidad')
                        ->select('prot.id','cod.color','esp.nombre','prot.descripcion')
                        ->where('prot.id','=',$id)
                        ->first();
        $sintomas_actuales=DB::table('detalles_sintomas_protocolos as det_sintomas')
                                ->join('sintomas as s','s.id','=','det_sintomas.id_sintoma')
                                ->select('s.descripcion','s.id')
                                ->where('det_sintomas.id_protocolo','=',$id)
                                ->get();
        $codigos = Codigo::all();
        $sintomas = Sintoma::all();
        $especialidades = Especialidad::all();
        return view('protocolos.edit', compact('codigos', 'sintomas','especialidades','protocolo','sintomas_actuales'));
        // return view('protocolos.edit',compact('codigos','sintomas','especialidades'));
        // $sintomas_protocolo = Detalle_Sintoma_Protocolo::where('id_protocolo', $id)
        //     ->leftJoin('Sintomas', 'Sintomas.id', '=', 'id_sintoma')->get();
        // $protocolo = Protocolo::find($id);
        // return view('protocolos.edit', compact('sintomas_protocolo', 'protocolo'));
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Detalle_Sintoma_Protocolo::where('id_protocolo', $id)->delete();
        Protocolo::destroy($id);
        // return redirect()->route('protocolos.index');
        return response()->json();
    }
}
