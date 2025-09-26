<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Cronograma
 *
 * @property $id
 * @property $dia
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property NecessidadesHasCronograma[] $necessidadesHasCronogramas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Cronograma extends Model
{
    use SoftDeletes;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['dia'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function necessidadesHasCronogramas()
    {
        return $this->hasMany(\App\Models\NecessidadesHasCronograma::class, 'id', 'cronograma_id');
    }
    
}
