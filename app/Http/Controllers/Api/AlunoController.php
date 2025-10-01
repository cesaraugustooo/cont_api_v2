<?php

namespace App\Http\Controllers\Api;

use App\Models\Aluno;
use Illuminate\Http\Request;
use App\Http\Requests\AlunoRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\AlunoResource;

class AlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $alunos = Aluno::paginate();

        return AlunoResource::collection($alunos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AlunoRequest $request): JsonResponse
    {
        $aluno = Aluno::create($request->validated());

        return response()->json(new AlunoResource($aluno));
    }

    /**
     * Display the specified resource.
     */
    public function show(Aluno $aluno): JsonResponse
    {
        return response()->json(new AlunoResource($aluno));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aluno $aluno): JsonResponse
    {
        $aluno->update($request->validate(Aluno::updateRule()));

        return response()->json(new AlunoResource($aluno));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(Aluno $aluno): Response
    {
        $aluno->delete();

        return response()->noContent();
    }

    public function relationNecessidades(Request $request,Aluno $aluno){
        $validate = $request->validate([
            'necessidades'=>'required|array'
        ]);

        foreach($validate['necessidades'] as $id){
            $aluno->necessidades()->attach($id);
        }

        return response()->json([$aluno->load('necessidades')]);
    }
}
