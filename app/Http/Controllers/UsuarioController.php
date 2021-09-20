<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use App\Models\User;
use DataTables;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Usuarios/Index');
    }

    public function getUsuarios(Request $request)
    {
        if ($request->ajax()) {
            $model = User::query();
            return DataTables::eloquent($model)
            ->toJson();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioRequest $request)
    {
        $data = $request->all();
        $data['clave_usuario'] = bcrypt($request->clave_usuario);
        User::create($data);
        return response()->json([
            'type' => 'success',
            'message' => 'Usuario registrado correctamente',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $usuario)
    {
        return $usuario;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UsuarioRequest $request, User $usuario)
    {
        $data = $request->all();
        if ($request->clave_usuario) {
            $data['clave_usuario'] = bcrypt($request->clave_usuario);
        } else {
            $data['clave_usuario'] = $usuario->clave_usuario;
        }

        $usuario->update($data);
        return response()->json([
            'type' => 'success',
            'message' => 'Usuario modificado correctamente',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $usuario)
    {
        $usuario->delete();
        return response()->json([
            'type' => 'success',
            'message' => 'Usuario eliminado correctamente',
        ]);
    }
}
