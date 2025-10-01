<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Categoria
 *
 * @property $id
 * @property $nome_categoria
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property Turma[] $turmas
 * @property Turma[] $turmas
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Categoria extends Model
{
    use SoftDeletes;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nome_categoria'];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function turmas()
    {
        return $this->hasMany(\App\Models\Turma::class, 'categorias_id');
    }
    
}
