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
       $espe = Especialidad::all();
       //dd($espe);
       return view('especialidades.index', compact('espe'));
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
        $especia = new Especialidad;
        $especia->espe_descrip = $request->espe_descrip;
        $especia->save();
        return redirect()->route('especialidades.index')->with('info','Espe Fue Modificiada');

    
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
    public function update(Request $request, $id)
    {
      
        $especia = Especialidad::find($id);
        $especia->espe_descrip = $request->espe_descrip;
        $especia->save();
        return redirect()->route('especialidades.index')->with('info','Espe Fue Modificiada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $espe = Especialidad::find($id);
        $espe->delete();
        return back()->with('info', 'Fue eliminado exitosamente');
    }
}
