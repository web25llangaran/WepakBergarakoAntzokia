<div class="d-flex justify-content-between align-items-end mb-3 flex-shrink-0">
  <div>
    <h2 class="mb-0">Ekitaldiak</h2>
    <small class="text-muted">Antzokiaren programazioa kudeatu.</small>
  </div>
  <small class="text-muted">Azken eguneraketa: {{ collect($ekitaldiak)->max('updated_at') }}</small>
</div>

<div class="card flex-grow-1 d-flex flex-column" style="min-height:0;">
  <div class="card-body d-flex justify-content-between align-items-center flex-shrink-0">
    <div>
      <h4 class="mb-0">Ekitaldien zerrenda</h4>
      <small class="text-muted">{{ count($ekitaldiak) }} ekitaldi programatuta.</small>
    </div>

    <a href="{{ route('admin.ekitaldia.sortu') }}" class="btn btn-danger">
      + Ekitaldia gehitu
    </a>
  </div>
  <div class="table-responsive overflow-auto flex-grow-1" style="min-height:0;">
    <table class="table table-hover align-middle mb-0">
      <thead class="sticky-top bg-white">
        <tr>
          <th>ID</th>
          <th>Irudia</th>
          <th>Izena</th>
          <th>Mota</th>
          <th>Data</th>
          <th>Aretoa</th>
          <th>Ekintzak</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($ekitaldiak as $ekitaldia)
        <tr>
          <td><b>{{ $ekitaldia->id }}</b></td>
          <td>
            @if ($ekitaldia->irudia)
            <img src="{{ $ekitaldia->irudia }}" alt="{{ $ekitaldia->izena }}" class="rounded" style="width:56px;height:40px;object-fit:cover;">
            @else
            <span class="text-muted">—</span>
            @endif
          </td>
          <td>{{ $ekitaldia->izena }}</td>
          <td><span class="badge text-bg-light text-capitalize">{{ $ekitaldia->ekitaldi_mota }}</span></td>
          <td>{{ $ekitaldia->data->format('Y-m-d H:i') }}</td>
          <td>{{ $ekitaldia->aretoa->izena }}</td>
          <td>
            <div class="btn-group btn-group-sm">
              <a href="{{ route('admin.ekitaldia.show', $ekitaldia) }}" class="btn btn-outline-secondary" aria-label="Ikusi"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z"></path>
                  <circle cx="12" cy="12" r="2.5"></circle>
                </svg></a>
              <a href="{{ route('admin.ekitaldia.edit', $ekitaldia) }}" class="btn btn-outline-secondary" aria-label="Editatu"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M12 20h9"></path>
                  <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4Z"></path>
                </svg></a>
              <form action="{{ route('admin.ekitaldia.destroy', $ekitaldia) }}" method="POST" class="d-inline" onsubmit="return confirm('Ziur zaude «{{ $ekitaldia->izena }}» ekitaldia ezabatu nahi duzula? Bere sarrera guztiak ere ezabatuko dira.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-secondary rounded-start-0" aria-label="Ezabatu"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 6h18M8 6V4h8v2M19 6l-1 15H6L5 6M10 11v5M14 11v5"></path>
                  </svg></button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="7" class="text-center text-muted py-4">Oraindik ez dago ekitaldirik.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
