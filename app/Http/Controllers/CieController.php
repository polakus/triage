<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CIE;

class CieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cie= CIE::all()->sortBy('codigo');

        return view('cie.index',compact('cie'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $cantidad= count($request->ciecodigo);
        
        for ($i=0; $i <$cantidad ; $i++) { 
            if($request->ciecodigo[$i]!=""){
                if($request->ciedescripcion[$i] != "")
                         $nuevo=new CIE;
                         $nuevo->codigo=$request->ciecodigo[$i];
                         $nuevo->descripcion=$request->ciedescripcion[$i];
                         $nuevo->save();
            }
        }

        return redirect()->action('CieController@index');
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

        $update = CIE::findOrFail($id);
        if($request->editarcod !=""){
            $update->codigo= $request->editarcod;
        }
        if($request->editardesc != ""){
            $update->descripcion = $request->editardesc;
        }
        $update->save();
        return redirect()->action("CieController@index");
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
