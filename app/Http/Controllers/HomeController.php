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
use App\Sala;

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
        $anio = date('y');
        // echo $anio;
        # <<---- Consultamos por las cantidades de los códigos por el mes actual (corregir el mes actual)---->> #
        $dataMes = [];
        $codigosMes = DetalleAtencion::select('id_codigo_triage', DB::raw('count(*) as cantidad') )->whereMonth('created_at', Carbon::now()->month - 1)->groupBy('id_codigo_triage')->get();
        $totalMes = DetalleAtencion::count();
        foreach($codigosMes as $codigoMes){     # Armamos array (dataPoints) para el gráfico de tortas
            $dataMes[] = '{y: '.strval(($codigoMes->cantidad *100)/$totalMes).',label: "'.$codigoMes->CodigoTriage->color.'",color: "'.$this->traductorColor($codigoMes->CodigoTriage->color).'"}';
        }
        $dataMes = '[' . implode(', ', $dataMes) . ']';
        
        # <<---- Consultamos por las cantidades de los códigos por el año actual ---->> #
        $dataAnio = [];
        $codigosAnios = DetalleAtencion::select('id_codigo_triage', DB::raw('count(*) as cantidad') )->whereYear('created_at', Carbon::now()->year)->groupBy('id_codigo_triage')->get();
        $totalAnio = DetalleAtencion::count();
        foreach($codigosAnios as $codigoAnio){     # Armamos array (dataPoints) para el gráfico de tortas
            $dataAnio[] = '{y: '.strval(($codigoAnio->cantidad *100)/$totalAnio).',label: "'.$codigoAnio->CodigoTriage->color.'",color: "'.$this->traductorColor($codigoAnio->CodigoTriage->color).'"}';
        }
        $dataAnio = '[' . implode(', ', $dataAnio) . ']';
        
        # <<---- Consultamos Salas ---->> #
        $salas = Sala::select("id_area", DB::raw("count(*) as cantidad"), DB::raw("sum(disponibilidad) as disponibles"))->groupBy('id_area')->get();
        
        return view('inicio', compact('cantUOnline', 'mes', 'anio', 'cantUPendientes', 'cantPacientes', 'cantProfesionales', 'dataMes', 'dataAnio', 'salas'));
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
