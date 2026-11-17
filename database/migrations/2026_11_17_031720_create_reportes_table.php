public function up(): void
{
    Schema::create('reportes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('publicacion_id')->constrained('publicacions')->onDelete('cascade');
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->string('motivo');
        $table->text('descripcion')->nullable();
        $table->string('estado')->default('pendiente');
        $table->timestamps();
    });
}