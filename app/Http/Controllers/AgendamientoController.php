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
        $agendamientos = new Agendamiento;
        $agendamientos->doc_registro =   $request->input("doc_registro");
        $agendamientos->espe_estado = 'AGENDADO';
        $agendamientos->dias =   $request->input("dias");
        $agendamientos->hora_desde =   $request->input("hora_desde");
        $agendamientos->hora_hasta =   $request->input("hora_hasta");
        $agendamientos->per_id =   $request->input("per_id");
        $agendamientos->espe_id =   $request->input("espe_id");
        $agendamientos->save();

        $hora_inicio = $request->input("hora_desde");
        $hora_fin = $request->input("hora_hasta");
        $intervalo = 30;
        $hora_inicio = new DateTime( $hora_inicio );
        $hora_fin    = new DateTime( $hora_fin );
        $hora_fin->modify('+1 second'); 
        if ($hora_inicio > $hora_fin) {
            $hora_fin->modify('+1 day');
        } 
        $intervalo = new DateInterval('PT'.$intervalo.'M');
        $periodo   = new DatePeriod($hora_inicio, $intervalo, $hora_fin);        
        
        $i=1;
        $horas = [];
        foreach( $periodo as $hora ) {
            $horasG= new Cupo;
            $horasG->agendamiento_id = Agendamiento::all()->last()->id;
            $horasG->cantidad = 1;
            $horasG->horas =  $hora->format('H:i');
            $horasG->reservados = 0;
            $horasG->fecha_cupos = date("Y-m-d");;
            $horasG->save();
            $i++;
           
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
}
