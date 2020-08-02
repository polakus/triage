<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pregunta;
use App\Protocolo;
use App\Detalle_Sintoma_Protocolo;
use App\Atencion;
use App\Sintoma;
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
        $atencion->usuario_id='1';
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
        
        $rtas = Pregunta::where('id_atencion', $id)->get();
        $protocolos = Protocolo::all();
       
        $band=True;
        $aux=-1;
        while ($i < sizeof($protocolos) and $band) {
            $dsp = Detalle_Sintoma_Protocolo::where('id_protocolo', $protocolos[$i]->id)->get();
            if (count($dsp)==count($rtas)) {
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
            $actualizar_atencion->id_protocolo=$id_prot=$protocolos[$aux]->id;
            $actualizar_atencion->save();


             $id_prot=$protocolos[$aux]->id;
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
            echo "nose encontro";
        }
       
        
       

       
        
        
    }


    public function prueba($id){

        echo $id;
    }

    
}
