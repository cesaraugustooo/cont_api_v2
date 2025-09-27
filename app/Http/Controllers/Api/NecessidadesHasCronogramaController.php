<?php

namespace App\Http\Controllers\Api;

use App\Models\NecessidadesHasCronograma;
use Illuminate\Http\Request;
use App\Http\Requests\NecessidadesHasCronogramaRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\NecessidadesHasCronogramaResource;

class NecessidadesHasCronogramaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $necessidadesHasCronogramas = NecessidadesHasCronograma::paginate();

        return NecessidadesHasCronogramaResource::collection($necessidadesHasCronogramas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NecessidadesHasCronogramaRequest $request): JsonResponse
    {
        $necessidadesHasCronograma = NecessidadesHasCronograma::create($request->validated());

        return response()->json(new NecessidadesHasCronogramaResource($necessidadesHasCronograma));
    }

    /**
     * Display the specified resource.
     */
    public function show(NecessidadesHasCronograma $necessidadesHasCronograma): JsonResponse
    {
        return response()->json(new NecessidadesHasCronogramaResource($necessidadesHasCronograma));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NecessidadesHasCronogramaRequest $request, NecessidadesHasCronograma $necessidadesHasCronograma): JsonResponse
    {
        $necessidadesHasCronograma->update($request->validated());

        return response()->json(new NecessidadesHasCronogramaResource($necessidadesHasCronograma));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(NecessidadesHasCronograma $necessidadesHasCronograma): Response
    {
        $necessidadesHasCronograma->delete();

        return response()->noContent();
    }

    
}
