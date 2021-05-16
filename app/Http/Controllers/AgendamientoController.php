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
      
        //$agendamientos = new Agendamiento;
        //$agendamientos->doc_registro =   $request->input("doc_registro");
        //$agendamientos->espe_estado = 'AGENDADO';
        //$agendamientos->dias =   $request->input("dias");
        //$agendamientos->hora_desde =   $request->input("hora_desde");
        //$agendamientos->hora_hasta =   $request->input("hora_hasta");
        //$agendamientos->per_id =   $request->input("per_id");
        //$agendamientos->espe_id =   $request->input("espe_id");
        //$agendamientos->save();

        //$hora_inicio = '12:00';
       // $hora_fin ='13:00';
        //$intervalo = 30;
       // $hora_inicio = new DateTime( $hora_inicio );
        //$hora_fin    = new DateTime( $hora_fin );
        //$hora_fin->modify('+1 second'); 
        //if ($hora_inicio > $hora_fin) {
           // $hora_fin->modify('+1 day');
       // } 
        //$intervalo = new DateInterval('PT'.$intervalo.'M');
        //$periodo   = new DatePeriod($hora_inicio, $intervalo, $hora_fin);        
        
        //$i=1;
       // $horas = [];
         $timestamp = strtotime('1st January 2004'); //1072915200

        // esto imprime el año en un formato de dos dígitos
        // sin embargo, ya que éste podría empezar con un "0",
        // sólo se imprime "4"
        echo idate('y', $timestamp);
        $horas = array();
        $minutos = 30;
        for( $i = 0; $i < ; ){
          
            $x = "12:00 +" . $i . " hour ";
        
            $y = "12:00 +" . $i   . " hour + ".$minutos." minutes";
        
            $z = date('H:i', strtotime( $x ) ) . ' - ' . date('H:i', strtotime( $y ) );
            array_push($horas,$z);
            //$horas = $z;  
            //$horasG= new Cupo;
            //$horasG->agendamiento_id = Agendamiento::all()->last()->id;
            //$horasG->cantidad = 1;
            //$horasG->horas =  $horas;
            //$horasG->reservados = 0;
            //$horasG->fecha_cupos = date("Y-m-d");;
            //$horasG->save();
           $i+=1;
            
        }

        dd($horas);
      
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
