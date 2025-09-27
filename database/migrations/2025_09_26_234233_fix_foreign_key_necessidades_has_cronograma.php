<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::table('necessidades_has_cronograma', function (Blueprint $table) {
        // primeiro dropa a FK antiga
        $table->dropForeign(['alunos_has_necessidades_id']);

        // cria a FK correta apontando para alunos_has_necessidades
        $table->foreign('alunos_has_necessidades_id')
              ->references('id')
              ->on('alunos_has_necessidades')
              ->cascadeOnDelete();
    });
}

public function down(): void
{
    Schema::table('necessidades_has_cronograma', function (Blueprint $table) {
        $table->dropForeign(['alunos_has_necessidades_id']);
        $table->foreign('alunos_has_necessidades_id')
              ->references('id')
              ->on('necessidades'); // volta pro jeito errado (rollback)
    });
}

};
