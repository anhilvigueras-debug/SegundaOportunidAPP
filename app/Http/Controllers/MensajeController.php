<?php

namespace App\Http\Controllers;

use App\Models\Conversacion;
use App\Models\Mensaje;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MensajeController extends Controller
{
    public function index()
    {
        $usuarioId = Auth::id();

        $conversaciones = Conversacion::with(['publicacion', 'comprador', 'vendedor', 'mensajes'])
            ->where(function ($query) use ($usuarioId) {
                $query->where('comprador_id', $usuarioId)->where('oculta_comprador', false);
            })
            ->orWhere(function ($query) use ($usuarioId) {
                $query->where('vendedor_id', $usuarioId)->where('oculta_vendedor', false);
            })
            ->latest('updated_at')
            ->get();

        $conversacionActiva = $conversaciones->first();

        return view('mensajes.index', compact('conversaciones', 'conversacionActiva'));
    }

    public function iniciar($publicacion_id)
    {
        $usuarioId = Auth::id();
        $publicacion = Publicacion::findOrFail($publicacion_id);

        if ($publicacion->user_id === $usuarioId) {
            return redirect()->back()->with('error', 'No puedes iniciar una conversación contigo mismo.');
        }

        $conversacion = Conversacion::firstOrCreate(
            [
                'publicacion_id' => $publicacion->id,
                'comprador_id'   => $usuarioId,
                'vendedor_id'    => $publicacion->user_id,
            ],
            [
                'oculta_comprador' => false,
                'oculta_vendedor'  => false,
            ]
        );

        return redirect()->route('mensajes.show', $conversacion->id);
    }

    public function show($conversacion_id)
    {
        $usuarioId = Auth::id();

        $conversaciones = Conversacion::with(['publicacion', 'comprador', 'vendedor', 'mensajes'])
            ->where(function ($query) use ($usuarioId) {
                $query->where('comprador_id', $usuarioId)->where('oculta_comprador', false);
            })
            ->orWhere(function ($query) use ($usuarioId) {
                $query->where('vendedor_id', $usuarioId)->where('oculta_vendedor', false);
            })
            ->latest('updated_at')
            ->get();

        // Cambiado de remitente a emisor para que coincida con la base de datos
        $conversacionActiva = Conversacion::with(['mensajes.emisor', 'publicacion', 'comprador', 'vendedor'])
            ->findOrFail($conversacion_id);

        return view('mensajes.index', compact('conversaciones', 'conversacionActiva'));
    }

    public function enviar(Request $request, $conversacion_id)
    {
        $request->validate([
            'mensaje' => 'required|string|max:500',
        ]);

        $usuarioId = Auth::id();
        $conversacion = Conversacion::findOrFail($conversacion_id);

        $receptorId = ($conversacion->comprador_id === $usuarioId)
            ? $conversacion->vendedor_id
            : $conversacion->comprador_id;

        Mensaje::create([
            'conversacion_id' => $conversacion_id,
            'emisor_id'       => $usuarioId,
            'receptor_id'     => $receptorId,
            'contenido'       => trim($request->input('mensaje')),
            'leido'           => false,
        ]);

        return redirect()->route('mensajes.show', $conversacion_id);
       }
       public function eliminarMensaje($id)
    {
        $mensaje = Mensaje::findOrFail($id);

        // Verificamos que el usuario actual sea el emisor del mensaje
        if ($mensaje->emisor_id === Auth::id()) {
            $mensaje->delete();
        }

        return redirect()->back();
    }
}
