<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agendamiento;
use App\Models\Cupo;
use App\Models\ReservaTurno;
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
        $agendamientos  = Agendamiento::join('personals','personals.id','=','agendamientos.per_id')->join('especialidads', 'especialidads.id', '=', 'agendamientos.espe_id')->get(['agendamientos.*', 'personals.per_nombre','personals.per_apellido','especialidads.espe_descrip']);;
        //dd($agendamientos);
        $pacear = [];
        $horas = [];
        $conteo = 0;
        foreach ($agendamientos as  $value) {
             $id = $value->id;
             $pacear[$conteo]['id'] = $value->id;
             $pacear[$conteo]['hora_desde'] = $value->hora_desde;
             $pacear[$conteo]['hora_hasta'] = $value->hora_hasta;
             $pacear[$conteo]['doctor'] = $value->per_nombre." ".$value->apellido;
             $pacear[$conteo]['especialidad'] = $value->espe_descrip;
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
            $conteo++;
            
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
        $cupo =1;
        for( $i = 0; $i < $intervalo->format('%H') ; ){
            $x = $fechaDesde." + " . $i . " hour ";
            $y = $fechaDesde." + " . $i   . " hour + ".$minutos." minutes";
            $z = date('H:i', strtotime( $x ) ) . ' - ' . date('H:i', strtotime( $y ) );
            $horas = $z;  
            $horasG= new Cupo;
            $horasG->agendamiento_id = Agendamiento::all()->last()->id;
            $horasG->cantidad = $cupo;
            $horasG->horas =  $horas;
            $horasG->reservados = 0;
            $horasG->fecha_cupos = date("Y-m-d");;
            $horasG->save();
            $i+=1;
            $cupo++;
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

    public function cupos($id)
    {
        $cupos = Cupo::where("agendamiento_id","=",$id)->where('reservados', 0)->get();
        return $cupos;
    }

    public function guardarReserva(Request $request)
    {       

        $turnoFecha = str_replace('/', '-', $request->input("turno_fecha"));
		$turnoFecha = date('Y-m-d', strtotime($turnoFecha));
        $reserva = new ReservaTurno;
        $reserva->turno_fecha =  $turnoFecha;
        $reserva->turno_estado = 'RESERVADO';
        $reserva->dias =   $request->input("dias");
        $reserva->per_id =   $request->input("per_id");
        $reserva->espe_id =   $request->input("espe_id");
        $reserva->cupo_id =   $request->input("cupo_id");
        $reserva->paciente_id =   $request->input("paciente_id");
        if ($reserva->save()){
            $cupo =  Cupo::find($request->input("cupo_id"));
            $cupo->reservados = 1;
            $cupo->save();
            return $reserva;
        }

        return response()->json([
            'status'  => 500,
            'message' => 'Error de Rerserva',
        ], 500);
       
    }

}
