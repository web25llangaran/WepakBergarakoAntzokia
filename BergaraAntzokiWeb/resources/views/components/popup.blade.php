{{-- Saioa hasteko eta erregistratzeko popup-a (Bootstrap modal). --}}
{{-- popup_fitxa eremu ezkutuak adierazten du zein formulario bidali den, erroreekin fitxa zuzena irekitzeko. --}}
<div class="modal fade popup-saioa" id="popup-saioa" tabindex="-1" aria-labelledby="popup-titulua" aria-hidden="true" @if($errors->any() && old('popup_fitxa')) data-berriro-ireki @endif>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            {{-- Goiburua --}}
            <div class="popup-goiburua">
                <div>
                    <p class="popup-marka">Bergarako Antzoki Web</p>
                    <h2 class="popup-titulua" id="popup-titulua">{{ old('popup_fitxa') === 'erregistroa' ? 'Sortu zure kontua' : 'Hasi saioa' }}</h2>
                </div>
                <button type="button" class="popup-itxi" data-bs-dismiss="modal" aria-label="Itxi">
                    <svg aria-hidden="true" width="20" height="20" viewBox="0 0 24 24"><path d="m6 6 12 12M18 6 6 18"></path></svg>
                </button>
            </div>

            {{-- Fitxak --}}
            <ul class="nav nav-tabs nav-fill popup-fitxak">
                <li class="nav-item">
                    <button type="button" class="nav-link {{ old('popup_fitxa') === 'erregistroa' ? '' : 'active' }}" data-bs-toggle="tab" data-bs-target="#panela-login" data-titulua="Hasi saioa">
                        Saioa hasi
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link {{ old('popup_fitxa') === 'erregistroa' ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#panela-erregistroa" data-titulua="Sortu zure kontua">
                        Erregistratu
                    </button>
                </li>
            </ul>

            {{-- Balidazio erroreak --}}
            @if($errors->any() && old('popup_fitxa'))
                <div class="alert alert-danger popup-alerta" role="alert">
                    @foreach($errors->all() as $errorea)
                        <div>{{ $errorea }}</div>
                    @endforeach
                </div>
            @endif

            <div class="tab-content">

                {{-- Saioa hasteko formularioa --}}
                <div class="tab-pane fade {{ old('popup_fitxa') === 'erregistroa' ? '' : 'show active' }}" id="panela-login">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="hidden" name="popup_fitxa" value="login">

                        <div class="mb-3">
                            <label class="form-label" for="login-email">Emaila *</label>
                            <input type="email" class="form-control" id="login-email" name="email" value="{{ old('popup_fitxa') === 'login' ? old('email') : '' }}" placeholder="zure@emaila.com" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="login-password">Pasahitza *</label>
                            <input type="password" class="form-control" id="login-password" name="password" placeholder="Zure pasahitza" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 popup-botoia">
                            Saioa hasi
                            <svg aria-hidden="true" width="20" height="20" viewBox="0 0 24 24"><path d="M5 12h14"></path><path d="m13 6 6 6-6 6"></path></svg>
                        </button>
                    </form>
                </div>

                {{-- Erregistratzeko formularioa --}}
                <div class="tab-pane fade {{ old('popup_fitxa') === 'erregistroa' ? 'show active' : '' }}" id="panela-erregistroa">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <input type="hidden" name="popup_fitxa" value="erregistroa">

                        <div class="mb-3">
                            <label class="form-label" for="erregistro-user-izena">Erabiltzaile izena <span class="popup-derrigorrezkoa">*</span></label>
                            <input type="text" class="form-control" id="erregistro-user-izena" name="user_izena" value="{{ old('user_izena') }}" placeholder="Adib. aaranburu" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label class="form-label" for="erregistro-izena">Izena <span class="popup-derrigorrezkoa">*</span></label>
                                <input type="text" class="form-control" id="erregistro-izena" name="izena" value="{{ old('izena') }}" placeholder="Adib. Ane" required>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="erregistro-abizena">Abizena <span class="popup-derrigorrezkoa">*</span></label>
                                <input type="text" class="form-control" id="erregistro-abizena" name="abizena" value="{{ old('abizena') }}" placeholder="Adib. Aranburu" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="erregistro-email">Emaila <span class="popup-derrigorrezkoa">*</span></label>
                            <input type="email" class="form-control" id="erregistro-email" name="email" value="{{ old('popup_fitxa') === 'erregistroa' ? old('email') : '' }}" placeholder="ane@email.eus" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="erregistro-password">Pasahitza <span class="popup-derrigorrezkoa">*</span></label>
                            <input type="password" class="form-control" id="erregistro-password" name="password" placeholder="Gutxienez 8 karaktere" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="erregistro-password-berretsi">Errepikatu pasahitza <span class="popup-derrigorrezkoa">*</span></label>
                            <input type="password" class="form-control" id="erregistro-password-berretsi" name="password_confirmation" placeholder="Idatzi berriro pasahitza" required>
                        </div>

                        <div class="form-check mb-4">
                            <input type="checkbox" class="form-check-input" id="erregistro-baldintzak" required>
                            <label class="form-check-label" for="erregistro-baldintzak">Baldintzak eta pribatutasuna onartzen ditut.</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 popup-botoia">
                            Kontua sortu
                            <svg aria-hidden="true" width="20" height="20" viewBox="0 0 24 24"><path d="M5 12h14"></path><path d="m13 6 6 6-6 6"></path></svg>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
