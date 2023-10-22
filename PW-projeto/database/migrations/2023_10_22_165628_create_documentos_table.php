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
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignID('metadado_id')->constrained();
            $table->string('autor');
            $table->string('proprietario');
            $table->string('historico');
            $table->string('tipologia');
            $table->string('categorias');
            $table->foreignId('permissoes_id')->constrained();
            $table->foreignId('utilizador_id')->constrained();
            $table->foreignId('metadado_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};
