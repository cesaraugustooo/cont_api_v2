<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ControleDeProducaoEConsumo
 *
 * @property $id
 * @property $nome_alimento
 * @property $data_alimento
 * @property $quantidade_alimento
 * @property $medida_alimento
 * @property $pessoas_alimento
 * @property $sobra_limpa_alimento
 * @property $desperdicio_alimento
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ControleDeProducaoEConsumo extends Model
{
    use SoftDeletes;

    public $table = 'controle_de_producao_e_consumo';

    protected $perPage = 20;
    
    public static function updateRule(){
        return [
            'nome_alimento' => 'sometimes|string',
			'data_alimento' => 'sometimes|date',
			'quantidade_alimento' => 'sometimes|numeric',
			'medida_alimento' => 'sometimes|string',
			'pessoas_alimento' => 'sometimes|int',
			'sobra_limpa_alimento' => 'sometimes|numeric',
			'desperdicio_alimento' => 'sometimes|numeric',
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['nome_alimento', 'data_alimento', 'quantidade_alimento', 'medida_alimento', 'pessoas_alimento', 'sobra_limpa_alimento', 'desperdicio_alimento'];


}
