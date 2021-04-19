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
        return $pacie;
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
        $pacient->paciente_nombre = $request->input("paciente_nombre");
        $pacient->paciente_apellido = $request->input("paciente_apellido");
        $pacient->paciente_fecha_nac = $request->input("paciente_fecha_nacimiento");
        $pacient->paciente_cedula = $request->input("paciente_cedula");
        $pacient->paciente_telefono = $request->input("paciente_telefono");
        $pacient->paciente_estado = 'ACTIVO';
        if ($person->save()) {
            return $pacient;
        }

        return response()->json([
            'status'  => 500,
            'message' => 'No se pudo insertar',
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
    public function update(Request $request)
    {
        $pacient = Paciente::find($request->input("id"));
        $pacient->paciente_nombre = $request->input("paciente_nombre");
        $pacient->paciente_apellido = $request->input("paciente_apellido");
        $pacient->paciente_fecha_nac = $request->input("paciente_fecha_nacimiento");
        $pacient->paciente_cedula = $request->input("paciente_cedula");
        $pacient->paciente_telefono = $request->input("paciente_telefono");
        $pacient->paciente_estado = 'ACTIVO';
        if ($person->save()) {
            return $pacient;
        }

        return response()->json([
            'status'  => 500,
            'message' => 'No se pudo Editar',
        ], 500);
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

    public function cambiarEstado(Request $request)
    {
        $paciente = Paciente::find($request->input("id"));
        $paciente->per_estado = $request->input("paciente_estado");
        if ($paciente->save()) {
            return $paciente;
        }

        return response()->json([
            'status'  => 500,
            'message' => 'No se pudo cambiar de estado',
        ], 500);
    }
}
