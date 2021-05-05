<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use DataTables;
use Carbon\Carbon;
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
        $paciente = [];
        $i = 0;
        foreach ($pacie as $value) {
            $paciente[$i]['id']= $value->id;
            $paciente[$i]['paciente_nombre']= $value->paciente_nombre;
            $paciente[$i]['paciente_apellido'] = $value->paciente_apellido;
            $paciente[$i]['paciente_cedula']= $value->paciente_cedula;
            $paciente[$i]['paciente_fecha_nac'] = date('d/m/Y', strtotime($value->paciente_fecha_nac));
            $paciente[$i]['paciente_telefono'] = $value->paciente_telefono;
            $paciente[$i]['paciente_estado']=  $value->paciente_estado;
            $i++;
                  
        }
        return $paciente;
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
        $fechaNacimiento = str_replace('/', '-', $request->input("paciente_fecha_nac"));
		$fechaNacimiento = date('Y-m-d', strtotime($fechaNacimiento));
        $pacient = new Paciente;
        $pacient->paciente_nombre = $request->input("paciente_nombre");
        $pacient->paciente_apellido = $request->input("paciente_apellido");
        $pacient->paciente_fecha_nac = $fechaNacimiento;
        $pacient->paciente_cedula = $request->input("paciente_cedula");
        $pacient->paciente_telefono = $request->input("paciente_telefono");
        $pacient->paciente_estado = 'ACTIVO';
        if ($pacient->save()) {
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
        $fechaNacimiento = str_replace('/', '-', $request->input("paciente_fecha_nac"));
		$fechaNacimiento = date('Y-m-d', strtotime($fechaNacimiento ));
        $pacient->paciente_fecha_nac =$fechaNacimiento; 
        $pacient->paciente_cedula = $request->input("paciente_cedula");
        $pacient->paciente_telefono = $request->input("paciente_telefono");
        $pacient->paciente_estado = 'ACTIVO';
        if ($pacient->save()) {
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
        $paciente->paciente_estado = $request->input("paciente_estado");
        if ($paciente->save()) {
            return $paciente;
        }

        return response()->json([
            'status'  => 500,
            'message' => 'No se pudo cambiar de estado',
        ], 500);
    }
}
