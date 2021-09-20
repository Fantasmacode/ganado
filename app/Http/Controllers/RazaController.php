<?php

namespace App\Http\Controllers;

use App\Http\Requests\RazaRequest;
use App\Models\Raza;
use DataTables;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RazaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Razas/Index');
    }

    public function getRazas(Request $request)
    {
        if ($request->ajax()) {
            $model = Raza::query();
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
    public function store(RazaRequest $request)
    {
        Raza::create($request->all());
        return response()->json([
            'type' => 'success',
            'message' => 'Raza registrada correctamente',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\raza  $raza
     * @return \Illuminate\Http\Response
     */
    public function edit(Raza $raza)
    {
        return $raza;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\raza  $raza
     * @return \Illuminate\Http\Response
     */
    public function update(RazaRequest $request, Raza $raza)
    {
        $raza->update($request->all());
        return response()->json([
            'type' => 'success',
            'message' => 'Raza modificada correctamente',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\raza  $raza
     * @return \Illuminate\Http\Response
     */
    public function destroy(Raza $raza)
    {
        $raza->delete();
        return response()->json([
            'type' => 'success',
            'message' => 'Raza eliminada correctamente',
        ]);
    }
}
