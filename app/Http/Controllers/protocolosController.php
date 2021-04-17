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
    public function __construct()
    {
        $this->middleware('permission:VerProtocolos|FullProtocolos');
        $this->middleware('permission:RegistrarProtocolo|FullProtocolos')->only('create');
        $this->middleware('permission:EditarProtocolo|FullProtocolos')->only('edit');

    }
    public function index()
    {
        return view('protocolos.index');
    }

    public function create()
    {
        $codigos = Codigo::all();
        $sintomas = Sintoma::all();
        $especialidades = Especialidad::all();
        return view('protocolos.create', compact('codigos', 'sintomas','especialidades'));
    }

    public function store(Request $request)
    {
        $mensajes = [
            'sint.required' =>'Debe agregar al menos un síntoma a la tabla.',
            'required' =>'Este campo no debe estar vacio.',
            'max' => 'Este campo supera la capacidad máxima de caracteres.',
        ];
        $prot = $request->validate([
            'desc' => 'required|max:255',
            'codigo' => 'required',
            'especialidad' => 'required',
            'sint' => 'required'
        ], $mensajes);
        $protocolo = new Protocolo;
        $protocolo->id_codigo_triage= $request->codigo;
        $protocolo->descripcion= $request->desc;
        $protocolo->save();

        $sintomas = $request->sint;
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
        
        // $request->session()->flash('alert-success', 'El protocolo fue agregado exitosamente!'); //NO LO PUEDO USAR CON AJAX
        // return redirect()->back()->withInput();
        return response()->json();
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $protocolo=DB::table('protocolos as prot')
                        ->join('codigostriage as cod','cod.id','=','prot.id_codigo_triage')
                        ->join('det_protocolos as det','det.id_protocolo','=','prot.id')
                        ->join('especialidades as esp','esp.id','=','det.id_especialidad')
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
    }

    public function update(Request $request, $id)
    {
        $mensajes = [
            'sint.required' => 'Debe agregar al menos un síntoma a la tabla.',
            'required' =>'Este campo no debe estar vacio.',
            'max' => 'Este campo supera la capacidad máxima de caracteres.',
        ];
        $prot = $request->validate([
            'desc' => 'required|max:255',
            'sint' => 'required'
        ], $mensajes);
        $protocolo = Protocolo::find($id);
        $protocolo->id_codigo_triage= $request->codigo;
        $protocolo->descripcion= $request->desc;
        $protocolo->save();

        $sintomas = $request->sint;
        
        $dsp = Detalle_Sintoma_Protocolo::where('id_protocolo', $id)->get();
        $i = 0;
        if (count($sintomas) == $dsp->count()){
            foreach($sintomas as $sintoma){
                $dsp[$i]->id_protocolo = $protocolo->id;
                $dsp[$i]->id_sintoma = $sintoma;
                $dsp[$i]->save();
                $i++;
            }
        }else{
            if (count($sintomas) < $dsp->count()){
                $sint_cant = count($sintomas);
                foreach($dsp as $d){
                    if ($i < $sint_cant){
                        $d->id_protocolo = $protocolo->id;
                        $d->id_sintoma = $sintomas[$i];
                        $d->save();
                        $i++;
                    }else{
                        $d->delete();
                    }
                }
            }else{
                $det_cant = $dsp->count();
                foreach($sintomas as $sintoma){
                    if ($i < $det_cant){
                        $dsp[$i]->id_protocolo = $protocolo->id;
                        $dsp[$i]->id_sintoma = $sintoma;
                        $dsp[$i]->save();
                        $i++;
                    }else{
                        $dt = new Detalle_Sintoma_Protocolo;
                        $dt->id_protocolo = $protocolo->id;
                        $dt->id_sintoma = $sintoma;
                        $dt->save();
                    }
                }
            }
        }
        $det_protocolo = DetalleProtocolo::where('id_protocolo', $id)->get();
        foreach($det_protocolo as $dp){
            $dp->id_especialidad = $request->especialidad;
            $dp->id_protocolo = $protocolo->id;
            $dp->save();
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
        Detalle_Sintoma_Protocolo::where('id_protocolo', $id)->delete();
        Protocolo::destroy($id);
        return response()->json();
    }
}
