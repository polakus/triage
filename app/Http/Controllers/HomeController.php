<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use DB;
use App\User;
use App\Paciente;
use App\Profesional;
use App\DetalleAtencion;
use App\Codigo;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function nombremes($mes){
        setlocale(LC_TIME, 'spanish');  
        $nombre=strftime("%B",mktime(0, 0, 0, $mes, 1, 2000)); 
        return $nombre;
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $usuarios = user::all();
        $cantUOnline = 0;
        $cantUPendientes = 0;
        foreach ($usuarios as $usuario){ #Para obtener la cantidad de usuarios online y la cantidad de usuarios pendientes
            if ($usuario->isOnline())
                $cantUOnline ++;
            if ($usuario->estado == 0)
                $cantUPendientes ++;
        }
        $cantPacientes = Paciente::whereMonth('created_at', Carbon::now()->month)->count();
        $cantProfesionales = Profesional::all()->count();
        
        # <<---- Para obtener el nombre del mes en español ---->> #
        $meses = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");
        $mes = $meses[date('m')-1];

        # <<---- Para pasar los datos al gráfico de torta ---->> #
        $data = [];
        $codigos = DetalleAtencion::groupBy('id_codigo_triage')->select('id_codigo_triage', DB::raw('count(*) as cantidad') )->whereMonth('created_at', Carbon::now()->month - 1)->get();
        $total = 0;
        foreach ($codigos as $codigo){  #Le agregamos el color del código
            $codigo->color=Codigo::find($codigo->id_codigo_triage)->color;
            $total = $total + $codigo->cantidad;
        }
        foreach($codigos as $codigo){
            $data[] = '{y: '.strval(($codigo->cantidad *100)/$total).',label: "'.$codigo->color.'",color: "'.$this->traductorColor($codigo->color).'"}';
        }
        $data = '[' . implode(', ', $data) . ']';
        
        return view('inicio', compact('cantUOnline', 'mes', 'cantUPendientes', 'cantPacientes', 'cantProfesionales', 'data'));
    }

    # <<---- Para traducir colores del español al inglés ---->> #
    public function traductorColor($color){
        $color = strtolower($color);
        if ($color == 'rojo')
            return "red";
        elseif ($color == 'verde')
            return "green";
        elseif ($color == 'amarillo')
            return "yellow";
        elseif ($color == 'azul')
            return "blue";
        elseif ($color == 'negro')
            return "black";
        elseif ($color == 'blanco')
            return "white";
        elseif ($color == 'marron')
            return "brown";
        else
            return "";
    }

}
