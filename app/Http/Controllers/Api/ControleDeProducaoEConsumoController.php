<?php

namespace App\Http\Controllers\Api;

use App\Models\ControleDeProducaoEConsumo;
use Illuminate\Http\Request;
use App\Http\Requests\ControleDeProducaoEConsumoRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ControleDeProducaoEConsumoResource;

class ControleDeProducaoEConsumoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $controleDeProducaoEConsumos = ControleDeProducaoEConsumo::paginate();

        return ControleDeProducaoEConsumoResource::collection($controleDeProducaoEConsumos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ControleDeProducaoEConsumoRequest $request): JsonResponse
    {
        $controleDeProducaoEConsumo = ControleDeProducaoEConsumo::create($request->validated());

        return response()->json(new ControleDeProducaoEConsumoResource($controleDeProducaoEConsumo));
    }

    /**
     * Display the specified resource.
     */
    public function show(ControleDeProducaoEConsumo $controle_de_producao): JsonResponse
    {
        return response()->json(new ControleDeProducaoEConsumoResource($controle_de_producao));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ControleDeProducaoEConsumo $controle_de_producao): JsonResponse
    {
        $controle_de_producao->update($request->validate(ControleDeProducaoEConsumo::updateRule()));

        return response()->json(new ControleDeProducaoEConsumoResource($controle_de_producao));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(ControleDeProducaoEConsumo $controle_de_producao): Response
    {
        $controle_de_producao->delete();

        return response()->noContent();
    }
}
