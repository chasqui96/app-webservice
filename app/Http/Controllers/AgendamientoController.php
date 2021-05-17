<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agendamiento;
use App\Models\Cupo;
use DateTime;
use Date;
use DatePeriod;
use DateInterval;
class AgendamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $agendamientos  = Agendamiento::join('cupos','cupos.agendamiento_id','=','agendamientos.id') ->get(['agendamientos.*']);;
        //dd($agendamientos);
        $pacear = [];
        $horas = [];
        $conteo = 0;
        foreach ($agendamientos as  $value) {
             $id = $value->id;
             $pacear[$conteo]['id'] = $value->id;
             $pacear[$conteo]['hora_desde'] = $value->hora_desde;
             $pacear[$conteo]['hora_hasta'] = $value->hora_hasta;
             $pacear[$conteo]['dias'] = $value->dias;
             $pacear[$conteo]['doc_registro'] = $value->doc_registro;
             $pacear[$conteo]['espe_id'] = $value->espe_id;
             $pacear[$conteo]['per_id'] = $value->per_id;
             $cupos = Cupo::where("agendamiento_id","=",$id)->get();
             $i=0;
             foreach ($cupos as  $value2) {
                $horas[$i]['cupo'] = $value2->horas;
                $i++;
             }
             $pacear[$conteo]['horas'] = $horas;
            
            
         }
        return $pacear;
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
        //guardamos el agendamiento 
        $agendamientos = new Agendamiento;
        $agendamientos->doc_registro =   $request->input("doc_registro");
        $agendamientos->espe_estado = 'AGENDADO';
        $agendamientos->dias =   $request->input("dias");
        $agendamientos->hora_desde =   $request->input("hora_desde");
        $agendamientos->hora_hasta =   $request->input("hora_hasta");
        $agendamientos->per_id =   $request->input("per_id");
        $agendamientos->espe_id =   $request->input("espe_id");
        $agendamientos->save();

        $fechaDesde = $request->input("hora_desde");
        $fechaHasta = $request->input("hora_hasta");

        $fecha1 = new DateTime($fechaDesde);//fecha inicial
        $fecha2 = new DateTime($fechaHasta);//fecha de cierre
        $intervalo = $fecha1->diff($fecha2);//Buscamos cuantas horas de diferencia se llevan para hacer el for
        $horas = array();
        $minutos = 30;
        for( $i = 0; $i < $intervalo->format('%H') ; ){
            $x = $fechaDesde." + " . $i . " hour ";
            $y = $fechaDesde." + " . $i   . " hour + ".$minutos." minutes";
            $z = date('H:i', strtotime( $x ) ) . ' - ' . date('H:i', strtotime( $y ) );
            $horas = $z;  
            $horasG= new Cupo;
            $horasG->agendamiento_id = Agendamiento::all()->last()->id;
            $horasG->cantidad = 1;
            $horasG->horas =  $horas;
            $horasG->reservados = 0;
            $horasG->fecha_cupos = date("Y-m-d");;
            $horasG->save();
            $i+=1;
            
        }
      
        return $agendamientos;

        return response()->json([
        'status'  => 500,
        'message' => 'Usuario/Contraseña incorrectos',
        ], 500);

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
        //
    }

    public function listarCupos($id)
    {
        $per = Cupo::where("agendamiento_id","=",$i)->get();
        return $per;
    }
}
