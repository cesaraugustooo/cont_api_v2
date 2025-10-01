<?php

namespace App\Http\Controllers\Api;

use App\Models\ContagemNe;
use Illuminate\Http\Request;
use App\Http\Requests\ContagemNeRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContagemNeResource;

class ContagemNeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $contagemNes = ContagemNe::with(['alunosHasNecessidade.aluno','alunosHasNecessidade.necessidade'])->paginate();

        return ContagemNeResource::collection($contagemNes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContagemNeRequest $request): JsonResponse
    {
        $contagemNe = ContagemNe::create($request->validated());

        return response()->json(new ContagemNeResource($contagemNe));
    }

    /**
     * Display the specified resource.
     */
    public function show(ContagemNe $contagemNe): JsonResponse
    {
        return response()->json(new ContagemNeResource($contagemNe));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContagemNeRequest $request, ContagemNe $contagemNe): JsonResponse
    {
        $contagemNe->update($request->validated());

        return response()->json(new ContagemNeResource($contagemNe));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(ContagemNe $contagemNe)
    {
        if($contagemNe->created_at->format('Y-m-d') != date('Y-m-d')){
            return response()->json(['message'=>'Ação negada / Fora de horario permitido'],400);
        }

        $contagemNe->forceDelete();

        return response()->noContent(); 
    }
}
