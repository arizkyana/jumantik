<?php

namespace App\Http\Controllers;

use App\ApiClient;
use Illuminate\Http\Request;

class ApiClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apiClients = ApiClient::all();

        return view('api/mobile/index')->with([
            'js' => 'apiClient.js',
            'apiClients' => $apiClients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
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
     * @param  \App\ApiClient  $apiClient
     * @return \Illuminate\Http\Response
     */
    public function show(ApiClient $apiClient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ApiClient  $apiClient
     * @return \Illuminate\Http\Response
     */
    public function edit(ApiClient $apiClient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ApiClient  $apiClient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ApiClient $apiClient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ApiClient  $apiClient
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApiClient $apiClient)
    {
        //
    }
}
