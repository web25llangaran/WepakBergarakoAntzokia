@extends('layouts.admin')

@section('title', 'Ekitaldia #'.$ekitaldia->id)

@section('fitxa', 'ekitaldiak')

@section('content')
<div class="admin-main flex-grow-1 p-4 overflow-auto">
  <div class="d-flex justify-content-between align-items-end mb-3">
    <div>
      <h2 class="mb-0">Ekitaldiak</h2>
      <small class="text-muted">Ekitaldiaren xehetasunak.</small>
    </div>
    <a href="{{ route('admin.dashboard') }}#ekitaldiak" class="btn btn-light fw-semibold">← Ekitaldietara itzuli</a>
  </div>

  <div class="card mx-auto overflow-hidden" style="max-width:640px;">
    @if ($ekitaldia->irudia)
    <img src="{{ $ekitaldia->irudia }}" alt="{{ $ekitaldia->izena }}" class="card-img-top" style="max-height:260px;object-fit:cover;">
    @endif

    <div class="card-header bg-white border-0 pt-4 px-4">
      <small class="modal-eyebrow d-block mb-1 text-danger text-uppercase fw-bold">{{ $ekitaldia->id }}. ekitaldia · {{ $ekitaldia->ekitaldi_mota }}</small>
      <h5 class="mb-0">{{ $ekitaldia->izena }}</h5>
    </div>

    <div class="card-body px-4">
      <dl class="row mb-0">
        <dt class="col-sm-4 text-muted">Data eta ordua</dt>
        <dd class="col-sm-8">{{ $ekitaldia->data->format('Y-m-d H:i') }}</dd>

        <dt class="col-sm-4 text-muted">Aretoa</dt>
        <dd class="col-sm-8">{{ $ekitaldia->aretoa->izena }}</dd>

        <dt class="col-sm-4 text-muted">Saldutako sarrerak</dt>
        <dd class="col-sm-8">{{ $ekitaldia->sarrerak->count() }} / {{ $ekitaldia->aretoa->exerleku_kopurua }}</dd>

        <dt class="col-sm-4 text-muted">Deskripzioa</dt>
        <dd class="col-sm-8">{!! nl2br(e($ekitaldia->deskripzioa ?: '—')) !!}</dd>

        <dt class="col-sm-4 text-muted">Sortze data</dt>
        <dd class="col-sm-8">{{ $ekitaldia->created_at?->format('Y-m-d H:i') }}</dd>
      </dl>
    </div>

    <div class="card-footer bg-white border-0 d-flex justify-content-end gap-2 pb-4 px-4">
      <form action="{{ route('admin.ekitaldia.destroy', $ekitaldia) }}" method="POST" onsubmit="return confirm('Ziur zaude ekitaldi hau ezabatu nahi duzula? Bere sarrera guztiak ere ezabatuko dira.');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-outline-danger py-2 px-4 fw-semibold">Ezabatu</button>
      </form>
      <a href="{{ route('admin.ekitaldia.edit', $ekitaldia) }}" class="btn btn-danger py-2 px-4 fw-semibold">Editatu</a>
    </div>
  </div>
</div>
@endsection
