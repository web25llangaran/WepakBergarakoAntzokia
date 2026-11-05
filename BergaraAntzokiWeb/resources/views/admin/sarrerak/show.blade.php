@extends('layouts.admin')

@section('title', 'Sarrera #'.$sarrera->id)

@section('fitxa', 'sarrerak')

@section('content')
<div class="admin-main flex-grow-1 p-4 overflow-auto">
  <div class="d-flex justify-content-between align-items-end mb-3">
    <div>
      <h2 class="mb-0">Sarrerak</h2>
      <small class="text-muted">Sarreraren xehetasunak.</small>
    </div>
    <a href="{{ route('admin.dashboard') }}#sarrerak" class="btn btn-light fw-semibold">← Sarreretara itzuli</a>
  </div>

  <div class="card mx-auto" style="max-width:640px;">
    <div class="card-header bg-white border-0 pt-4 px-4">
      <small class="modal-eyebrow d-block mb-1 text-danger text-uppercase fw-bold">{{ $sarrera->id }}. sarrera</small>
      <h5 class="mb-0">{{ $sarrera->ekitaldia->izena }}</h5>
    </div>

    <div class="card-body px-4">
      <dl class="row mb-0">
        <dt class="col-sm-4 text-muted">Eroslea</dt>
        <dd class="col-sm-8">{{ $sarrera->eroslea->user_izena }} ({{ $sarrera->eroslea->izena }} {{ $sarrera->eroslea->abizena }})</dd>

        <dt class="col-sm-4 text-muted">Emaila</dt>
        <dd class="col-sm-8">{{ $sarrera->eroslea->email }}</dd>

        <dt class="col-sm-4 text-muted">Ekitaldiaren data</dt>
        <dd class="col-sm-8">{{ $sarrera->ekitaldia->data->format('Y-m-d H:i') }}</dd>

        <dt class="col-sm-4 text-muted">Aretoa</dt>
        <dd class="col-sm-8">{{ $sarrera->ekitaldia->aretoa->izena }}</dd>

        <dt class="col-sm-4 text-muted">Ilara / Eserlekua</dt>
        <dd class="col-sm-8">{{ $sarrera->eserlekua->lerro_zenb }}. ilara · {{ $sarrera->eserlekua->eserleku_zenb }}. eserlekua</dd>

        <dt class="col-sm-4 text-muted">Mota</dt>
        <dd class="col-sm-8">{{ $sarrera->eserlekua->eserleku_mota }}</dd>

        <dt class="col-sm-4 text-muted">Prezioa</dt>
        <dd class="col-sm-8 fw-bold">{{ $sarrera->prezioa }} €</dd>

        <dt class="col-sm-4 text-muted">Erosketa data</dt>
        <dd class="col-sm-8">{{ $sarrera->created_at?->format('Y-m-d H:i') }}</dd>
      </dl>
    </div>

    <div class="card-footer bg-white border-0 d-flex justify-content-end gap-2 pb-4 px-4">
      <form action="{{ route('admin.sarrera.destroy', $sarrera) }}" method="POST" onsubmit="return confirm('Ziur zaude sarrera hau ezabatu nahi duzula?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-outline-danger py-2 px-4 fw-semibold">Ezabatu</button>
      </form>
      <a href="{{ route('admin.sarrera.edit', $sarrera) }}" class="btn btn-danger py-2 px-4 fw-semibold">Editatu</a>
    </div>
  </div>
</div>
@endsection
