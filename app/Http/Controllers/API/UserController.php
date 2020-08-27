<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Storage;
use App\EmergencyInformation;
use App\Http\Controllers\Controller;
use App\Http\Resources\Information as InformationResource;
use App\Http\Resources\Pedido;
use App\Http\Resources\User as ResourcesUser;
use App\User;
use Illuminate\Http\Request;
use App\Information;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Information::paginate(10);
        return InformationResource::collection($users);
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
            $usuario = User::create([
                "name" => $request->nombre . " " . $request->apellido_paterno,
                "email" => $request->email,
                "password" => Hash::make($request->password),
                "information_id" => 0
            ]);

            $info = Information::create([
                "nombre" => $request->nombre,
                "segundo_nombre" => $request->segundo_nombre,
                "apellido_paterno" => $request->apellido_paterno,
                "apellido_materno" => $request->apellido_materno,
                "fecha_de_nacimiento" => $request->fecha_de_nacimiento,
                "email" => $request->email,
                "pais_de_origen" => $request->pais_de_origen,
                "ciudad_de_origen" => $request->ciudad_de_origen,
                "user_id" => 0,
                "grupo_id" => 0,
                "emergency_information_id" => 0,
                "tipo_id" => $request->tipo,
                "imagen_url" => $request->imagen_url
            ]);

            $emergenciaInfo = EmergencyInformation::create([
                "nombre" => $request->emergencia_nombre,
                "segundo_nombre" => $request->emergencia_segundo_nombre,
                "apellido_paterno" => $request->emergencia_apellido_paterno,
                "apellido_materno" => $request->emergencia_apellido_materno,
                "fecha_de_nacimiento" => $request->emergencia_fecha_de_nacimiento,
                "email" => $request->emergencia_email,
                "pais_de_origen" => $request->emergencia_pais_de_origen,
                "ciudad_de_origen" => $request->emergencia_ciudad_de_origen,
                "calle" => $request->emergencia_calle,
                "numero" => $request->emergencia_numero,
                "telefono" => $request->emergencia_telefono,
                "information_id" => 0
            ]);

            $emergenciaInfo->information_id = $info->id;
            $usuario->information_id = $info->id;
            $info->user_id = $usuario->id;
            $info->emergency_information_id = $emergenciaInfo->id;

            $usuario->save();
            $info->save();
            $emergenciaInfo->save();
            return response()->json([
                "data" => [
                    "usuario" => $usuario,
                    "informacion" => $info,
                    "emergencia" => $emergenciaInfo
                ],
                "message" => "Usuario Creado Con Exito"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "user_message" => "Error al Crear Usuario",
                "admin_message" => $e->getMessage(),
                "status" => 500
            ], 500);
        }
    }

    /**
     * assign a group .
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function assignGroup(Request $request)
    {
        try {
            $userinfo = Information::where("user_id", "=", $request->id)->first();
            $userinfo->grupo_id = $request->grupo_id;
            $userinfo->save();
            return response()->json([
                "data" => $userinfo,
                "message" => "usuario asignado con exito"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "user_message" => "Error al asignar usuario",
                "admin_message" => $e->getMessage(),
                "status" => 500
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $info = Information::find($user->information_id);
            $emergenciaInfo = EmergencyInformation::find($info->emergency_information_id);
            $emergenciaInfo->delete();
            $info->delete();
            $user->delete();
            return response()->json([
                "usuario" => $user,
                "informacion" => $info,
                "emergencia" => $emergenciaInfo
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "user_message" => "Error al Eliminar Usuario",
                "admin_message" => $e->getMessage(),
                "status" => 500
            ], 500);
        }
    }

    public function getAlumnos(Request $request)
    {
        try {
            $users = Information::where(['tipo_id' => 1])->orderBy('grupo_id')->paginate(10);
            return InformationResource::collection($users);
        } catch (\Exception $e) {
            return response()->json([
                "user_message" => "Error al Listar Usuarios",
                "admin_message" => $e->getMessage(),
                "status" => 500
            ], 500);
        }
    }

    public function getMaestros(Request $request)
    {
        try {
            $users = Information::where(['tipo_id' => 2])->paginate(10);
            return InformationResource::collection($users);
        } catch (\Exception $e) {
            return response()->json([
                "user_message" => "Error al Listar Usuarios",
                "admin_message" => $e->getMessage(),
                "status" => 500
            ], 500);
        }
    }

    public function getAdmins(Request $request)
    {
        try {
            $users = Information::where(['tipo_id' => 3])->paginate(10);
            return InformationResource::collection($users);
        } catch (\Exception $e) {
            return response()->json([
                "user_message" => "Error al Listar Usuarios",
                "admin_message" => $e->getMessage(),
                "status" => 500
            ], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $usuario = User::where(['email' => $request->email])->first();
            if (Hash::check($request->password, $usuario->password)) {
                $info = $usuario->information;
                return response()->json([
                    "data" => [
                        "id" => $usuario->id,
                        "nombre" => $info->nombre,
                        "segundo_nombre" => $info->segundo_nombre,
                        "apellido_paterno" => $info->apellido_paterno,
                        "apellido_materno" => $info->apellido_materno,
                        "codigo_alumno" => $usuario->id,
                        "email" => $info->email,
                        "grado" => $info->grupo->grado_id,
                        "grupo" => $info->grupo->grupo,
                        "curp" => "AAA010101AAA",
                        "contacto_nombre" => $info->emergency_information->nombre,
                        "contacto_segundo_nombre" => $info->emergency_information->segundo_nombre,
                        "contacto_apellido_paterno" => $info->emergency_information->apellido_paterno,
                        "contacto_apellido_materno" => $info->emergency_information->apellido_materno,
                        "contacto_telefono" => $info->emergency_information->telefono,
                        "saldo" => 1000.54,
                        "tipo" => $info->tipo_id,
                        "imagen_url" => $info->imagen_url
                    ]
                ], 200);
            } else {
                return response()->json([
                    "user_message" => "Informarmación Incorrecta",
                    "admin_message" => "Informarmación Incorrecta",
                    "status" => 500
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                "user_message" => "Información Incorrecta, Intentalo Nuevamente",
                "admin_message" => $e->getMessage(),
                "status" => 500
            ], 500);
        }
    }

    public function getInfo(Request $request)
    {
        try {
            $usuario = User::find($request->id);
            $informacion = $usuario->information;
            $emergenciaInfo = $informacion->emergency_information;
            return response()->json([
                "lista" =>
                [
                    [
                        "title" => "Información del Alumno",
                        "data" => [
                            "segundo_nombre" => $informacion->segundo_nombre,
                            "apellido_paterno" => $informacion->apellido_paterno,
                            "apellido_materno" => $informacion->apellido_materno,
                            "codigo_de_alumno" => $informacion->codigo,
                            "grado" => $informacion->grupo->grado_id,
                            "grupo" => $informacion->grupo->grupo,
                            "curp" => $informacion->curp,
                            "sexo" => $informacion->sexo,
                            "correo" => $informacion->email,
                            "fecha_de_nacimiento" => $informacion->fecha_de_nacimiento,
                            "ciudad_de_origen" => $informacion->ciudad_de_origen,
                            "pais_de_origen" => $informacion->pais_de_origen
                        ],
                    ],
                    [
                        "title" => "Dirección del Alumno",
                        "data" => [
                            "calle" => $informacion->calle,
                            "numero" => $informacion->numero,
                            "interior" => $informacion->interior,
                            "codigo_postal" => $informacion->codigo_postal,
                            "colonia" => $informacion->colonia,
                            "municipio" => $informacion->municipio,
                            "estado" => $informacion->estado
                        ]
                    ],
                    [
                        "title" => "Contacto de Emergencia",
                        "data" => [
                            "primer_nombre" => $emergenciaInfo->nombre,
                            "segundo_nombre" => $emergenciaInfo->segundo_nombre,
                            "apellido_paterno" => $emergenciaInfo->apellido_paterno,
                            "apellido_materno" => $emergenciaInfo->apellido_materno,
                            "parentesco" => $emergenciaInfo->parentesco
                        ]
                    ],
                    [
                        "title" => "Saldo del Alumno",
                        "data" => [
                            "saldo" => $informacion->saldo,
                        ]
                    ]
                ],
                "imagen_url" => $informacion->imagen_url
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "user_message" => "Error al Obtener Información",
                "admin_message" => $e->getMessage(),
                "status" => 500
            ], 500);
        }
    }

    public function getPedidos($id)
    {
        try {
            $user = User::find($id);
            $pedidos = $user->pedidos;
            return Pedido::collection($pedidos);
        } catch (\Exception $e) {
            return response()->json([
                "user_message" => "Error al Obtener Pedidos",
                "admin_message" => $e->getMessage(),
                "status" => 500
            ], 500);
        }
    }
}
