<?php

namespace App\Http\Controllers\API;

use App\Grupo;
use App\Http\Controllers\Controller;
use App\Http\Resources\Grupo as GrupoResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $grupos = Grupo::paginate(10);
            return GrupoResource::collection($grupos);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $grupo = new Grupo;
            $grupo->grado = $request->grado;
            $grupo->grupo = $request->grupo;
            $grupo->save();
            return response()->json([
                "data" => $grupo,
                "message" => "Grupo Creado Con Exito"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "user_message" => "Error al Crear el Grupo",
                "admin_message" => $e->getMessage(),
                "status" => 500
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function show(Grupo $grupo)
    {
        try {
            return new GrupoResource($grupo);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grupo $grupo)
    {
        try {
            $grupo->grado = $request->grado;
            $grupo->grupo = $request->grupo;
            $grupo->save();
            return response()->json([
                "data" => $grupo,
                "message" => "Grupo Actualizado Con Exito"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "user_message" => "Error al Actualizar el Grupo",
                "admin_message" => $e->getMessage(),
                "status" => 500
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grupo $grupo)
    {
        try {
            $grupo->delete();
            return response()->json([
                "data" => $grupo,
                "message" => "Grupo Eliminado Con Exito"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "user_message" => "Error al Eliminar Grupo",
                "admin_message" => $e->getMessage(),
                "status" => 500
            ], 500);
        }
    }

    // Find Method
    public function find(Request $request)
    {
        try {
            $conditions = [];
            foreach ($request->all() as $clave =>  $valor) {
                if ($valor) {
                    array_push($conditions, [$clave, '=', $valor]);
                }
            }
            $grupos = DB::table('grupos')->where($conditions)->paginate(10);
            return GrupoResource::collection($grupos);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
