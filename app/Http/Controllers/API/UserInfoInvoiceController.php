<?php

namespace App\Http\Controllers\API;

use App\UserInfoInvoice;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserInfoInvoice as UserInfoInvoiceResource;
use Illuminate\Http\Request;

class UserInfoInvoiceController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user_info_invoices = UserInfoInvoice::paginate(10);
        return UserInfoInvoiceResource::collection($user_info_invoices);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {
            $user_info_invoices = new UserInfoInvoice;
            $user_info_invoices->user_id = $request->user_id;
            $user_info_invoices->status = $request->status;
            $user_info_invoices->name = $request->name;
            $user_info_invoices->rfc = $request->rfc;
            $user_info_invoices->email = $request->email;
            $user_info_invoices->save();
            return response()->json([
                        "data" => $user_info_invoices,
                        "message" => "Informacion de facturacion creada con exito"
                            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                        "user_message" => "Error al crear informacion de facturacion",
                        "admin_message" => $e->getMessage(),
                        "status" => 500
                            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\information_invoices  $information_invoices
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        try {
            $user_info_invoices = UserInfoInvoice::where("status", "<>", 0)->get()
                    ->where("id", "=", $id);
            return UserInfoInvoiceResource::collection($user_info_invoices);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        try {
            $user_info_invoices = UserInfoInvoice::findOrFail($id);
            $user_info_invoices->user_id = $request->user_id;
            $user_info_invoices->status = $request->status;
            $user_info_invoices->name = $request->name;
            $user_info_invoices->rfc = $request->rfc;
            $user_info_invoices->email = $request->email;
            $user_info_invoices->save();
            return response()->json([
                        "data" => $user_info_invoices,
                        "message" => "informacion de facturacion editada con exito"
                            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                        "user_message" => "Error al editar informacion de facturacion",
                        "admin_message" => $e->getMessage(),
                        "status" => 500
                            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\information_invoices  $information_invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            $user_info_invoices = UserInfoInvoice::findOrFail($id);
            $user_info_invoices->status = 0;
            $user_info_invoices->save();
            return response()->json([
                        "data" => $user_info_invoices,
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
