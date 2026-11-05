<?php

namespace App\Http\Requests;

/**
 * Sortzeko arau berberak; unique araua editatzen ari den sarrera ignoratzen du
 * ($this->route('sarrera') bidez).
 */
class UpdateSarreraRequest extends StoreSarreraRequest {}
