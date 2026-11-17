<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('publicacions', function (Blueprint $table) {
            $table->string('foto')->nullable()->after('estado_articulo');
            $table->foreignId('user_id')->nullable()->after('foto')->constrained('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('publicacions', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['foto', 'user_id']);
        });
    }
};
