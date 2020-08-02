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
        if ($request->val1){
            $val1 = $request->val1;
            $val2 = $request->val2;            
        }else{
            $val1 = 'Todos';
            $val2 = 'Todas';
        }
        return view('salas.index', compact('salas', 'areas', 'val1', 'val2')); 
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
        $sala = new Sala;
        $sala->id_area = $request->area;
        $sala->nombre = $request->nombre;
        $sala->disponibilidad = 1;
        $sala->camas = $request->camas;
        $sala->save();
        $request->session()->flash('alert-success', 'La sala fue agregada exitosamente!');
        return redirect()->route('salas.create');
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
