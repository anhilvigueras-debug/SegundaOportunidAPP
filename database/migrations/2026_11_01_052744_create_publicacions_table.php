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
    Schema::create('publicacions', function (Blueprint $table) {
        $table->id();
        $table->string('titulo');              // Ej: "Chamarra de mezclilla", "Juego de Platos"
        $table->text('descripcion');           // Detalles del estado del objeto
        $table->enum('tipo', ['Donacion', 'Venta']); // Modalidad de la publicación
        $table->decimal('precio', 8, 2)->default(0.00); // 0.00 si es Donación
        $table->string('categoria');           // Ej: Ropa, Electrónica, Hogar, Juguetes
        $table->string('estado_articulo');     // Ej: Nuevo, Como nuevo, Usado
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publicacions');
    }
};
