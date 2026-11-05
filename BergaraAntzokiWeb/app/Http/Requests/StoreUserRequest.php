<?php

namespace App\Http\Requests;

use App\Enums\Rola;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    /**
     * Admin baimena 'admin' middleware-ak egiaztatzen du dagoeneko.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Erabiltzaile baten datuen balidazio arauak (users taularen zutabeekin bat).
     * Editatzean, unique arauek editatzen ari den erabiltzailea ignoratzen dute.
     * Rola sortzean bakarrik aukeratzen da: editatzean ez dago araurik, beraz validated()-ek
     * ez du inoiz 'rola' itzuliko eta bidalitako balioa ez da kontuan hartzen (segurtasuna).
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $erabiltzailea = $this->route('erabiltzailea');

        $arauak = [
            'user_izena' => ['required', 'string', 'max:20', Rule::unique(User::class)->ignore($erabiltzailea)],
            'izena' => ['required', 'string', 'max:50'],
            'abizena' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($erabiltzailea)],
            'nan' => ['nullable', 'string', 'size:9', Rule::unique(User::class)->ignore($erabiltzailea)],
            'password' => [$erabiltzailea ? 'nullable' : 'required', 'confirmed', Password::defaults()],
            'baja_data' => ['nullable', 'date', 'after_or_equal:'.($erabiltzailea?->alta_data?->toDateString() ?? 'today')],
        ];

        if (! $erabiltzailea) {
            $arauak['rola'] = ['required', Rule::enum(Rola::class)];
        }

        return $arauak;
    }

    /**
     * Balidazio mezuak euskaraz.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'user_izena.required' => 'Erabiltzaile izena derrigorrezkoa da.',
            'user_izena.max' => 'Erabiltzaile izenak gehienez 20 karaktere izan ditzake.',
            'user_izena.unique' => 'Erabiltzaile izen hori dagoeneko erabiltzen ari da.',
            'izena.required' => 'Izena derrigorrezkoa da.',
            'izena.max' => 'Izenak gehienez 50 karaktere izan ditzake.',
            'abizena.required' => 'Abizena derrigorrezkoa da.',
            'abizena.max' => 'Abizenak gehienez 50 karaktere izan ditzake.',
            'email.required' => 'Emaila derrigorrezkoa da.',
            'email.email' => 'Emailak ez du formatu egokia.',
            'email.lowercase' => 'Emailak letra xehez idatzi behar da.',
            'email.unique' => 'Email hori dagoeneko erregistratuta dago.',
            'nan.size' => 'NANak 9 karaktere izan behar ditu (8 zenbaki eta letra bat).',
            'nan.unique' => 'NAN hori dagoeneko erregistratuta dago.',
            'rola.required' => 'Rola aukeratu behar da.',
            'rola.enum' => 'Aukeratutako rola ez da baliozkoa.',
            'password.required' => 'Pasahitza derrigorrezkoa da.',
            'password.confirmed' => 'Pasahitzak ez datoz bat.',
            'password.min' => 'Pasahitzak gutxienez :min karaktere izan behar ditu.',
            'baja_data.date' => 'Baja datak ez du formatu egokia.',
            'baja_data.after_or_equal' => 'Baja data ezin da alta data baino lehenagokoa izan.',
        ];
    }
}
