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
        Schema::table('livro_autors', function (Blueprint $table) {
            $table->foreign(['autor_id'], 'livro_autors_autor_id_fkey')->references(['id'])->on('autors')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['livro_id'], 'livro_autors_livro_id_fkey')->references(['id'])->on('livros')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('livro_autors', function (Blueprint $table) {
            $table->dropForeign('livro_autors_autor_id_fkey');
            $table->dropForeign('livro_autors_livro_id_fkey');
        });
    }
};
