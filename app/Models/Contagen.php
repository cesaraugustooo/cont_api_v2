<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Contagen
 *
 * @property $id
 * @property $data_contagem
 * @property $hora_contagem
 * @property $qtd_contagem
 * @property $turmas_id
 * @property $users_id
 * @property $contagenscol
 * @property $deleted_at
 *
 * @property Turma $turma
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Contagen extends Model
{
    use SoftDeletes;
    public $timestamps = false;

    protected $perPage = 20;

    public static function updateRule()
    {
        return [
            'qtd_contagem' => 'sometimes|int|min:0',
            'turmas_id' => 'sometimes|int|exists:turmas,id',
        ];
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['data_contagem', 'hora_contagem', 'qtd_contagem', 'turmas_id', 'users_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function turma()
    {
        return $this->belongsTo(\App\Models\Turma::class, 'turmas_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'users_id', 'id');
    }
}
