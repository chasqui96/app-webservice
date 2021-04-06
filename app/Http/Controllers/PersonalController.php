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
