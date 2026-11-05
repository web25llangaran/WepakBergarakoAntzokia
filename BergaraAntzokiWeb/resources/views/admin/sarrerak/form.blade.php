{{--
  Sortu eta editatu formularioek partekatzen duten zatia.
  Aldagaiak: $erabiltzaileak, $ekitaldiak, $eserlekuak, $saldutakoEserlekuak, $sarrera (aukerakoa).
--}}
@php($sarrera ??= null)

<div class="mb-3">
  <label for="id_user" class="form-label fw-semibold">Erabiltzailea</label>
  <select name="id_user" id="id_user" class="form-select py-3 fw-semibold @error('id_user') is-invalid @enderror" required>
    <option value="" disabled @selected(! old('id_user', $sarrera?->id_user))>Aukeratu erabiltzailea</option>
    @foreach ($erabiltzaileak as $erabiltzailea)
    <option value="{{ $erabiltzailea->id }}" @selected(old('id_user', $sarrera?->id_user) == $erabiltzailea->id)>
      {{ $erabiltzailea->user_izena }} ({{ $erabiltzailea->izena }} {{ $erabiltzailea->abizena }})
    </option>
    @endforeach
  </select>
  @error('id_user') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
  <label for="id_ekitaldia" class="form-label fw-semibold">Ekitaldia</label>
  <select name="id_ekitaldia" id="id_ekitaldia" class="form-select py-3 fw-semibold @error('id_ekitaldia') is-invalid @enderror" required>
    <option value="" disabled @selected(! old('id_ekitaldia', $sarrera?->id_ekitaldia))>Aukeratu ekitaldia</option>
    @foreach ($ekitaldiak as $ekitaldia)
    <option value="{{ $ekitaldia->id }}" data-aretoa="{{ $ekitaldia->id_aretoa }}" @selected(old('id_ekitaldia', $sarrera?->id_ekitaldia) == $ekitaldia->id)>
      {{ $ekitaldia->izena }} · {{ $ekitaldia->data->format('Y-m-d H:i') }} · {{ $ekitaldia->aretoa->izena }}
    </option>
    @endforeach
  </select>
  @error('id_ekitaldia') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
  <label for="id_eserlekua" class="form-label fw-semibold">Eserlekua</label>
  <select name="id_eserlekua" id="id_eserlekua" class="form-select py-3 fw-semibold @error('id_eserlekua') is-invalid @enderror" required>
    <option value="" disabled @selected(! old('id_eserlekua', $sarrera?->id_eserlekua))>Aukeratu lehenengo ekitaldia</option>
    @foreach ($eserlekuak as $eserlekua)
    <option value="{{ $eserlekua->id }}" data-aretoa="{{ $eserlekua->id_aretoa }}" @selected(old('id_eserlekua', $sarrera?->id_eserlekua) == $eserlekua->id)>
      {{ $eserlekua->lerro_zenb }}. ilara · {{ $eserlekua->eserleku_zenb }}. eserlekua ({{ $eserlekua->eserleku_mota }})
    </option>
    @endforeach
  </select>
  @error('id_eserlekua') <div class="invalid-feedback">{{ $message }}</div> @enderror
  <small class="text-muted">Ekitaldiaren aretoko eserleku libreak bakarrik erakusten dira.</small>
</div>

<div class="mb-3">
  <label for="prezioa" class="form-label fw-semibold">Prezioa (€)</label>
  <input type="number" step="0.01" min="0" name="prezioa" id="prezioa" value="{{ old('prezioa', $sarrera?->prezioa) }}" class="form-control py-3 fw-semibold @error('prezioa') is-invalid @enderror" required>
  @error('prezioa') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

@push('scripts')
<script>
  // Ekitaldia aldatzean, bere aretoko eserleku libreak bakarrik erakutsi.
  document.addEventListener('DOMContentLoaded', () => {
    const saldutakoak = @json($saldutakoEserlekuak);
    const unekoSarrera = @json($sarrera?->id);
    const ekitaldiaSelect = document.getElementById('id_ekitaldia');
    const eserlekuaSelect = document.getElementById('id_eserlekua');

    const eserlekuakIragazi = () => {
      const ekitaldiOption = ekitaldiaSelect.selectedOptions[0];
      const aretoa = ekitaldiOption?.dataset.aretoa;
      const ekitaldikoSaldutakoak = saldutakoak[ekitaldiaSelect.value] ?? {};

      for (const option of eserlekuaSelect.options) {
        if (!option.value) {
          continue;
        }
        const saldutaBeste = ekitaldikoSaldutakoak[option.value] !== undefined
          && ekitaldikoSaldutakoak[option.value] !== unekoSarrera;
        const ezkutatu = option.dataset.aretoa !== aretoa || saldutaBeste;
        option.hidden = ezkutatu;
        option.disabled = ezkutatu;
        if (ezkutatu && option.selected) {
          eserlekuaSelect.value = '';
        }
      }
    };

    ekitaldiaSelect.addEventListener('change', eserlekuakIragazi);
    eserlekuakIragazi();
  });
</script>
@endpush
