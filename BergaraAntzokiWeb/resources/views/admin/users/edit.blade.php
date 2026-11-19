{{-- Página para EDITAR un usuario: usa la plantilla admin y marca la pestaña "users" del menú como activa. --}}
@extends('layouts.admin')

@section('title', 'Erabiltzailea editatu')

@section('fitxa', 'erabiltzaileak')

@section('content')
<div class="admin-main flex-grow-1 p-4 overflow-auto">
  {{-- Cabecera con el título y el botón para volver al listado. --}}
  <div class="d-flex justify-content-between align-items-end mb-3">
    <div>
      <h2 class="mb-0">Erabiltzaileak</h2>
      <small class="text-muted">«{{ $user->user_izena }}» erabiltzailearen datuak aldatu.</small>
    </div>
    <a href="{{ route('admin.dashboard') }}#erabiltzaileak" class="btn btn-light fw-semibold">← Erabiltzaileetara itzuli</a>
  </div>

  <div class="card mx-auto" style="max-width:640px;">
    {{-- Formulario que envía los cambios a la ruta update. Como HTML solo permite GET/POST, @method('PUT') le dice a Laravel que es un PUT. --}}
    <form action="{{ route('admin.user.update', $user) }}" method="POST" class="p-2">
      @csrf
      @method('PUT')

      <div class="card-header bg-white border-0">
        <small class="modal-eyebrow d-block mb-1 text-danger text-uppercase fw-bold">Erabiltzailea editatu</small>
        <h5 class="mb-0">Erabiltzailearen datuak</h5>
      </div>

      {{-- Campos del formulario (form.blade.php), rellenados con los datos actuales del usuario. --}}
      <div class="card-body">
        @include('admin.users.form', ['user' => $user])
      </div>

      {{-- Botones: Cancelar y Guardar cambios. --}}
      <div class="card-footer bg-white border-0 d-flex justify-content-end gap-2">
        <a href="{{ route('admin.dashboard') }}#erabiltzaileak" class="btn btn-light py-3 px-4 fw-semibold">Utzi</a>
        <button type="submit" class="btn btn-danger py-3 px-4 fw-semibold">Aldaketak gorde</button>
      </div>
    </form>
  </div>
</div>
@endsection
