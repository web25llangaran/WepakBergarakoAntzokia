<div class="d-flex justify-content-between align-items-end mb-3 flex-shrink-0">
  <div>
    <h2 class="mb-0">Sarrerak</h2>
    <small class="text-muted">Salmentak eta erreserbak egiaztatu.</small>
  </div>
  <small class="text-muted">Azken eguneraketa: {{ collect($sarrerak)->max('updated_at') }}</small>
</div>

<div class="card flex-grow-1 d-flex flex-column" style="min-height:0;">
  <div class="card-body d-flex justify-content-between align-items-center flex-shrink-0">
    <div>
      <h4 class="mb-0">Sarrerak eta erreserbak</h4>
      <small class="text-muted">Azken salmenten jarraipena.</small>
    </div>
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#sarreraCreateModal">
      + Sarrera gehitu
    </button>
  </div>
  <div class="table-responsive overflow-auto flex-grow-1" style="min-height:0;">
    <table class="table table-hover align-middle mb-0">
      <thead class="sticky-top bg-white">
        <tr>
          <th>ID</th>
          <th>Ekitaldia</th>
          <th>Erabiltzailea</th>
          <th>Aretoa</th>
          <th>Ilara</th>
          <th>Eserlekua</th>
          <th>Mota</th>
          <th>Prezioa €</th>
          <th>Ekintzak</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($sarrerak as $sarrera)
        <tr>
          <td><b>{{$sarrera->id}}</b></td>
          <td>{{$sarrera->ekitaldia->izena}}</td>
          <td>{{$sarrera->eroslea->user_izena}}</td>
          <td>{{$sarrera->ekitaldia->aretoa->izena}}</td>
          <td>{{$sarrera->eserlekua->lerro_zenb}}</td>
          <td>{{$sarrera->eserlekua->eserleku_zenb}}</td>
          <td>{{$sarrera->eserlekua->eserleku_mota}}</td>
          <td>{{$sarrera->prezioa}} €</td>
          <td>
            <div class="btn-group btn-group-sm">
              <button class="btn btn-outline-secondary" aria-label="Ikusi"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z"></path>
                  <circle cx="12" cy="12" r="2.5"></circle>
                </svg></button>
              <button class="btn btn-outline-secondary" aria-label="Editatu"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M12 20h9"></path>
                  <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4Z"></path>
                </svg></button>
              <button class="btn btn-outline-secondary" aria-label="Ezabatu"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M3 6h18M8 6V4h8v2M19 6l-1 15H6L5 6M10 11v5M14 11v5"></path>
                </svg></button>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>


<!-- SARRERAK CREATE MODAL -->
<div class="modal fade" id="sarreraCreateModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content p-2">

      <form action="{{ route('admin.sarrera.store') }}" method="POST">
        @csrf

        <div class="modal-header border-0 align-items-start">
          <div>
            <small class="modal-eyebrow d-block mb-1 text-danger text-uppercase fw-bold">Sarrera berria</small>
            <h5 class="modal-title">Salmentaren datuak</h5>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <div class="mb-3">
            <label for="erabiltzailea_id" class="form-label fw-semibold">Erabiltzailea</label>
            <select name="erabiltzailea_id" class="form-select py-3 fw-semibold">
              @foreach($erabiltzaileak as $e)
                <option value="{{ $e->id }}">{{ $e->user_izena }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="ekitaldia_id" class="form-label fw-semibold">Ekitaldia</label>
            <select name="ekitaldia_id" class="form-select py-3 fw-semibold">
              @foreach($ekitaldiak as $e)
              <option value="{{ $e->id }}">{{ $e->izena }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="eserlekua_id" class="form-label fw-semibold">Eserlekua</label>
            <select name="eserlekua_id" class="form-select py-3 fw-semibold" onchange="ekitaldikoEserlekuak(this)">
              @foreach($ekitaldiak as $e)
              <option value="{{ $e->id }}">{{ $e->izena }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="prezioa" class="form-label fw-semibold">Prezioa (€)</label>
            <input type="number" step="0.01" name="prezioa" id="prezioa" class="form-control py-3 fw-semibold" required>
          </div>
        </div>

        <div class="modal-footer border-0">
          <button type="button" class="btn btn-light py-3 px-4 fw-semibold" data-bs-dismiss="modal">Utzi</button>
          <button type="submit" class="btn btn-danger py-3 px-4 fw-semibold">Gorde sarrera</button>
        </div>
      </form>
    </div>
  </div>
</div>