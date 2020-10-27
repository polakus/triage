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
        // $this->validate($request, ['codigo' => 'unique']);
        // $nuevo=new CIE;
        // $nuevo->codigo=$request->codigo;
        // $nuevo->descripcion=$request->nombre;
        // $nuevo->save();
        // return redirect()->action('CieController@index');
        // $validacion = Validator::make($request->all(),[
        //     'nombre' => 'required|max:255',
        //     'codigo' => 'required|unique:cie',
        //     ] ,[
        //     'required' => 'Este campo no puede estar vacio.',
        //     'max' => 'Este es demasiado largo.',
        //     ]);
        // if ($validacion->fails()){
        //     return response()->json(['errors' => $validacion->errors()]);
        // }
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
