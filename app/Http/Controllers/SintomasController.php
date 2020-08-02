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
        $sintomas=Sintoma::all();

        return view('sintomas.index',compact('sintomas'));
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
        $cantidad= count($request->text_sintomas);
        
        for ($i=0; $i <$cantidad ; $i++) { 
            if($request->text_sintomas[$i]!=""){
             $nuevo=new Sintoma;
             $nuevo->descripcion=$request->text_sintomas[$i];
             $nuevo->save();
            }
        }
        
        return redirect('/sintomas');
       
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
        return redirect('/sintomas');
    }
}
