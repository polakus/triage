<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sala;
use App\Especialidad;
use App\Area;

class salasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $salas = Sala::all();
        $areas = Area::all();
        $val1 = $request->val1;
      
        return view('salas.index', compact('salas', 'areas', 'val1')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::all();
        return view('salas.create',compact('areas'));
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
        ], $mensajes);
        
        $sala = Sala::create([
            'nombre' => $request->nombre,
            'camas' => $request->camas,
            'id_area' => $request->area,
            'disponibilidad' => 1,
        ]);
        $request->session()->flash('alert-success', 'La sala fue agregada exitosamente!');
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

        $val1 = $request->n;
        $val2 = $request->a;

        
        return redirect()->action('salasController@index',['val1'=>$val1, 'val2'=>$val2]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sala::destroy($id);
        $val1 = $_POST['n'];
        $val2 =$_POST['a'];
        return redirect()->action('salasController@index',['val1'=>$val1, 'val2'=>$val2]);
    }
}
