<?php

namespace App\Http\Controllers\API;

use App\AppConfiguration;
use App\Http\Controllers\Controller;
use App\Http\Resources\AppConfiguration as AppConfigurationResources;
use Illuminate\Http\Request;

class AppConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new AppConfigurationResources(AppConfiguration::first());
    }

    /**
     * Store a newly created resource in stora
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AppConfiguration  $appConfiguration
     * @return \Illuminate\Http\Response
     */
    public function show(AppConfiguration $appConfiguration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AppConfiguration  $appConfiguration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppConfiguration $appConfiguration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AppConfiguration  $appConfiguration
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppConfiguration $appConfiguration)
    {
        //
    }
}
