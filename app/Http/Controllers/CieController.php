<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CIE;
use Illuminate\Support\Facades\Validator;

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
        $c = $request->validate([
            'nombre' => 'required|max:255',
            'codigo' => 'required|unique:cie',
        ],[
            'required' => 'Este campo no puede estar vacio.',
            'max' => 'Este es demasiado largo.',
            'unique' => 'Este codigo ya se encuentra almacenado.'
        ]);
        $nuevo=new CIE;
        $nuevo->codigo=$request->codigo;
        $nuevo->descripcion=$request->nombre;
        $nuevo->save();
        return response()->json();
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
        $c = $request->validate([
            'nombre' => 'required|max:255',
            'codigo' => 'required',
        ],[
            'required' => 'Este campo no puede estar vacio.',
            'max' => 'Este es demasiado largo.',
        ]);
        $update = CIE::findOrFail($id);
        if ( $update->codigo!=$request->codigo){
            $request->validate(['codigo'=>'unique:cie'],['unique' => 'Este codigo ya se encuentra almacenado.']);
            $update->codigo= $request->codigo;
        }
        $update->descripcion = $request->nombre;
        $update->save();
        // return redirect()->action("CieController@index");
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
        //
    }
}
