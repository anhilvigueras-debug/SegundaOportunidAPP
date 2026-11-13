<?php
namespace Tests\Feature;
use App\Models\Aportacion;
use App\Models\Publicacion;
use App\Models\Venta;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
class TransaccionesTest extends TestCase
{
    use RefreshDatabase;
    private function publicacion(string $tipo = 'Venta', string $precio = '100.10'): Publicacion
    {
        return Publicacion::create(['titulo'=>'Artículo','descripcion'=>'Descripción','categoria'=>'Hogar','estado_articulo'=>'Usado','tipo'=>$tipo,'precio'=>$precio]);
    }
    public function test_registra_venta_y_calcula_comision_redondeada_sin_duplicar(): void
    {
        config(['transacciones.comision_puntos_base'=>500]);
        $publicacion=$this->publicacion();
        $data=['publicacion_id'=>$publicacion->id,'comprador'=>'Marco','confirmacion'=>'1'];
        $this->post(route('ventas.store'),$data)->assertRedirect(route('ventas.index'));
        $venta=Venta::firstOrFail();
        $this->assertSame('100.10',$venta->monto);
        $this->assertSame('5.01',$venta->comision);
        $this->assertSame('95.09',$venta->monto_vendedor);
        $this->post(route('ventas.store'),$data)->assertSessionHasErrors('publicacion_id');
        $this->assertDatabaseCount('ventas',1);
        $this->put(route('ventas.update',$venta),['publicacion_id'=>$publicacion->id,'comprador'=>'Otro nombre','confirmacion'=>'1'])->assertRedirect();
        $this->assertSame('5.01',$venta->fresh()->comision);
        $this->delete(route('publicaciones.destroy',$publicacion))->assertSessionHas('error');
        $this->delete(route('ventas.destroy',$venta))->assertRedirect(route('ventas.index'));
    }
    public function test_venta_rechaza_campos_faltantes_y_publicaciones_de_donacion(): void
    {
        $this->post(route('ventas.store'),[])->assertSessionHasErrors(['publicacion_id','comprador','confirmacion']);
        $p=$this->publicacion('Donacion','0.00');
        $this->post(route('ventas.store'),['publicacion_id'=>$p->id,'comprador'=>'Marco','confirmacion'=>1])->assertSessionHasErrors('publicacion_id');
        $this->assertDatabaseCount('ventas',0);
    }
    public function test_aportacion_guarda_y_descarga_comprobante_y_permite_editarlo(): void
    {
        $file=UploadedFile::fake()->createWithContent('recibo.pdf', "%PDF-1.4\nDocumento de prueba");
        $data=['nombre'=>'Marco','correo'=>'marco@example.test','monto'=>'25.50','referencia'=>'REF-001','confirmacion'=>1,'comprobante'=>$file];
        $this->post(route('aportaciones.store'),$data)->assertRedirect();
        $a=Aportacion::firstOrFail();
        $this->assertSame('25.50',$a->monto);
        $this->get(route('aportaciones.comprobante',$a))->assertOk()->assertHeader('Content-Type','application/pdf')->assertSee('Documento de prueba');
        $this->put(route('aportaciones.update',$a),['nombre'=>'Marco A','correo'=>'marco@example.test','monto'=>'30.00','referencia'=>'REF-001','confirmacion'=>1])->assertRedirect();
        $this->assertSame('30.00',$a->fresh()->monto);
        $this->assertNotEmpty($a->fresh()->comprobante_contenido);
        $this->delete(route('aportaciones.destroy',$a))->assertRedirect(route('aportaciones.index'));
        $this->assertDatabaseCount('aportaciones',0);
    }
    public function test_aportacion_rechaza_datos_invalidos_y_referencia_duplicada(): void
    {
        $this->post(route('aportaciones.store'),[])->assertSessionHasErrors(['nombre','correo','monto','referencia','comprobante','confirmacion']);
        $data=['nombre'=>'Marco','correo'=>'mal','monto'=>'0','referencia'=>'R','confirmacion'=>1,'comprobante'=>UploadedFile::fake()->create('mal.txt',1,'text/plain')];
        $this->post(route('aportaciones.store'),$data)->assertSessionHasErrors(['correo','monto','comprobante']);
        $data=['nombre'=>'Marco','correo'=>'a@example.test','monto'=>'10.00','referencia'=>'R','confirmacion'=>1,'comprobante'=>UploadedFile::fake()->createWithContent('recibo.pdf',"%PDF-1.4\nEjemplo")];
        $this->post(route('aportaciones.store'),$data)->assertRedirect();
        $data['comprobante']=UploadedFile::fake()->createWithContent('recibo.pdf',"%PDF-1.4\nEjemplo");
        $this->post(route('aportaciones.store'),$data)->assertSessionHasErrors('referencia');
    }
    public function test_paginas_de_crud_responden(): void
    {
        $p=$this->publicacion();
        foreach (['publicaciones.index','publicaciones.create','ventas.index','ventas.create','aportaciones.index','aportaciones.create'] as $ruta) { $this->get(route($ruta))->assertOk(); }
        $this->get(route('publicaciones.show',$p))->assertOk();
        $this->get(route('publicaciones.edit',$p))->assertOk();
    }
}
