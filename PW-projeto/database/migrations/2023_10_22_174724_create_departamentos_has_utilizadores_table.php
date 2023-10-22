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
        Schema::create('departamentos_has_utilizadores', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('utilizador_id')->constrained();
            $table->foreignId('departamento_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departamentos_has_utilizadores');
    }
};
