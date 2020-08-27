<?php

namespace App\Http\Controllers\API;

use App\Invoice;
use App\Http\Resources\Invoice as InvoiceResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoiceController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $invoice = Invoice::where("status", "<>", 0)->paginate(10);
        return InvoiceResource::collection($invoice);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {
            $invoice = new Invoice;
            $invoice->user_id = $request->user_id;
            $invoice->user_info_invoice_id = $request->user_info_invoice_id;
            $invoice->status = $request->status;
            $invoice->type = $request->type;
            $invoice->serie = $request->serie;
            $invoice->inv_number = $request->inv_number;
            $invoice->uuid = $request->uuid;
            $invoice->total = $request->total;
            $invoice->currency = $request->currency;
            $invoice->method_pay = $request->method_pay;
            $invoice->date_invoice = $request->date_invoice;
            $invoice->check_in = $request->check_in;
            $invoice->save();
            return response()->json([
                        "data" => $invoice,
                        "message" => "Factura creado con exito"
                            ], 200);
        } catch (\Exception $e) {
            $errorCode = $e->getCode();
            if ($errorCode == 23000) {
                return response()->json([
                            "user_message" => "Factura ya creada",
                            "admin_message" => $e->getMessage(),
                            "status" => 500
                                ], 500);
            } else {
                return response()->json([
                            "user_message" => "Error al crear factura",
                            "admin_message" => $e->getMessage(),
                            "status" => 500
                                ], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        try {
            $invoice = Invoice::where("status", "<>", 0)->get()
                    ->where("id", "=", $id);
            return InvoiceResource::collection($invoice);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        try {
            $invoice = Invoice::findOrFail($id);
            $invoice->user_id = $request->user_id;
            $invoice->user_info_invoice_id = $request->user_info_invoice_id;
            $invoice->status = $request->status;
            $invoice->check_in = $request->check_in;
            $invoice->save();
            return response()->json([
                        "data" => $invoice,
                        "message" => "Factura modificada con exito"
                            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                        "user_message" => "Error al modificar factura",
                        "admin_message" => $e->getMessage(),
                        "status" => 500
                            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            $invoice = Invoice::findOrFail($id);
            $invoice->status = 0;
            $invoice->save();
            return response()->json([
                        "data" => $invoice,
                        "message" => "Factura cancelada con exito"
                            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                        "user_message" => "Error al cancelar factura",
                        "admin_message" => $e->getMessage(),
                        "status" => 500
                            ], 500);
        }
    }

}
