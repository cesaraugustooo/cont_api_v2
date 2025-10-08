<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DashboardResource extends JsonResource
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
            'nome_categoria'=>$this->nome_categoria,
            'turmas'=>$this->turmas->map(function($turma){
                return[
                    'id'=>$turma->id,
                    'nome_turma'=>$turma->nome_turma,
                    'qtd_contagem'=>$turma->contagen->qtd_contagem ?? 0,
                    'data_contagem'=>$turma->contagen->data_contagem ?? null
                ];

            })
        ];
    }
}
