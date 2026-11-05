@extends('layouts.admin')

@section('title', 'Erabiltzailea: '.$erabiltzailea->user_izena)

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

  <div class="card mx-auto mb-4" style="max-width:720px;">
    <div class="card-header bg-white border-0 pt-4 px-4">
      <small class="modal-eyebrow d-block mb-1 text-danger text-uppercase fw-bold">{{ $erabiltzailea->id }}. erabiltzailea · {{ $erabiltzailea->rola }}</small>
      <h5 class="mb-0">{{ $erabiltzailea->izena }} {{ $erabiltzailea->abizena }}</h5>
    </div>

    <div class="card-body px-4">
      <dl class="row mb-0">
        <dt class="col-sm-4 text-muted">Erabiltzaile izena</dt>
        <dd class="col-sm-8">{{ $erabiltzailea->user_izena }}</dd>

        <dt class="col-sm-4 text-muted">Emaila</dt>
        <dd class="col-sm-8">{{ $erabiltzailea->email }}</dd>

        <dt class="col-sm-4 text-muted">NAN</dt>
        <dd class="col-sm-8">{{ $erabiltzailea->nan ?? '—' }}</dd>

        <dt class="col-sm-4 text-muted">Alta data</dt>
        <dd class="col-sm-8">{{ $erabiltzailea->alta_data?->format('Y-m-d H:i') }}</dd>

        <dt class="col-sm-4 text-muted">Baja data</dt>
        <dd class="col-sm-8">{{ $erabiltzailea->baja_data?->format('Y-m-d') ?? 'Aktibo' }}</dd>
      </dl>
    </div>

    <div class="card-footer bg-white border-0 d-flex justify-content-end gap-2 pb-4 px-4">
      @unless ($erabiltzailea->is(auth()->user()))
      <form action="{{ route('admin.erabiltzailea.destroy', $erabiltzailea) }}" method="POST" onsubmit="return confirm('Ziur zaude erabiltzaile hau ezabatu nahi duzula? Bere sarrera guztiak ere ezabatuko dira.');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-outline-danger py-2 px-4 fw-semibold">Ezabatu</button>
      </form>
      @endunless
      <a href="{{ route('admin.erabiltzailea.edit', $erabiltzailea) }}" class="btn btn-danger py-2 px-4 fw-semibold">Editatu</a>
    </div>
  </div>

  {{-- Erositako sarrerak --}}
  <div class="card mx-auto" style="max-width:720px;">
    <div class="card-header bg-white border-0 pt-4 px-4">
      <h5 class="mb-0">Erositako sarrerak ({{ $erabiltzailea->erositako_sarrerak->count() }})</h5>
    </div>
    <div class="card-body px-4">
      @if ($erabiltzailea->erositako_sarrerak->isEmpty())
      <p class="text-muted mb-0">Erabiltzaile honek ez du sarrerarik erosi.</p>
      @else
      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Ekitaldia</th>
              <th>Aretoa</th>
              <th>Eserlekua</th>
              <th>Prezioa €</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($erabiltzailea->erositako_sarrerak as $sarrera)
            <tr>
              <td><a href="{{ route('admin.sarrera.show', $sarrera) }}"><b>{{ $sarrera->id }}</b></a></td>
              <td>{{ $sarrera->ekitaldia->izena }}</td>
              <td>{{ $sarrera->ekitaldia->aretoa->izena }}</td>
              <td>{{ $sarrera->eserlekua->lerro_zenb }}. ilara · {{ $sarrera->eserlekua->eserleku_zenb }}.</td>
              <td>{{ $sarrera->prezioa }} €</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      @endif
    </div>
  </div>
</div>
@endsection
