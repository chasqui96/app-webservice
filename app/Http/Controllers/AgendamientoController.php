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
             
             $cupos = Cupo::where("agendamiento_id","=",$id)->where('reservados',"=",0)->get();
             
             $pacear[$conteo]['horas'] = "";
             if(count($cupos) > 0 ){
                foreach ($cupos as  $value2) {
                    $pacear[$conteo]['horas'] .="Cupo ".$value2->cantidad.": ".$value2->horas."\n";
                 }
             }else {
                $pacear[$conteo]['horas'] = 'AGOTADO';
                
             }
            
          
            $conteo++;
       
         }
         //dd($pacear);
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
    public function listarReservas()
    {
        //
        $agendamientos  = ReservaTurno::join('cupos','cupos.id','=','reserva_turnos.cupo_id')->join('personals','personals.id','=','reserva_turnos.per_id')->join('especialidads', 'especialidads.id', '=', 'reserva_turnos.espe_id')->join('pacientes','pacientes.id','=','reserva_turnos.paciente_id')->get(['reserva_turnos.*', 'personals.per_nombre','personals.per_apellido','especialidads.espe_descrip','cupos.horas','pacientes.paciente_nombre','pacientes.paciente_apellido']);;
        //dd($agendamientos);
        $pacear = [];
        $conteo = 0;
        foreach ($agendamientos as  $value) {
             $id = $value->id;
             $pacear[$conteo]['id'] = $value->id;
             $pacear[$conteo]['doctor'] = $value->per_nombre." ".$value->per_apellido;
             $pacear[$conteo]['paciente'] = $value->paciente_nombre." ".$value->paciente_apellido;
             $pacear[$conteo]['especialidad'] = $value->espe_descrip;
             $pacear[$conteo]['dias'] = $value->dias;
             $pacear[$conteo]['cupo_id'] = $value->cupo_id;
             $pacear[$conteo]['turno_estado'] = $value->turno_estado;
             $pacear[$conteo]['turno_fecha'] =  date('d/m/Y', strtotime($value->turno_fecha));
             $pacear[$conteo]['horas'] = $value->horas;
             $conteo++;
            //dd($pacear);
         }
        return $pacear;
    }
    public function anularReservas(Request $request)
    {
        $reserva = ReservaTurno::find($request->input("id"));
        $reserva->turno_estado = 'ANULADO';
        $cupo =  Cupo::find($request->input("cupo_id"));
        $cupo->reservados = 0;
        $cupo->save();
        if ($reserva->save()) {
            
            return $reserva;
        }

        return response()->json([
            'status'  => 500,
            'message' => 'No se pudo cambiar de estado',
        ], 500);
    }

}
