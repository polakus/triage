<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class datosPacientesController extends Controller
{
    public function index(){
        return view('datosPacientes');
    }
    public function guardar(Request $request){
        // echo $request->pacientes;
        $l = $request->pacientes;
        // $l = $_POST['pacientes'];
        // $lista=Array($l);
        // $pacientes=  implode(', ', $lista);
        // for ($i=0; $i < ; $i++) { 
        //     # code...
        // }
        print_r($l);
        // echo $l[0]['ApellidoyNombre'];
        
        // return response()->json(['success'=>'true']);
    }
}