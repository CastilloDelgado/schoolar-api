<?php

namespace App\Http\Controllers\API;

use App\ProdServ;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProdServ as ProdServResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ProdServController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $products = ProdServ::where(["status" => 1])->paginate(10);
        return ProdServResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {
            $prodServ = new ProdServ;
            $prodServ->status = 1;
            $prodServ->codigo = $request->codigo;
            $prodServ->nombre = $request->nombre;
            $prodServ->descripcion = $request->descripcion;
            $prodServ->monto = $request->monto;
            $prodServ->tipo_monto = $request->tipo_monto;
            $prodServ->clave_sat = $request->clave_sat;
            $prodServ->clave_producto = $request->clave_producto;
            $prodServ->save();
            return response()->json([
                        "data" => $prodServ,
                        "message" => "producto/servicio creado con exito"
                            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                        "user_message" => "Error al crear producto/servicio",
                        "admin_message" => $e->getMessage(),
                        "status" => 500
                            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\prod_serv  $prod_serv
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        try {
            $productos = ProdServ::where("status", "=", 1)->get()
                    ->where("id", "=", $id);
            return ProdServResource::collection($productos);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\prod_serv  $prod_serv
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        try {
            $prodServ = ProdServ::findOrFail($id);
            $prodServ->codigo = $request->codigo;
            $prodServ->nombre = $request->nombre;
            $prodServ->descripcion = $request->descripcion;
            $prodServ->monto = $request->monto;
            $prodServ->tipo_monto = $request->tipo_monto;
            $prodServ->clave_sat = $request->clave_sat;
            $prodServ->clave_producto = $request->clave_producto;
            $prodServ->save();
            return response()->json([
                        "data" => $prodServ,
                        "message" => "producto-servicio actualizado con exito"
                            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                        "user_message" => "Error al actualizar producto-servicio",
                        "admin_message" => $e->getMessage(),
                        "status" => 500
                            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\prod_serv  $prod_serv
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            $prodServ = ProdServ::findOrFail($id);
            $prodServ->status = 0;
            $prodServ->save();
            return response()->json([
                        "data" => $prodServ,
                        "message" => "producto/servicio eliminado con exito"
                            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                        "user_message" => "Error al eliminar producto/servicio",
                        "admin_message" => $e->getMessage(),
                        "status" => 500
                            ], 500);
        }
    }

}
