{{--
  Sortu eta editatu formularioek partekatzen duten zatia.
  Aldagaiak: $user (aukerakoa).
--}}
@php($user ??= null)

<div class="mb-3">
  <label for="user_izena" class="form-label fw-semibold">Erabiltzaile izena</label>
  <input type="text" name="user_izena" id="user_izena" maxlength="255" value="{{ old('user_izena', $user?->user_izena) }}" class="form-control py-3 fw-semibold @error('user_izena') is-invalid @enderror" required>
  @error('user_izena') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="row">
  <div class="col-md-6 mb-3">
    <label for="izena" class="form-label fw-semibold">Izena</label>
    <input type="text" name="izena" id="izena" maxlength="255" value="{{ old('izena', $user?->izena) }}" class="form-control py-3 fw-semibold @error('izena') is-invalid @enderror" required>
    @error('izena') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-6 mb-3">
    <label for="abizena" class="form-label fw-semibold">Abizena</label>
    <input type="text" name="abizena" id="abizena" maxlength="255" value="{{ old('abizena', $user?->abizena) }}" class="form-control py-3 fw-semibold @error('abizena') is-invalid @enderror" required>
    @error('abizena') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
</div>

<div class="row">
  <div class="col-md-6 mb-3">
    <label for="email" class="form-label fw-semibold">Emaila</label>
    <input type="email" name="email" id="email" maxlength="255" value="{{ old('email', $user?->email) }}" class="form-control py-3 fw-semibold @error('email') is-invalid @enderror" required>
    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-6 mb-3">
    <label for="nan" class="form-label fw-semibold">NAN <small class="text-muted fw-normal">(aukerakoa)</small></label>
    <input type="text" name="nan" id="nan" maxlength="9" value="{{ old('nan', $user?->nan) }}" class="form-control py-3 fw-semibold @error('nan') is-invalid @enderror">
    @error('nan') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
</div>

<div class="mb-3">
  <label for="rola" class="form-label fw-semibold">Rola</label>
  <select name="rola" id="rola" class="form-select py-3 fw-semibold @error('rola') is-invalid @enderror" required>
    @foreach (\App\Enums\Rola::cases() as $rola)
    <option value="{{ $rola->value }}" @selected(old('rola', $user?->rola ?? \App\Enums\Rola::Arrunta->value) == $rola->value)>
      {{ ucfirst($rola->value) }}
    </option>
    @endforeach
  </select>
  @error('rola') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="row">
  <div class="col-md-6 mb-3">
    <label for="alta_data" class="form-label fw-semibold">Alta data</label>
    <input type="datetime-local" name="alta_data" id="alta_data" value="{{ old('alta_data', $user?->alta_data?->format('Y-m-d\TH:i')) }}" class="form-control py-3 fw-semibold @error('alta_data') is-invalid @enderror" required>
    @error('alta_data') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-6 mb-3">
    <label for="baja_data" class="form-label fw-semibold">Baja data <small class="text-muted fw-normal">(aukerakoa)</small></label>
    <input type="datetime-local" name="baja_data" id="baja_data" value="{{ old('baja_data', $user?->baja_data?->format('Y-m-d\TH:i')) }}" class="form-control py-3 fw-semibold @error('baja_data') is-invalid @enderror">
    @error('baja_data') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>
</div>

<div class="row">
  <div class="col-md-6 mb-3">
    <label for="password" class="form-label fw-semibold">Pasahitza</label>
    <input type="password" name="password" id="password" autocomplete="new-password" class="form-control py-3 fw-semibold @error('password') is-invalid @enderror" @required(! $user)>
    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
  </div>

  <div class="col-md-6 mb-3">
    <label for="password_confirmation" class="form-label fw-semibold">Pasahitza berretsi</label>
    <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password" class="form-control py-3 fw-semibold" @required(! $user)>
  </div>

  @if ($user)
  <div class="col-12 mb-3">
    <small class="text-muted">Hutsik utziz gero, uneko pasahitza mantenduko da.</small>
  </div>
  @endif
</div>
