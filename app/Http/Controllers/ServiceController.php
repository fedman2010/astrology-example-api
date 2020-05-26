<?php

namespace App\Http\Controllers;

use App\Http\Resources\Service as ServiceResource;
use App\Service;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|Responsable
     */
    public function index()
    {
        return ServiceResource::collection(Service::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|Responsable
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:services,name|max:255'
        ]);

        return new ServiceResource(Service::create($validatedData));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response|Responsable
     */
    public function show(Service $service)
    {
        return new ServiceResource($service);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response|Responsable
     */
    public function update(Request $request, Service $service)
    {
        $validatedData = $request->validate([
            'name' => "required|unique:services,name,{$service->id}|max:255"
        ]);

        $service->update($validatedData);

        return new ServiceResource($service);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();

        return response(null, 204);
    }
}
