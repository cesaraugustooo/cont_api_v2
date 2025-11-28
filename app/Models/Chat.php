<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Chat
 *
 * @property $id
 * @property $mensagem_chat
 * @property $visto
 * @property $data
 * @property $users_id
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Chat extends Model
{
    use SoftDeletes;

    public $table = 'chat';
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['mensagem_chat', 'visto', 'data', 'users_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'users_id');
    }

    public static function updateRule(){
        return [
            'mensagem_chat' => 'sometimes|string|max:100',
			'visto' => 'sometimes|in:s,n',
			'data' => 'sometimes|date',
			'users_id' => 'sometimes|int',
        ];
    }
}
