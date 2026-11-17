<?php
namespace Database\Seeders;
use App\Models\Publicacion;
use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Publicacion::create(['titulo'=>'Bicicleta de montaña','descripcion'=>'Rodada 26 en buen estado.','tipo'=>'Venta','precio'=>'1500.00','categoria'=>'Deportes','estado_articulo'=>'Usado']);
        Publicacion::create(['titulo'=>'Colección de libros','descripcion'=>'Libros de literatura variada.','tipo'=>'Donacion','precio'=>'0.00','categoria'=>'Libros','estado_articulo'=>'Bueno']);
    }
}
