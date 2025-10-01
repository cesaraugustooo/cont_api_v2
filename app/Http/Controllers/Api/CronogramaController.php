<?php

namespace App\Http\Controllers\Api;

use App\Models\Cronograma;
use Illuminate\Http\Request;
use App\Http\Requests\CronogramaRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\CronogramaResource;

class CronogramaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cronogramas = Cronograma::with(['necessidadesHasCronogramas.aluno_has_necessidade.aluno.necessidades','necessidadesHasCronogramas.aluno_has_necessidade.necessidade'])->get();

        return CronogramaResource::collection($cronogramas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CronogramaRequest $request): JsonResponse
    {
        $cronograma = Cronograma::create($request->validated());

        return response()->json(new CronogramaResource($cronograma));
    }

    /**
     * Display the specified resource.
     */
    public function show(Cronograma $cronograma): JsonResponse
    {
        return response()->json(new CronogramaResource($cronograma));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CronogramaRequest $request, Cronograma $cronograma): JsonResponse
    {
        $cronograma->update($request->validated());

        return response()->json(new CronogramaResource($cronograma));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(Cronograma $cronograma): Response
    {
        $cronograma->delete();

        return response()->noContent();
    }
}
