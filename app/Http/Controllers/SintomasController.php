<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sintoma;

class SintomasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       

        return view('sintomas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sintomas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['nombre_sintoma' => 'required']);
        $name = $request->get('nombre_sintoma');

        $nuevo=new Sintoma;
        $nuevo->descripcion=$request->get('nombre_sintoma');
        $nuevo->save();

    return response()->json();
        

        // $mensajes = [
        //     'required' =>'Este campo no debe estar vacio.',
        //     'max' => 'Este campo supera la capacidad máxima de caracteres.',
        // ];
        // $prot = $request->validate([
        //     'text_sintomas.*' => 'required|max:255|numeric',
        // ], $mensajes);

        // return redirect()->back()->withInput();
        // return response()->json(['success'=>'true', 'id'=>$nuevo->id,'nombre'=>$nuevo->descripcion]);
      
//     if ($validator->fails()) {
//     return back()->withInput()->withErrors($validator->errors());
// }

        // echo $request->text_sintomas[0];
        // for ($i=0; $i <$cantidad ; $i++) { 
        //     if($request->text_sintomas[$i]!=""){
        //      $nuevo=new Sintoma;
        //      $nuevo->descripcion=$request->text_sintomas[$i];
        //      $nuevo->save();
        //     }
        // }
        
        // return redirect('/sintomas');
       
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $sintoma=Sintoma::findOrFail($id);
        $sintoma->delete();
        return response()->json(["hola"=>'hola']);
        // return redirect('/sintomas');
    }
}
