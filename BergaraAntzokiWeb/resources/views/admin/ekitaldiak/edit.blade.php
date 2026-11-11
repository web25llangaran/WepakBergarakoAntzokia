@extends('layouts.admin')

@section('title', 'Ekitaldia editatu')

@section('fitxa', 'ekitaldiak')

@section('content')
<div class="admin-main flex-grow-1 p-4 overflow-auto">
  <div class="d-flex justify-content-between align-items-end mb-3">
    <div>
      <h2 class="mb-0">Ekitaldiak</h2>
      <small class="text-muted">«{{ $ekitaldia->izena }}» ekitaldiaren datuak aldatu.</small>
    </div>
    <a href="{{ route('admin.dashboard') }}#ekitaldiak" class="btn btn-light fw-semibold">← Ekitaldietara itzuli</a>
  </div>

  <div class="card mx-auto" style="max-width:640px;">
    <form action="{{ route('admin.ekitaldia.update', $ekitaldia) }}" method="POST" enctype="multipart/form-data" class="p-2">
      @csrf
      @method('PUT')

      <div class="card-header bg-white border-0">
        <small class="modal-eyebrow d-block mb-1 text-danger text-uppercase fw-bold">Ekitaldia editatu</small>
        <h5 class="mb-0">Ekitaldiaren datuak</h5>
      </div>

      <div class="card-body">
        @include('admin.ekitaldiak.form', ['ekitaldia' => $ekitaldia])
      </div>

      <div class="card-footer bg-white border-0 d-flex justify-content-end gap-2">
        <a href="{{ route('admin.dashboard') }}#ekitaldiak" class="btn btn-light py-3 px-4 fw-semibold">Utzi</a>
        <button type="submit" class="btn btn-danger py-3 px-4 fw-semibold">Aldaketak gorde</button>
      </div>
    </form>
  </div>
</div>
@endsection
