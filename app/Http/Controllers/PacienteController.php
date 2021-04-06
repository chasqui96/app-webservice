<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use DataTables;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacie = Paciente::all();
        return view('pacientes.index', compact('pacie'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pacientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pacient = new Paciente;
        $pacient->paciente_nombre = $request->paciente_nombre;
        $pacient->paciente_apellido = $request->paciente_apellido;
        $pacient->paciente_fecha_nac = $request->paciente_fecha_nac;
        $pacient->paciente_cedula = $request->paciente_cedula;
        $pacient->paciente_telefono = $request->paciente_telefono;
        $pacient->paciente_estado = 'ACTIVO';
        $pacient->save();
        return redirect()->route('pacientes.index')->with('info','peciente Fue Agregado');
  
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
        $pacie = Paciente::find($id);

        return view('pacientes.edit', compact('pacie'));
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
        $pacient = Paciente::find($id);
        $pacient->paciente_nombre = $request->paciente_nombre;
        $pacient->paciente_apellido = $request->paciente_apellido;
        $pacient->paciente_fecha_nac = $request->paciente_fecha_nac;
        $pacient->paciente_cedula = $request->paciente_cedula;
        $pacient->paciente_telefono = $request->paciente_telefono;
        $pacient->paciente_estado = 'ACTIVO';
        $pacient->save();
        return redirect()->route('pacientes.index')->with('info','Paciente Fue Modificiada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pacie = Paciente::find($id);
        $pacie->delete();
        return back()->with('info', 'Fue eliminado exitosamente');
    }

    public function cambiarEstado($id)
    {
        $pacie = Paciente::find($id);
        $pacie->paciente_estado = 'INACTIVO';
        $pacie->save();
        return redirect()->route('pacientes.index')->with('info','Paciente Fue Cambiado');
    }
}
