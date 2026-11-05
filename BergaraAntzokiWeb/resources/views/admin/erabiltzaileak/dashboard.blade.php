<div class="d-flex justify-content-between align-items-end mb-3 flex-shrink-0">
  <div>
    <h2 class="mb-0">Erabiltzaileak</h2>
    <small class="text-muted">Erregistratutako erabiltzaileak kudeatu.</small>
  </div>
  <small class="text-muted">Guztira: {{ $erabiltzaileak->count() }} erabiltzaile</small>
</div>

<div class="card flex-grow-1 d-flex flex-column" style="min-height:0;">
  <div class="card-body d-flex justify-content-between align-items-center flex-shrink-0">
    <div>
      <h4 class="mb-0">Erabiltzaileen zerrenda</h4>
      <small class="text-muted">Administratzaileak eta erabiltzaile arruntak.</small>
    </div>
    <a href="{{ route('admin.erabiltzailea.sortu') }}" class="btn btn-danger">
      + Erabiltzailea gehitu
    </a>
  </div>
  <div class="table-responsive overflow-auto flex-grow-1" style="min-height:0;">
    <table class="table table-hover align-middle mb-0">
      <thead class="sticky-top bg-white">
        <tr>
          <th>ID</th>
          <th>Erabiltzailea</th>
          <th>Izen-abizenak</th>
          <th>Emaila</th>
          <th>NAN</th>
          <th>Rola</th>
          <th>Alta data</th>
          <th>Egoera</th>
          <th>Sarrerak</th>
          <th>Ekintzak</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($erabiltzaileak as $erabiltzailea)
        <tr>
          <td><b>{{ $erabiltzailea->id }}</b></td>
          <td>{{ $erabiltzailea->user_izena }}</td>
          <td>{{ $erabiltzailea->izena }} {{ $erabiltzailea->abizena }}</td>
          <td>{{ $erabiltzailea->email }}</td>
          <td>{{ $erabiltzailea->nan ?? '—' }}</td>
          <td>
            <span @class(['badge', 'text-bg-danger' => $erabiltzailea->rola === \App\Enums\Rola::Admin->value, 'text-bg-secondary' => $erabiltzailea->rola !== \App\Enums\Rola::Admin->value])>{{ $erabiltzailea->rola }}</span>
          </td>
          <td>{{ $erabiltzailea->alta_data?->format('Y-m-d') }}</td>
          <td>
            @if ($erabiltzailea->baja_data)
            <span class="badge text-bg-warning">Baja: {{ $erabiltzailea->baja_data->format('Y-m-d') }}</span>
            @else
            <span class="badge text-bg-success">Aktibo</span>
            @endif
          </td>
          <td>{{ $erabiltzailea->erositako_sarrerak_count }}</td>
          <td>
            <div class="btn-group btn-group-sm">
              <a href="{{ route('admin.erabiltzailea.show', $erabiltzailea) }}" class="btn btn-outline-secondary" aria-label="Ikusi"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z"></path>
                  <circle cx="12" cy="12" r="2.5"></circle>
                </svg></a>
              <a href="{{ route('admin.erabiltzailea.edit', $erabiltzailea) }}" class="btn btn-outline-secondary" aria-label="Editatu"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M12 20h9"></path>
                  <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4Z"></path>
                </svg></a>
              {{-- Administratzaileak ezin du bere burua ezabatu --}}
              @unless ($erabiltzailea->is(auth()->user()))
              <form action="{{ route('admin.erabiltzailea.destroy', $erabiltzailea) }}" method="POST" class="d-inline" onsubmit="return confirm('Ziur zaude {{ $erabiltzailea->user_izena }} erabiltzailea ezabatu nahi duzula? Bere sarrera guztiak ere ezabatuko dira.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-secondary rounded-start-0" aria-label="Ezabatu"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 6h18M8 6V4h8v2M19 6l-1 15H6L5 6M10 11v5M14 11v5"></path>
                  </svg></button>
              </form>
              @endunless
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
