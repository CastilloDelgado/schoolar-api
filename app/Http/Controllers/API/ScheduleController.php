<?php

namespace App\Http\Controllers\API;

use App\Schedule;
use App\Http\Controllers\Controller;
use App\Http\Resources\Schedule as ScheduleResource;
use Illuminate\Http\Request;

class ScheduleController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $schedule = Schedule::paginate(10);
        return ScheduleResource::collection($schedule);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {
            $schedule = new Schedule;
            $schedule->materia_id = $request->materia_id;
            $schedule->group_id = $request->group_id;
            $schedule->user_id = $request->user_id;
            $schedule->status = 1;
            $schedule->day = $request->day;
            $schedule->hour = $request->hour;
            $schedule->slot = $request->slot;
            $schedule->save();

            return response()->json([
                        "data" => $schedule,
                        "message" => "Calendario creado con exito"
                            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                        "user_message" => "Error al crear calendario",
                        "admin_message" => $e->getMessage(),
                        "status" => 500
                            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        try {
            $schedule = Schedule::where("status", "<>", 0)->get()
                    ->where("id", "=", $id);
            return ScheduleResource::collection($schedule);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        try {
            $schedule = Schedule::findOrFail($id);
            $schedule->materia_id = $request->materia_id;
            $schedule->group_id = $request->group_id;
            $schedule->user_id = $request->user_id;
            $schedule->status = 1;
            $schedule->day = $request->day;
            $schedule->hour = $request->hour;
            $schedule->slot = $request->slot;
            $schedule->save();

            return response()->json([
                        "data" => $schedule,
                        "message" => "Calendario creado con exito"
                            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                        "user_message" => "Error al crear calendario",
                        "admin_message" => $e->getMessage(),
                        "status" => 500
                            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            $schedule = Schedule::findOrFail($id);
            $schedule->status = 0;
            $schedule->save();

            return response()->json([
                        "data" => $schedule,
                        "message" => "Calendario eliminado con exito"
                            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                        "user_message" => "Error al crear calendario",
                        "admin_message" => $e->getMessage(),
                        "status" => 500
                            ], 500);
        }
    }

}
