<?php

namespace App\Http\Controllers\Api;

use App\Models\Necessidade;
use Illuminate\Http\Request;
use App\Http\Requests\NecessidadeRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\NecessidadeResource;
use App\Models\Aluno;
use App\Models\AlunosHasNecessidade;
use App\Models\NecessidadesHasCronograma;

class NecessidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $necessidades = Necessidade::paginate();

        return NecessidadeResource::collection($necessidades);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NecessidadeRequest $request): JsonResponse
    {
        $necessidade = Necessidade::create($request->validated());

        return response()->json(new NecessidadeResource($necessidade));
    }

    /**
     * Display the specified resource.
     */
    public function show(Necessidade $necessidade): JsonResponse
    {
        return response()->json(new NecessidadeResource($necessidade->load('alunos')));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NecessidadeRequest $request, Necessidade $necessidade): JsonResponse
    {
        $necessidade->update($request->validated());

        return response()->json(new NecessidadeResource($necessidade));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(Necessidade $necessidade): Response
    {
        $necessidade->delete();

        return response()->noContent();
    }

    public function relationCronograma(Request $request,AlunosHasNecessidade $necessidade){
        $validate = $request->validate([
            'dias'=>'required|array',
        ]);

        foreach($validate['dias'] as $id){
            $necessidade->necessidadesHasCronogramas()->attach($id);
        }

        return response()->json(['message'=>'success','data'=>$necessidade->load('necessidadesHasCronogramas')]);
    }

    public function disableAluno(Request $request,Necessidade $necessidade){
        $validate = $request->validate([
            'alunos'=>'required|array'
        ]);

        $alunos = $validate['alunos'];
        $id =   AlunosHasNecessidade::where('alunos_id',$alunos)
        ->where('necessidades_id',$necessidade->id)
        ->first() ?? null;

        if(!$id){
            return response()->json(['message'=>'Relação de necessidade e aluno não encontrada'],404);
        }

        NecessidadesHasCronograma::where('alunos_has_necessidades_id',$id->id)->forceDelete();

        $id->forceDelete();

        return response()->noContent();
    }
}
