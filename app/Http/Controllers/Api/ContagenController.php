<?php

namespace App\Http\Controllers\Api;

use App\Models\Contagen;
use Illuminate\Http\Request;
use App\Http\Requests\ContagenRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContagenResource;
use Illuminate\Database\QueryException;

class ContagenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $day = $request->query('date') ?? null;

        if($day){
            $contagens = Contagen::with(['turma.categoria'])->orderBy('data_contagem','DESC')->orderBy('hora_contagem','DESC')->where('data_contagem',$day)->paginate();

            return ContagenResource::collection($contagens);
        }

        $contagens = Contagen::with(['turma.categoria'])->orderBy('data_contagem','DESC')->orderBy('hora_contagem','DESC')->paginate();

        return ContagenResource::collection($contagens);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContagenRequest $request)
    {
        try{
            $contagen = Contagen::create(array_merge($request->validated(),['data_contagem'=>date('Y-m-d'),'hora_contagem'=>date('H:i:s'),'users_id'=>auth()->user()->id]));

            return response()->json(new ContagenResource($contagen));
        }catch(QueryException $e){
            if($e->getCode() == 23000){
                return response()->json(['message'=>'Turma não existente'],404);
            }
        }    
    }

    /**
     * Display the specified resource.
     */
    public function show(Contagen $contagen): JsonResponse
    {
        return response()->json(new ContagenResource($contagen));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contagen $contagen): JsonResponse
    {
        if($contagen->data_contagem != date('Y-m-d')){
            return response()->json(['message'=>'Update nao permitido / Fora de horario permitido'],400);
        }

        $contagen->update($request->validate(Contagen::updateRule()));

        return response()->json(new ContagenResource($contagen));
    }
    /**
     * Delete the specified resource.
     */
    public function destroy(Contagen $contagen)
    {
        return response()->json(['message'=>'Rota Indisponivel'],404);
    }
}
