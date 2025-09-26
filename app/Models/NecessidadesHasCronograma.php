<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class NecessidadesHasCronograma
 *
 * @property $necessidades_id
 * @property $cronograma_id
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property Cronograma $cronograma
 * @property Necessidade $necessidade
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class NecessidadesHasCronograma extends Model
{
    use SoftDeletes;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['necessidades_id', 'cronograma_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cronograma()
    {
        return $this->belongsTo(\App\Models\Cronograma::class, 'cronograma_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function necessidade()
    {
        return $this->belongsTo(\App\Models\Necessidade::class, 'necessidades_id', 'id');
    }
    
}
