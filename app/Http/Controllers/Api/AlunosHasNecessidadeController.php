<?php

namespace App\Http\Controllers\Api;

use App\Models\AlunosHasNecessidade;
use Illuminate\Http\Request;
use App\Http\Requests\AlunosHasNecessidadeRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\AlunosHasNecessidadeResource;

class AlunosHasNecessidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $alunosHasNecessidades = AlunosHasNecessidade::paginate();

        return AlunosHasNecessidadeResource::collection($alunosHasNecessidades);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AlunosHasNecessidadeRequest $request): JsonResponse
    {
        $alunosHasNecessidade = AlunosHasNecessidade::create($request->validated());

        return response()->json(new AlunosHasNecessidadeResource($alunosHasNecessidade));
    }

    /**
     * Display the specified resource.
     */
    public function show(AlunosHasNecessidade $alunosHasNecessidade): JsonResponse
    {
        return response()->json(new AlunosHasNecessidadeResource($alunosHasNecessidade));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AlunosHasNecessidadeRequest $request, AlunosHasNecessidade $alunosHasNecessidade): JsonResponse
    {
        $alunosHasNecessidade->update($request->validated());

        return response()->json(new AlunosHasNecessidadeResource($alunosHasNecessidade));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(AlunosHasNecessidade $alunosHasNecessidade): Response
    {
        $alunosHasNecessidade->delete();

        return response()->noContent();
    }
}
