<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Aluno
 *
 * @property $id
 * @property $nome
 * @property $genero
 * @property $dia
 * @property $foto
 * @property $turmas_id
 * @property $data_nascimento
 * @property $rm
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property Turma $turma
 * @property AlunosHasNecessidade[] $alunosHasNecessidades
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Aluno extends Model
{
    use SoftDeletes;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nome', 'genero','descricao', 'foto', 'turmas_id', 'data_nascimento', 'rm'];

    public static function updateRule(){
        return [
            'nome' => 'sometimes|string',
            'descricao'=>'sometimes|string',
			'genero' => 'sometimes|string',
			'foto' => 'string',
			'turmas_id' => 'sometimes|exists:turmas,id',
			'data_nascimento' => 'sometimes|date',
			'rm' => 'sometimes|string',
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function turma()
    {
        return $this->belongsTo(\App\Models\Turma::class, 'turmas_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function necessidades()
    {
        return $this->belongsToMany(Necessidade::class,'alunos_has_necessidades','alunos_id','necessidades_id');
    }

    
}
