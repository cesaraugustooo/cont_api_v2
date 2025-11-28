<?php

namespace App\Http\Controllers\Api;

use App\Models\Autorizado;
use Illuminate\Http\Request;
use App\Http\Requests\AutorizadoRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\AutorizadoResource;

class AutorizadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $autorizados = Autorizado::paginate();

        return AutorizadoResource::collection($autorizados);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AutorizadoRequest $request): JsonResponse
    {
        $autorizado = Autorizado::create($request->validated());

        return response()->json(new AutorizadoResource($autorizado));
    }

    /**
     * Display the specified resource.
     */
    public function show(Autorizado $autorizado): JsonResponse
    {
        return response()->json(new AutorizadoResource($autorizado));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Autorizado $autorizado): JsonResponse
    {
        $autorizado->update($request->validate(Autorizado::updateRule()));

        return response()->json(new AutorizadoResource($autorizado));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(Autorizado $autorizado): Response
    {
        $autorizado->delete();

        return response()->noContent();
    }
}
