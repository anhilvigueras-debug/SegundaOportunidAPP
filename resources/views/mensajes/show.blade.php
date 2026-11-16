@extends('layouts.app')

@section('titulo', 'Chat - SegundaOportunidAPP')

@section('contenido')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="mb-0">{{ $conversacion->publicacion->titulo ?? 'Publicación' }}</h4>
                <small class="text-muted">
                    Conversación con:
                    <strong>
                        @if ($conversacion->comprador_id === Auth::id())
                            {{ $conversacion->vendedor->name ?? ($conversacion->vendedor->nombre ?? 'Vendedor') }}
                        @else
                            {{ $conversacion->comprador->name ?? ($conversacion->comprador->nombre ?? 'Interesado') }}
                        @endif
                    </strong>
                </small>
            </div>
            <a href="{{ route('mensajes.index') }}" class="btn btn-outline-secondary btn-sm">Volver a bandeja</a>
        </div>

        {{-- Alerta de validación de mensaje vacío (RF10) --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first('contenido') }}
            </div>
        @endif

        {{-- Historial de mensajes --}}
        <div class="card shadow-sm mb-3">
            <div class="card-body" style="height: 400px; overflow-y: auto; background-color: #f8f9fa;">
                @forelse($conversacion->mensajes as $msg)
                    @php $esMio = ($msg->emisor_id === Auth::id()); @endphp
                    <div class="d-flex flex-column mb-3 {{ $esMio ? 'align-items-end' : 'align-items-start' }}">
                        <div class="p-3 rounded {{ $esMio ? 'bg-primary text-white' : 'bg-white border' }}"
                            style="max-width: 70%;">
                            <p class="mb-1">{{ $msg->contenido }}</p>
                            <small class="{{ $esMio ? 'text-light' : 'text-muted' }}" style="font-size: 0.75rem;">
                                {{ $msg->created_at->format('d/m/Y H:i') }}
                                @if ($esMio)
                                    · {{ $msg->leido ? 'Leído ✓✓' : 'Enviado ✓' }}
                                @endif
                            </small>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-muted mt-5">Aún no hay mensajes. ¡Escribe el primero para coordinar!</p>
                @endforelse
            </div>
        </div>

        {{-- Formulario de envío --}}
        <form action="{{ route('mensajes.enviar', $conversacion->id) }}" method="POST">
            @csrf
            <div class="input-group">
                <input type="text" name="contenido" class="form-control @error('contenido') is-invalid @enderror"
                    placeholder="Escribe tu mensaje aquí..." autocomplete="off">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </form>
    </div>
@endsection
