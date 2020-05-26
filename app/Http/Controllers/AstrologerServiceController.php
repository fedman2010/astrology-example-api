<?php

namespace App\Http\Controllers;

use App\Astrologer;
use App\AstrologerService;
use App\Http\Resources\ServicePrice as ServiceResource;
use App\Service;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

class AstrologerServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|Responsable
     */
    public function index(Astrologer $astrologer)
    {
        return ServiceResource::collection($astrologer->services);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|Responsable
     */
    public function store(Request $request, Astrologer $astrologer)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:services,name|max:255',
            'price' => 'required'
        ]);

        $service = Service::create($validatedData);
        $astrologer->services()->attach($service->id, ['price' => $validatedData['price']]);

        return new ServiceResource(
            $astrologer->services()->wherePivot('service_id', $service->id)->first()
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AstrologerService  $astrologerService
     * @return \Illuminate\Http\Response|Responsable
     */
    public function show(Astrologer $astrologer, Service $service)
    {
        return new ServiceResource(
            $astrologer->services()->wherePivot('service_id', $service->id)->first()
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Astrologer $astrologer
     * @param Service $service
     * @return Responsable
     */
    public function update(Request $request, Astrologer $astrologer, Service $service)
    {
        $validatedData = $request->validate([
            'price' => 'required'
        ]);

        $astrologer->services()->updateExistingPivot($service->id, ['price' => $validatedData['price']]);

        return new ServiceResource(
            $astrologer->services()->wherePivot('service_id', $service->id)->first()
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AstrologerService  $astrologerService
     * @return \Illuminate\Http\Response
     */
    public function destroy(Astrologer $astrologer, Service $service)
    {
        $astrologer->services()->detach($service->id);

        return response(null, 204);
    }
}
