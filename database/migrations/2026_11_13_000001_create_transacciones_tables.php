<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('publicacion_id')->unique()->constrained('publicacions')->restrictOnDelete();
            $table->string('comprador', 120);
            $table->decimal('monto', 10, 2);
            $table->unsignedSmallInteger('comision_puntos_base');
            $table->decimal('comision', 10, 2);
            $table->decimal('monto_vendedor', 10, 2);
            $table->timestamps();
        });
        Schema::create('aportaciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 120);
            $table->string('correo', 254);
            $table->decimal('monto', 10, 2);
            $table->string('referencia', 100)->unique();
            $table->string('comprobante_nombre', 255);
            $table->string('comprobante_tipo', 50);
            $table->longText('comprobante_contenido');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('aportaciones');
        Schema::dropIfExists('ventas');
    }
};
