<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Necessidade
 *
 * @property $id
 * @property $necessidade
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property AlunosHasNecessidade[] $alunosHasNecessidades
 * @property NecessidadesHasCronograma[] $necessidadesHasCronogramas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Necessidade extends Model
{
    use SoftDeletes;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['necessidade'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function alunosHasNecessidades()
    {
        return $this->hasMany(\App\Models\AlunosHasNecessidade::class, 'id', 'necessidades_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function necessidadesHasCronogramas()
    {
        return $this->hasMany(\App\Models\NecessidadesHasCronograma::class, 'id', 'necessidades_id');
    }
    
}
