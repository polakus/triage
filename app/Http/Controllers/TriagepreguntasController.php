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
        $atencion = new Atencion;
        $atencion->Paciente_id=$request->id;
        $atencion->usuario_id= Auth::id();
        $atencion->save();

        

        $cantidad= count($request->respuestas);
        for ($i=0; $i <$cantidad ; $i++) { 
            if($request->respuestas[$i]!=""){

             $pregunta=new Pregunta;
             $pregunta->id_atencion=$atencion->id;
             $pregunta->id_sintoma = Sintoma::where('descripcion', $request->respuestas[$i])->first()->id;
           
             
             $pregunta->save();
            }
        }

        $id=$atencion->id;
       
        
       
       
        return redirect('triagepreguntas/estado/'.$id);
      
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

    public function estado($id){
        
        
        $i=0;
        
        $rtas = Pregunta::where('id_atencion', $id)->select('id_sintoma')->get();
        $protocolos = Protocolo::all();
        
        $band=True;
        $aux=-1;
        $lista_respuestas= array();
        $acierto = array();
        for($i=0;$i<sizeof($rtas);$i++){
           
            array_push($lista_respuestas,$rtas[$i]->id_sintoma);
        }

       
        $probando = DB::table('Protocolos as p')
                    ->join('Detalles_Sintomas_Protocolos as det','det.id_protocolo','=','p.id')
                    ->join('Sintomas as s','s.id','=','det.id_sintoma')
                    ->select("p.id")
                    ->whereIn('s.id',$lista_respuestas)
                    ->groupBy('p.id')
                    ->get();

        
        $i=0;
                    
        while ($i < sizeof($probando) and $band) {
            $dsp = Detalle_Sintoma_Protocolo::where('id_protocolo', $probando[$i]->id)->get();
            $encontro = False;
            if (count($dsp)==count($lista_respuestas)) {
                $j=0;
                $encontro = True;
                while ($j<count($dsp) and $encontro) {
                    $k=0;
                    
                    while($k<count($dsp) and ($dsp[$j]->id_sintoma<>$rtas[$k]->id_sintoma)){
                        $k=$k+1;
                    }
                   
                    if($k>=count($dsp)){
                        $encontro = False;
                       
                    }
                    $j=$j+1;
                }
                if($encontro==True){
                    
                    $band=False;
                    $aux=$i;
                }
            }
            $i=$i+1;
        }
        if($encontro){
        
            $actualizar_atencion=Atencion::findOrFail($id);
            $actualizar_atencion->id_protocolo=$id_prot=$probando[$aux]->id;
            $actualizar_atencion->save();


             $id_prot=$probando[$aux]->id;
             $consulta=DB::table('Protocolos as p')
                ->join('CodigosTriage as cod','cod.id','=','p.id_codigo_triage')
                ->select('cod.color')
                ->where('p.id','=',$id_prot)
                ->get();
            $color=$consulta[0]->color;
            return redirect()->action('TurnosController@respuesta',['atencion'=>$id, 'protocolo'=>$id_prot,'color'=>$color]);
        }
        else{
            // FALTA PONER ALGO EN CASO DE QUE NO ENCUENTRE UN PROTOCOLO
            $bandera="Lo sentimos muchos, nuestra base de datos no contiene los datos suficientes para poder encontrar un protocolo para dichos Sintomas descriptos...";
            return redirect()->action('TurnosController@respuesta',['bandera'=>$bandera,'atencion'=>$id, 'sintomas'=>$lista_respuestas]);
        }
       
        
       

       
        
        
    }


   
    
}
