<?php

namespace App\Http\Requests;

/**
 * Sortzeko arau berberak. Editatzean ($this->route('erabiltzailea') badago):
 * unique arauek erabiltzaile hau ignoratzen dute, pasahitza aukerakoa da eta rola ezin da aldatu.
 */
class UpdateUserRequest extends StoreUserRequest {}
