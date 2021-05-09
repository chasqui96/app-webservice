<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Personal;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function vistaLogin()
    {
      
        return view('auth.login');
    }

    public function loguear(Request $request)
    {
      
        $validator = Validator::make($request->all(), [
            'email'    => 'required|max:150',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => 500,
                'message' => 'Debes de ingresar tu usuario y/o contraseña',
            ], 500);
        }

        $user = Personal::where('user', '=', $request->input('email'))->first();

        if ($user) {
            if (Hash::check($request->input('password'), $user->pass)) {
               //return view('/home');
            return $user;
            }
        }

        return response()->json([
            'status'  => 500,
            'message' => 'Usuario/Contraseña incorrectos',
        ], 500);
    }

    public function index()
    {
        $per = Personal::all();
        return $per;
    }

    public function listarDoctor()
    {
        $per = Personal::where("tipo_persona","=","DOCTOR")->get();
        return $per;
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
        $person->per_nombre =   $request->input("per_nombre");
        $person->per_apellido = $request->input("per_apellido");
        $person->per_cedula =   $request->input("per_cedula");
        $person->per_telefono = $request->input("per_telefono");
        $person->tipo_persona = $request->input("tipo_persona");
        $person->per_estado = 'ACTIVO';
        $person->user = $request->input("user");
        $person->pass = Hash::make($request->input('password'));
        $person->nivel = '1';
        if ($person->save()) {
            return $person;
        }

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
    public function update(Request $request)
    {
        $person = Personal::find($request->input("id"));
        $person->per_nombre =   $request->input("per_nombre");
        $person->per_apellido = $request->input("per_apellido");
        $person->per_cedula =   $request->input("per_cedula");
        $person->per_telefono = $request->input("per_telefono");
        $person->tipo_persona = $request->input("tipo_persona");
        $person->per_estado = 'ACTIVO';
        $person->user = $request->input("user");
        if ($request->has("password")) {
            $person->pass = Hash::make($request->input('password'));
        }
        $person->nivel = '1';
    
        if ($person->save()) {
            return $person;
        }

        return response()->json([
            'status'  => 500,
            'message' => 'Usuario/Contraseña incorrectos',
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
        $per = Personal::find($id);
        $per->delete();
        return back()->with('info', 'Fue eliminado exitosamente');
    }
    public function cambiarEstado(Request $request)
    {
        $per = Personal::find($request->input("id"));
        $per->per_estado = $request->input("per_estado");
        if ($per->save()) {
            return $per;
        }

        return response()->json([
            'status'  => 500,
            'message' => 'Usuario/Contraseña incorrectos',
        ], 500);
    }
}
