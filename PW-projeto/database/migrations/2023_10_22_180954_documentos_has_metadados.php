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
        Schema::create('documentos_has_metadados', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('documento_id')->constrained();
            $table->foreignId('metadado_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos_has_metadados');
    }
};
