<?php

use Illuminate\Database\Seeder;
use App\Sintoma;

class SintomasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sintoma::create(['descripcion'=>'Agresión']);
        Sintoma::create(['descripcion'=>'Alergia, reacciones cutáneas']);
        Sintoma::create(['descripcion'=>'Alteración comportamiento-estado mental']);
        Sintoma::create(['descripcion'=>'Alteración analítica']);
        Sintoma::create(['descripcion'=>'alteración de la consciencia']);
        Sintoma::create(['descripcion'=>'Alteración del ritmo cardiaco-ECG']);
        Sintoma::create(['descripcion'=>'Alteración del ritmo intestianl-vómito']);
        Sintoma::create(['descripcion'=>'Bebe o niño que llora']);
        Sintoma::create(['descripcion'=>'Catástrofes']);
        Sintoma::create(['descripcion'=>'Cefalea-cervicalgia']);
        Sintoma::create(['descripcion'=>'Convulsiones, movimientos anormales']);
        Sintoma::create(['descripcion'=>'Cuerpo extraño']);
        Sintoma::create(['descripcion'=>'Demanda no urgentes']);
        Sintoma::create(['descripcion'=>'Disnea']);
        Sintoma::create(['descripcion'=>'Dolor abdominal (incluido suelo pélvico)']);
        Sintoma::create(['descripcion'=>'Dolor de espalda']);
        Sintoma::create(['descripcion'=>'Dolor de extremidades']);
        Sintoma::create(['descripcion'=>'Dolor escrotal']);
        Sintoma::create(['descripcion'=>'Dolor fosa renal']);
        Sintoma::create(['descripcion'=>'Dolor torácico']);
        Sintoma::create(['descripcion'=>'Embarazo']);
        Sintoma::create(['descripcion'=>'Familiares preocupados']);
        Sintoma::create(['descripcion'=>'Fiebre']);
        Sintoma::create(['descripcion'=>'Focalidad neurológica']);
        Sintoma::create(['descripcion'=>'Hemorragia']);
        Sintoma::create(['descripcion'=>'Heridas']);
        Sintoma::create(['descripcion'=>'Hipertensión arterial']);
        Sintoma::create(['descripcion'=>'Inflamación-hinchazón']);
        Sintoma::create(['descripcion'=>'Intoxicación']);
        Sintoma::create(['descripcion'=>'Lesiones lcoales, bultomas']);
        Sintoma::create(['descripcion'=>'Mal estado general, Sd.Constitucional']);
        Sintoma::create(['descripcion'=>'Mareo-inestabildiad']);
        Sintoma::create(['descripcion'=>'Niño irritable']);
        Sintoma::create(['descripcion'=>'Parada cardio-respiratoria']);
        Sintoma::create(['descripcion'=>'Poltraumatismo']);
        Sintoma::create(['descripcion'=>'Quemaduras físicas y químicas']);
        Sintoma::create(['descripcion'=>'Sincope-lipotimia']);
        Sintoma::create(['descripcion'=>'Sintomas buco dentales']);
        Sintoma::create(['descripcion'=>'Síntomas oído']);
        Sintoma::create(['descripcion'=>'Síntomas genitourinario']);
        Sintoma::create(['descripcion'=>'Síntomas oculares']);
        Sintoma::create(['descripcion'=>'Síntomas rinofaringeos']);
        Sintoma::create(['descripcion'=>'Traumatismos craneofacial']);
        Sintoma::create(['descripcion'=>'Traumatismos extremidades']);
        Sintoma::create(['descripcion'=>'Traumatismos múltiples']);
        Sintoma::create(['descripcion'=>'Traumatismos torazo-abdominales']);

    }
}
