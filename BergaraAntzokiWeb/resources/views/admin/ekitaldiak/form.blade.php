{{--
  Sortu eta editatu formularioek partekatzen duten zatia.
  Aldagaiak: $aretoak, $ekitaldia (aukerakoa).
--}}
@php($ekitaldia ??= null)

<div class="mb-3">
  <label for="izena" class="form-label fw-semibold">Izena</label>
  <input type="text" name="izena" id="izena" maxlength="255" value="{{ old('izena', $ekitaldia?->izena) }}" class="form-control py-3 fw-semibold @error('izena') is-invalid @enderror" required>
  @error('izena') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
  <label for="deskripzioa" class="form-label fw-semibold">Deskripzioa <small class="text-muted fw-normal">(aukerakoa)</small></label>
  <textarea name="deskripzioa" id="deskripzioa" rows="4" class="form-control @error('deskripzioa') is-invalid @enderror">{{ old('deskripzioa', $ekitaldia?->deskripzioa) }}</textarea>
  @error('deskripzioa') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="row">
  <div class="col-md-6 mb-3">
    <label for="ekitaldi_mota" class="form-label fw-semibold">Mota</label>
    <select name="ekitaldi_mota" id="ekitaldi_mota" class="form-select py-3 fw-semibold @error('ekitaldi_mota') is-invalid @enderror" required>
      <option value="" disabled @selected(! old('ekitaldi_mota', $ekitaldia?->ekitaldi_mota))>Aukeratu mota</option>
      @foreach (\App\Enums\EkitaldiMota::cases() as $mota)
      <option value="{{ $mota->value }}" @selected(old('ekitaldi_mota', $ekitaldia?->ekitaldi_mota) == $mota->value)>
        {{ ucfirst($mota->value) }}
      </option>
      @endforeach
    </select>
    @error('ekitaldi_mota') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-6 mb-3">
    <label for="data" class="form-label fw-semibold">Data eta ordua</label>
    <input type="datetime-local" name="data" id="data" value="{{ old('data', $ekitaldia?->data?->format('Y-m-d\TH:i')) }}" class="form-control py-3 fw-semibold @error('data') is-invalid @enderror" required>
    @error('data') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
</div>

<div class="mb-3">
  <label for="id_aretoa" class="form-label fw-semibold">Aretoa</label>
  <select name="id_aretoa" id="id_aretoa" class="form-select py-3 fw-semibold @error('id_aretoa') is-invalid @enderror" required>
    <option value="" disabled @selected(! old('id_aretoa', $ekitaldia?->id_aretoa))>Aukeratu aretoa</option>
    @foreach ($aretoak as $aretoa)
    <option value="{{ $aretoa->id }}" @selected(old('id_aretoa', $ekitaldia?->id_aretoa) == $aretoa->id)>
      {{ $aretoa->izena }} ({{ $aretoa->exerleku_kopurua }} eserleku)
    </option>
    @endforeach
  </select>
  @error('id_aretoa') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
  <label for="irudia" class="form-label fw-semibold">Irudia</label>
  @if ($ekitaldia?->irudia)
  <div class="mb-2">
    <img src="{{ $ekitaldia->irudia }}" alt="{{ $ekitaldia->izena }}" class="rounded border" style="max-height:120px;">
  </div>
  @endif
  <input type="file" name="irudia" id="irudia" accept="image/jpeg,image/png,image/webp" class="form-control @error('irudia') is-invalid @enderror">
  @error('irudia') <div class="invalid-feedback">{{ $message }}</div> @enderror
  <small class="text-muted">
    JPG, PNG edo WEBP, gehienez 2 MB.
    @if ($ekitaldia?->irudia) Hutsik utziz gero, uneko irudia mantenduko da. @endif
  </small>
</div>
