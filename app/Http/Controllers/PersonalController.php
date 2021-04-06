<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Personal;
use DataTables;
class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $per = Personal::all();
        return view('personales.index', compact('per'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('personales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $person = new Personal;
        $person->per_nombre = $request->per_nombre;
        $person->per_apellido = $request->per_apellido;
        $person->per_cedula = $request->per_cedula;
        $person->per_telefono = $request->per_telefono;
        $person->tipo_persona = $request->tipo_persona;
        $person->per_estado = 'ACTIVO';
        $person->user = $request->user;
        $person->pass = $request->pass;
        $person->nivel = $request->nivel;
        $person->save();
        return redirect()->route('personales.index')->with('info','personal Fue Agregado');
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
        $per = Personal::find($id);
        return view('personales.edit', compact('per'));
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
        $person = Personal::find($id);
        $person->per_nombre = $request->per_nombre;
        $person->per_apellido = $request->per_apellido;
        $person->per_cedula = $request->per_cedula;
        $person->per_telefono = $request->per_telefono;
        $person->tipo_persona = $request->tipo_persona;
        $person->per_estado = 'ACTIVO';
        $person->user = $request->user;
        $person->pass = $request->pass;
        $person->nivel = $request->nivel;
        $person->save();
        return redirect()->route('personales.index')->with('info','Personal Fue Modificiada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $per = Personal::find($id);
        $per->delete();
        return back()->with('info', 'Fue eliminado exitosamente');
    }
    public function cambiarEstado($id)
    {
        $per = Personal::find($id);
        $per->per_estado = 'INACTIVO';
        $per->save();
        return redirect()->route('personales.index')->with('info','Personal Fue Cambiado');
    }
}
