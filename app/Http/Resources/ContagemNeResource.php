<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContagemNeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'data_hora_contagem'=>$this->created_at,
            'aluno'=>[
                'id'=>$this->alunosHasNecessidade->id,
                'nome'=>$this->alunosHasNecessidade->aluno->nome,
                'rm'=>$this->alunosHasNecessidade->aluno->rm,
                'necessidade'=>$this->alunosHasNecessidade->necessidade->necessidade ?? null,
                
            ]
        ];
    }
}
