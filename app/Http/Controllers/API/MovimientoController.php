<?php

namespace App\Http\Controllers\API;

use App\Movimiento;
use App\Http\Resources\Movimiento as MovimientoResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MovimientoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $movimiento = Movimiento::where("status", "=", 1)->paginate(10);
        return MovimientoResource::collection($movimiento);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {
            $movimiento = new Movimiento;
            $movimiento->id_pedido = $request->id_pedido;
            $movimiento->status = $request->status;
            $movimiento->monto = $request->monto;
            $movimiento->save();
            return response()->json([
                        "data" => $movimiento,
                        "message" => "deposito creado con exito"
                            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                        "user_message" => "Error al crear deposito",
                        "admin_message" => $e->getMessage(),
                        "status" => 500
                            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\movimiento  $movimiento
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        try {
            $movimiento = Movimiento::where("status", "=", 1)->get()
                    ->where("id", "=", $id);
            return MovimientoResource::collection($movimiento);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\movimiento  $movimiento
     * @return \Illuminate\Http\Response
     */
    public function showByIdPedido($idPedido) {
        try {
            $movimiento = Movimiento::where("status", "=", 1)->get()
                    ->where("id_pedido", "=", $idPedido);
            return MovimientoResource::collection($movimiento);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\movimiento  $movimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        try {
            $movimiento = Movimiento::findOrFail($id);
            $movimiento->user_id = $request->id_user;
            $movimiento->user_info_invoice_id = $request->user_info_invoice_id;
            $movimiento->status = $request->status;
            $movimiento->check_in = $request->timbrado;
            $movimiento->save();
            return response()->json([
                        "data" => $movimiento,
                        "message" => "deposito modificado con exito"
                            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                        "user_message" => "Error al modificar deposito",
                        "admin_message" => $e->getMessage(),
                        "status" => 500
                            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\movimiento  $movimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            $movimiento = Movimiento::findOrFail($id);
            $movimiento->status = 0;
            $movimiento->save();
            return response()->json([
                        "data" => $movimiento,
                        "message" => "deposito cancelado con exito"
                            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                        "user_message" => "Error al cancelar deposito",
                        "admin_message" => $e->getMessage(),
                        "status" => 500
                            ], 500);
        }
    }

}
