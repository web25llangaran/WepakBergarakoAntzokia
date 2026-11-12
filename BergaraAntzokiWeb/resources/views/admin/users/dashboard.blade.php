<div class="d-flex justify-content-between align-items-end mb-3 flex-shrink-0">
  <div>
    <h2 class="mb-0">Erabiltzaileak</h2>
    <small class="text-muted">Antzokiko erabiltzaileak kudeatu.</small>
  </div>
  <small class="text-muted">Azken eguneraketa: {{ collect($users)->max('updated_at') }}</small>
</div>

<div class="card flex-grow-1 d-flex flex-column" style="min-height:0;">
  <div class="card-body d-flex justify-content-between align-items-center flex-shrink-0">
    <div>
      <h4 class="mb-0">Erabiltzaileen zerrenda</h4>
      <small class="text-muted">{{ count($users) }} erabiltzaile erregistratuta.</small>
    </div>

    <a href="{{ route('admin.user.sortu') }}" class="btn btn-danger">
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
          <th>Ekintzak</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($users as $user)
        <tr>
          <td><b>{{ $user->id }}</b></td>
          <td>{{ $user->user_izena }}</td>
          <td>{{ $user->izena }} {{ $user->abizena }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->nan ?: '—' }}</td>
          <td><span class="badge text-bg-light text-capitalize">{{ $user->rola }}</span></td>
          <td>{{ $user->alta_data?->format('Y-m-d H:i') }}</td>
          <td>
            @if ($user->baja_data)
            <span class="badge text-bg-secondary">Baja</span>
            @else
            <span class="badge text-bg-success">Aktiboa</span>
            @endif
          </td>
          <td>
            <div class="btn-group btn-group-sm">
              <a href="{{ route('admin.user.show', $user) }}" class="btn btn-outline-secondary" aria-label="Ikusi"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z"></path>
                  <circle cx="12" cy="12" r="2.5"></circle>
                </svg></a>
              <a href="{{ route('admin.user.edit', $user) }}" class="btn btn-outline-secondary" aria-label="Editatu"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M12 20h9"></path>
                  <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4Z"></path>
                </svg></a>
              <form action="{{ route('admin.user.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Ziur zaude «{{ $user->user_izena }}» erabiltzailea ezabatu nahi duzula? Bere sarrera guztiak ere ezabatuko dira.');">
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
          <td colspan="9" class="text-center text-muted py-4">Oraindik ez dago erabiltzailerik.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
