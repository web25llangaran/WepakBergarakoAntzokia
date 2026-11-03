<div class="d-flex justify-content-between align-items-end mb-3">
    <div>
        <h2 class="mb-0">Sarrerak</h2>
        <small class="text-muted">Salmentak eta erreserbak egiaztatu.</small>
    </div>
    <small class="text-muted">Azken eguneraketa: gaur, 10:42</small>
</div>

<div class="card">
    <div class="card-body d-flex justify-content-between align-items-center">
        <div>
            <h4 class="mb-0">Sarrerak eta erreserbak</h4>
            <small class="text-muted">Azken salmenten jarraipena.</small>
        </div>
        <button type="button" class="btn btn-danger">+ Sarrera gehitu</button>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-uppercase small">
                <tr>
                    <th>ID</th>
                    <th>Ekitaldia</th>
                    <th>Erabiltzailea</th>
                    <th>Aretoa</th>
                    <th>Ilara</th>
                    <th>Eserlekua</th>
                    <th>Mota</th>
                    <th>Prezioa</th>
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
                    <td>{{$sarrera->prezioa}}</td>
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