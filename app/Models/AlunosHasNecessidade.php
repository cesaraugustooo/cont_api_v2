<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AlunosHasNecessidade
 *
 * @property $id
 * @property $alunos_id
 * @property $necessidades_id
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property Aluno $aluno
 * @property Necessidade $necessidade
 * @property ContagemNe[] $contagemNes
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class AlunosHasNecessidade extends Model
{
    use SoftDeletes;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['alunos_id', 'necessidades_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function aluno()
    {
        return $this->belongsTo(\App\Models\Aluno::class, 'alunos_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function necessidade()
    {
        return $this->belongsTo(\App\Models\Necessidade::class, 'necessidades_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contagemNes()
    {
        return $this->hasMany(\App\Models\ContagemNe::class, 'id', 'alunos_has_necessidades_id');
    }
    
}
