@extends('layouts.admin')

@section('title', 'Sarrera berria')

@section('fitxa', 'sarrerak')

@section('content')
<div class="admin-main flex-grow-1 p-4 overflow-auto">
  <div class="d-flex justify-content-between align-items-end mb-3">
    <div>
      <h2 class="mb-0">Sarrerak</h2>
      <small class="text-muted">Salmenta berri bat erregistratu.</small>
    </div>
    <a href="{{ route('admin.dashboard') }}#sarrerak" class="btn btn-light fw-semibold">← Sarreretara itzuli</a>
  </div>

  <div class="card mx-auto" style="max-width:640px;">
    <form action="{{ route('admin.sarrera.store') }}" method="POST" class="p-2">
      @csrf

      <div class="card-header bg-white border-0">
        <small class="modal-eyebrow d-block mb-1 text-danger text-uppercase fw-bold">Sarrera berria</small>
        <h5 class="mb-0">Salmentaren datuak</h5>
      </div>

      <div class="card-body">
        @include('admin.sarrerak.form')
      </div>

      <div class="card-footer bg-white border-0 d-flex justify-content-end gap-2">
        <a href="{{ route('admin.dashboard') }}#sarrerak" class="btn btn-light py-3 px-4 fw-semibold">Utzi</a>
        <button type="submit" class="btn btn-danger py-3 px-4 fw-semibold">Gorde sarrera</button>
      </div>
    </form>
  </div>
</div>
@endsection
