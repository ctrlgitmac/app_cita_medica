<?php
 
namespace App\Http\Controllers;
 
use App\Models\Usuario;
use Illuminate\Http\Request;
 
class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuario::latest()->paginate(10);
        return [
            "status" => 1,
            "data" => $usuarios
        ];
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
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required',
        ]);
 
        $usuario = Usuario::create($request->all());
        return [
            "status" => 1,
            "data" => $usuario
        ];
    }
 
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        return [
            "status" => 1,
            "data" =>$usuario
        ];
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        //
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:usuarios,email,'.$usuario->id,
            'password' => 'required',
        ]);
 
        $usuario->update($request->all());
 
        return [
            "status" => 1,
            "data" => $usuario,
            "msg" => "Usuario updated successfully"
        ];
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return [
            "status" => 1,
            "data" => $usuario,
            "msg" => "Usuario deleted successfully"
        ];
    }
}
