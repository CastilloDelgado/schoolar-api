<?php

namespace App\Http\Controllers\API;

use App\Aviso;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Aviso as AvisoResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AvisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $avisos = Aviso::paginate(10);
        return AvisoResource::collection($avisos);
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
            $aviso = new Aviso;
            $aviso->titulo = $request->input('titulo');
            $aviso->texto = $request->input('texto');
            $aviso->creado_por = $request->input('usuario_id');
            $aviso->actualizado_por = $request->input('usuario_id');

            Storage::disk('sftp')->put('avisos/' . $request->nombre_imagen, base64_decode($request->imagen_base64));
            $aviso->url_imagen = 'http://kronosoftmx.com/kronomx.com/nexus/avisos/' . $request->input('nombre_imagen');

            $aviso->save();
            return response()->json([
                "data" => $aviso,
                "message" => "Aviso Creado Con Exito"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "user_message" => "Error al Crear Aviso",
                "admin_message" => $e->getMessage(),
                "status" => 500
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *  
     * @param  \App\Aviso  $aviso
     * @return \Illuminate\Http\Response
     */
    public function show(Aviso $aviso)
    {
        //return $aviso;
        try {
            return new AvisoResource($aviso);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Aviso  $aviso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aviso $aviso)
    {
        try {
            $aviso->titulo = $request->titulo;
            $aviso->texto = $request->texto;
            $aviso->url_imagen = $request->url_imagen;
            $aviso->actualizado_por = $request->usuario_id;
            $aviso->save();
            return response()->json([
                "data" => $aviso,
                "message" => "Aviso Creado Con Exito"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "user_message" => "Error al Crear Aviso",
                "admin_message" => $e->getMessage(),
                "status" => 500
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Aviso  $aviso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aviso $aviso)
    {
        try {
            $aviso->delete();
            return response()->json([
                "data" => $aviso,
                "message" => "Aviso Eliminado Con Exito"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "user_message" => "Error al Eliminar Aviso",
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
            foreach ($request->all() as $clave => $valor) {
                if ($valor) {
                    array_push($conditions, [$clave, '=', $valor]);
                }
            }

            $avisos = DB::table('avisos')->where($conditions)->paginate(10);

            return AvisoResource::collection($avisos);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
