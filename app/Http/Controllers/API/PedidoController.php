<?php

namespace App\Http\Controllers\API;

use App\Pedido;
use App\ProdServ;
use App\ProdServPedido;
use App\Http\Controllers\Controller;
use App\Http\Resources\Pedido as PedidoResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $pedidos = Pedido::paginate(10);
        return PedidoResource::collection($pedidos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {
            $pedido = new Pedido;
            $pedido->id_usuario = $request->id_usuario;
            $pedido->id_factura = $request->id_factura;
            $pedido->id_forma_pago = $request->id_forma_pago;
            $pedido->status = 1;
            $pedido->total = $request->total;
            $pedido->descuento = $request->descuento;
            $pedido->save();
            $productos = $request->productos;
            foreach ($productos as $key => $producto) {
                $prodServPedido = new ProdServPedido;
                $prodServPedido->id_pedido = $pedido->id;
                $prodServPedido->id_prod_serv = $producto['id'];
                $prodServPedido->cantidad = $producto['cantidad'];
                $prodServPedido->importe = $producto['total'];
                $prodServPedido->save();
            }

            return response()->json([
                        "data" => $pedido,
                        "data_items" => $prodServPedido,
                        "message" => "Pedido Creado Con Exito"
                            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                        "user_message" => "Error al Crear Pedido",
                        "admin_message" => $e->getMessage(),
                        "status" => 500
                            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        try {
            $pedidos = Pedido::where("status", "=", 1)->get()
                    ->where("id", "=", $id);
            return PedidoResource::collection($pedidos);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            $pedido = Pedido::findOrFail($id);
            $pedido->status = 0;
            $pedido->save();
            return response()->json([
                        "data" => $pedido,
                        "message" => "pedido cancelado con exito"
                            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                        "user_message" => "Error al cancelar pedido",
                        "admin_message" => $e->getMessage(),
                        "status" => 500
                            ], 500);
        }
    }

}
