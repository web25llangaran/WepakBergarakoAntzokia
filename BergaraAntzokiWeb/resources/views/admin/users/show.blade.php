@extends('layouts.admin')

@section('title', 'Erabiltzailea #'.$user->id)

@section('fitxa', 'erabiltzaileak')

@section('content')
<div class="admin-main flex-grow-1 p-4 overflow-auto">
  <div class="d-flex justify-content-between align-items-end mb-3">
    <div>
      <h2 class="mb-0">Erabiltzaileak</h2>
      <small class="text-muted">Erabiltzailearen xehetasunak.</small>
    </div>
    <a href="{{ route('admin.dashboard') }}#erabiltzaileak" class="btn btn-light fw-semibold">← Erabiltzaileetara itzuli</a>
  </div>

  <div class="card mx-auto" style="max-width:640px;">
    <div class="card-header bg-white border-0 pt-4 px-4">
      <small class="modal-eyebrow d-block mb-1 text-danger text-uppercase fw-bold">{{ $user->id }}. erabiltzailea · {{ $user->rola }}</small>
      <h5 class="mb-0">{{ $user->user_izena }}</h5>
    </div>

    <div class="card-body px-4">
      <dl class="row mb-0">
        <dt class="col-sm-4 text-muted">Izen-abizenak</dt>
        <dd class="col-sm-8">{{ $user->izena }} {{ $user->abizena }}</dd>

        <dt class="col-sm-4 text-muted">Emaila</dt>
        <dd class="col-sm-8">{{ $user->email }}</dd>

        <dt class="col-sm-4 text-muted">NAN</dt>
        <dd class="col-sm-8">{{ $user->nan ?: '—' }}</dd>

        <dt class="col-sm-4 text-muted">Rola</dt>
        <dd class="col-sm-8 text-capitalize">{{ $user->rola }}</dd>

        <dt class="col-sm-4 text-muted">Alta data</dt>
        <dd class="col-sm-8">{{ $user->alta_data?->format('Y-m-d H:i') }}</dd>

        <dt class="col-sm-4 text-muted">Baja data</dt>
        <dd class="col-sm-8">{{ $user->baja_data?->format('Y-m-d H:i') ?? '—' }}</dd>

        <dt class="col-sm-4 text-muted">Sortze data</dt>
        <dd class="col-sm-8">{{ $user->created_at?->format('Y-m-d H:i') }}</dd>
      </dl>
    </div>

    <div class="card-footer bg-white border-0 d-flex justify-content-end gap-2 pb-4 px-4">
      <form action="{{ route('admin.user.destroy', $user) }}" method="POST" onsubmit="return confirm('Ziur zaude erabiltzaile hau ezabatu nahi duzula?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-outline-danger py-2 px-4 fw-semibold">Ezabatu</button>
      </form>
      <a href="{{ route('admin.user.edit', $user) }}" class="btn btn-danger py-2 px-4 fw-semibold">Editatu</a>
    </div>
  </div>
</div>
@endsection
