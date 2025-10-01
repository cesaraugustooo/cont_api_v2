<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ContagemNe
 *
 * @property $id
 * @property $alunos_has_necessidades_id
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property AlunosHasNecessidade $alunosHasNecessidade
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ContagemNe extends Model
{
    use SoftDeletes;

    public $table = 'contagem_nes';  

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['alunos_has_necessidades_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function alunosHasNecessidade()
    {
        return $this->belongsTo(\App\Models\AlunosHasNecessidade::class, 'alunos_has_necessidades_id');
    }
    
}
