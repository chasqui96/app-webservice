<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Especialidad;
use DataTables;
class EspecialidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $especialidad = Especialidad::all();
       //dd($espe);
       return $especialidad;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('especialidades.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $especialidad = new Especialidad;
        $especialidad->espe_descrip = $request->input("espe_descrip");
        if ($especialidad->save()) {
            return $especialidad;
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
        $espe = Especialidad::find($id);

        return view('especialidades.edit', compact('espe'));
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
      
        $especialidad = Especialidad::find($request->input("id"));
        $especialidad->espe_descrip = $request->input("espe_descrip");
        if ($especialidad->save()) {
            return $especialidad;
        }

        return response()->json([
            'status'  => 500,
            'message' => 'No se pudo insertar',
        ], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $espe =  Especialidad::find($request->input("id"));
        $espe->delete();
        return $espe;
    }
}
