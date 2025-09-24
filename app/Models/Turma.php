<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Turma
 *
 * @property $id
 * @property $nome_turma
 * @property $categorias_id
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property Categoria $categoria
 * @property Contagen[] $contagens
 * @property Restrico[] $restricoes
 * @property Sala[] $salas
 * @property Tarefa[] $tarefas
 * @property Aluno[] $alunos
 * @property Contagen[] $contagens
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Turma extends Model
{
    use SoftDeletes;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nome_turma', 'categorias_id'];

    public static function updateRule()
    {
        return [
            'nome_turma' => 'sometimes|string',
            'categorias_id' => 'sometimes|int',
        ];
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categoria()
    {
        return $this->belongsTo(\App\Models\Categoria::class, 'categorias_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contagen()
    {
        return $this->hasOne(\App\Models\Contagen::class, 'turmas_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function restricoes()
    {
        return $this->hasMany(\App\Models\Restrico::class, 'id_turma', 'turma_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tarefas()
    {
        return $this->hasMany(\App\Models\Tarefa::class, 'id_turma', 'id_turma');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function alunos()
    {
        return $this->hasMany(\App\Models\Aluno::class, 'id', 'turmas_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
}
