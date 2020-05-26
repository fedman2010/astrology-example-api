<?php

namespace App\Http\Controllers;

use App\Astrologer;
use App\Http\Resources\Astrologer as AstrologerResource;
use App\Http\Resources\AstrologerCollection;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AstrologerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|Responsable
     */
    public function index()
    {
        return AstrologerResource::collection(Astrologer::with('services')->paginate());
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
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:astrologers|max:255',
            'bio' => 'required',
        ]);

        $astrologer = Astrologer::create($validatedData);

        return new AstrologerResource($astrologer);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Astrologer  $astrologer
     * @return \Illuminate\Http\Response|Responsable
     */
    public function show(Astrologer $astrologer)
    {
        return new AstrologerResource($astrologer->load('services'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Astrologer  $astrologer
     * @return \Illuminate\Http\Response|Responsable
     */
    public function update(Request $request, Astrologer $astrologer)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => "required|email|unique:astrologers,email,{$astrologer->id}|max:255",
            'bio' => 'required',
        ]);

        $astrologer->update($validatedData);

        return new AstrologerResource($astrologer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Astrologer  $astrologer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Astrologer $astrologer)
    {
        $astrologer->delete();

        return response(null, '204');
    }
}
