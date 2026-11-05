{{--
  Sortu eta editatu formularioek partekatzen duten zatia.
  Aldagaiak: $rolak, $erabiltzailea (aukerakoa: editatzean bakarrik).
--}}
@php($erabiltzailea ??= null)

<div class="row g-3 mb-3">
  <div class="col-md-6">
    <label for="izena" class="form-label fw-semibold">Izena</label>
    <input type="text" name="izena" id="izena" maxlength="50" value="{{ old('izena', $erabiltzailea?->izena) }}" class="form-control py-3 fw-semibold @error('izena') is-invalid @enderror" required>
    @error('izena') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
  <div class="col-md-6">
    <label for="abizena" class="form-label fw-semibold">Abizena</label>
    <input type="text" name="abizena" id="abizena" maxlength="50" value="{{ old('abizena', $erabiltzailea?->abizena) }}" class="form-control py-3 fw-semibold @error('abizena') is-invalid @enderror" required>
    @error('abizena') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
</div>

<div class="row g-3 mb-3">
  <div class="col-md-6">
    <label for="user_izena" class="form-label fw-semibold">Erabiltzaile izena</label>
    <input type="text" name="user_izena" id="user_izena" maxlength="20" value="{{ old('user_izena', $erabiltzailea?->user_izena) }}" class="form-control py-3 fw-semibold @error('user_izena') is-invalid @enderror" required>
    @error('user_izena') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
  <div class="col-md-6">
    <label for="nan" class="form-label fw-semibold">NAN <small class="text-muted fw-normal">(aukerakoa)</small></label>
    <input type="text" name="nan" id="nan" maxlength="9" value="{{ old('nan', $erabiltzailea?->nan) }}" class="form-control py-3 fw-semibold @error('nan') is-invalid @enderror">
    @error('nan') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
</div>

<div class="mb-3">
  <label for="email" class="form-label fw-semibold">Emaila</label>
  <input type="email" name="email" id="email" maxlength="255" value="{{ old('email', $erabiltzailea?->email) }}" class="form-control py-3 fw-semibold @error('email') is-invalid @enderror" required>
  @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="row g-3 mb-3">
  <div class="col-md-6">
    <label for="rola" class="form-label fw-semibold">Rola</label>
    @if ($erabiltzailea)
    {{-- Rola sortzean bakarrik aukeratzen da. Eremu honek ez du 'name'-rik: ez da bidaltzen. --}}
    <input type="text" id="rola" value="{{ ucfirst($erabiltzailea->rola) }}" class="form-control py-3 fw-semibold" disabled>
    <small class="text-muted">Rola ezin da aldatu.</small>
    @else
    <select name="rola" id="rola" class="form-select py-3 fw-semibold @error('rola') is-invalid @enderror" required>
      @foreach ($rolak as $rola)
      <option value="{{ $rola->value }}" @selected(old('rola', \App\Enums\Rola::Arrunta->value) === $rola->value)>{{ ucfirst($rola->value) }}</option>
      @endforeach
    </select>
    @error('rola') <div class="invalid-feedback">{{ $message }}</div> @enderror
    @endif
  </div>
  <div class="col-md-6">
    <label for="baja_data" class="form-label fw-semibold">Baja data <small class="text-muted fw-normal">(aukerakoa)</small></label>
    <input type="date" name="baja_data" id="baja_data" value="{{ old('baja_data', $erabiltzailea?->baja_data?->format('Y-m-d')) }}" class="form-control py-3 fw-semibold @error('baja_data') is-invalid @enderror">
    @error('baja_data') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
</div>

<div class="row g-3 mb-3">
  <div class="col-md-6">
    <label for="password" class="form-label fw-semibold">Pasahitza</label>
    <input type="password" name="password" id="password" autocomplete="new-password" class="form-control py-3 fw-semibold @error('password') is-invalid @enderror" @required(! $erabiltzailea)>
    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
  <div class="col-md-6">
    <label for="password_confirmation" class="form-label fw-semibold">Pasahitza berretsi</label>
    <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password" class="form-control py-3 fw-semibold" @required(! $erabiltzailea)>
  </div>
  @if ($erabiltzailea)
  <div class="col-12 mt-1">
    <small class="text-muted">Pasahitza ez aldatzeko, utzi bi eremuak hutsik.</small>
  </div>
  @endif
</div>
