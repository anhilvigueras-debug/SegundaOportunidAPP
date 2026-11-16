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
    Schema::create('conversaciones', function (Blueprint $table) {
        $table->id();
        $table->foreignId('publicacion_id')->constrained('publicacions')->onDelete('cascade');
        $table->foreignId('comprador_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('vendedor_id')->constrained('users')->onDelete('cascade');
        $table->boolean('oculta_comprador')->default(false);
        $table->boolean('oculta_vendedor')->default(false);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversaciones');
    }
};
