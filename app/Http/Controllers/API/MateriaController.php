<?php

namespace App\Http\Controllers\API;

use App\Materia;
use App\Http\Controllers\Controller;
use App\Http\Resources\Materia as MateriaResource;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $materias = Materia::paginate(10);
            return MateriaResource::collection($materias);
        } catch (\Exception $e) {
            return response()->json([
                "user_message" => "Error al Mostrar las Materias",
                "admin_message" => $e->getMessage(),
                "status" => 500
            ], 500);
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
            $materia = new Materia;
            $materia->nombre = $request->nombre;
            $materia->ponderacion = $request->ponderacion;
            $materia->save();
            return response()->json([
                "data" => $materia,
                "message" => "Materia Creada con Exito"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "user_message" => "Error al Crear la Materia",
                "admin_message" => $e->getMessage(),
                "status" => 500
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function show(Materia $materia)
    {
        try {
            return new MateriaResource($materia);
        } catch (\Exception $e) {
            return response()->json([
                "user_message" => "Error al Crear la Materia",
                "admin_message" => $e->getMessage(),
                "status" => 500
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Materia $materia)
    {
        try {
            $materia->nombre = $request->nombre;
            $materia->ponderacion = $request->ponderacion;
            $materia->save();
            return response()->json([
                "data" => $materia,
                "message" => "Materia Actualizada Con Exito"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "user_message" => "Error al Actualizar la Materia",
                "admin_message" => $e->getMessage(),
                "status" => 500
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Materia  $materia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Materia $materia)
    {
        try {
            $materia->delete();
            return response()->json([
                "data" => $materia,
                "message" => "Materia Eliminada Con Exito"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "user_message" => "Error al Eliminar la Materia",
                "admin_message" => $e->getMessage(),
                "status" => 500
            ], 500);
        }
    }

    public function find(Request $request)
    {
        try {
            $conditions = [];
            foreach ($request->all() as $clave =>  $valor) {
                if ($valor) {
                    array_push($conditions, [$clave, '=', $valor]);
                }
            }
            $materias = DB::table('materias')->where($conditions)->paginate(10);
            return MateriaResource::collection($materias);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
