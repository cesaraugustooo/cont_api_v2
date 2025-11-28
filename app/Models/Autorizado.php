<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Autorizado
 *
 * @property $id
 * @property $titulo
 * @property $conteudo
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Autorizado extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['titulo', 'conteudo', 'status'];

    public static function updateRule()
    {
        return [
            'titulo' => 'sometimes|string',
            'conteudo' => 'sometimes|string',
            'status' => 'sometimes|in:pendente,confirmado',
        ];
    }
}
