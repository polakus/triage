<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pregunta;
use App\Protocolo;
use App\Detalle_Sintoma_Protocolo;
use App\Atencion;
use App\Sintoma;
use Auth;
use DB;

class TriagepreguntasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //return view('triagepreguntas.index');
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
        $sintomas_descriptos = json_decode($request->sintomas_descriptos);
        $cantidad=count($sintomas_descriptos);
        $band = False;
        $array_ids=array();
        for ($i=0; $i <$cantidad ; $i++) { 
            $id_sintoma=DB::table('sintomas')
                            ->select('id')
                            ->where('descripcion','LIKE',$sintomas_descriptos[$i])
                            ->get();
            if(count($id_sintoma)==0){
                $band=True;
                break;
            }
            else{
                array_push($array_ids,$id_sintoma[0]->id);
            }
        }
        if(!$band){
            $cantidad=count($array_ids);
            $atencion = new Atencion;
            $atencion->Paciente_id=$request->id;
            $atencion->usuario_id= Auth::id();
            $atencion->dias=$request->dias;
            $atencion->horas=$request->horas;
            $atencion->save();
            for($i=0;$i<$cantidad;$i++){
                 $pregunta=new Pregunta;
                 $pregunta->id_atencion=$atencion->id;
                 $pregunta->id_sintoma = $array_ids[$i];
                 $pregunta->save();
            }
           

           return response()->json(['resultado'=>True,'atencion'=>$atencion->id,'sintomas'=>$array_ids]);
           // return redirect()->action('TurnosController@respuesta',['atencion'=>$atencion->id,'sintomas'=>$array_ids]);
        }
        else{
            return response()->json(['resultado'=>False]);
        }

        // $atencion = new Atencion;
        // $atencion->Paciente_id=$request->id;
        // $atencion->usuario_id= Auth::id();
        // $atencion->save();



        // $cantidad= count($request->respuestas);
        // for ($i=0; $i <$cantidad ; $i++) { 
        //     if($request->respuestas[$i]!=""){

        //      $pregunta=new Pregunta;
        //      $pregunta->id_atencion=$atencion->id;
        //      $pregunta->id_sintoma = Sintoma::where('descripcion', $request->respuestas[$i])->first()->id;
           
             
        //      $pregunta->save();
        //     }
        // }

        // $id=$atencion->id;
       
        // $rtas = Pregunta::where('id_atencion', $id)->select('id_sintoma')->get();
        // $lista_respuestas= array();
        // $i=0;
        // for($i=0;$i<sizeof($rtas);$i++){
           
        //     array_push($lista_respuestas,$rtas[$i]->id_sintoma);
        // }
       
        // return redirect()->action('TurnosController@respuesta',['atencion'=>$id, 'sintomas'=>$lista_respuestas]);
        // return redirect('triagepreguntas/estado/'.$id);
      
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sintomas=Sintoma::all();
        return view('triagepreguntas.show',compact('id','sintomas'));
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
