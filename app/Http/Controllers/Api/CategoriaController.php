<?php

namespace App\Http\Controllers\Api;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Requests\CategoriaRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoriaResource;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categorias = Categoria::with(['turmas'])->paginate();

        return CategoriaResource::collection($categorias);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoriaRequest $request): JsonResponse
    {
        $categoria = Categoria::create($request->validated());

        return response()->json(new CategoriaResource($categoria));
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria): JsonResponse
    {
        return response()->json(new CategoriaResource($categoria));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoriaRequest $request, Categoria $categoria): JsonResponse
    {
        $categoria->update($request->validated());

        return response()->json(new CategoriaResource($categoria));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(Categoria $categoria): Response
    {
        $categoria->delete();

        return response()->noContent();
    }
}
