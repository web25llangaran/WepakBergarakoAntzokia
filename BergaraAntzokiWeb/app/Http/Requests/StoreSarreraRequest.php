<?php

namespace App\Http\Requests;

use App\Models\Ekitaldia;
use App\Models\Eserlekua;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class StoreSarreraRequest extends FormRequest
{
    /**
     * Admin baimena 'admin' middleware-ak egiaztatzen du dagoeneko.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Sarrera baten datuen balidazio arauak (sarrerak taularen zutabeekin bat).
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_user' => ['required', 'integer', Rule::exists('users', 'id')],
            'id_ekitaldia' => ['required', 'integer', Rule::exists('ekitaldiak', 'id')],
            'id_eserlekua' => [
                'required',
                'integer',
                Rule::exists('eserlekuak', 'id'),
                // Eserleku bera ezin da bi aldiz saldu ekitaldi berean.
                Rule::unique('sarrerak', 'id_eserlekua')
                    ->where('id_ekitaldia', $this->integer('id_ekitaldia'))
                    ->ignore($this->route('sarrera')),
            ],
            'prezioa' => ['required', 'numeric', 'decimal:0,2', 'min:0', 'max:999999.99'],
        ];
    }

    /**
     * Eserlekua ekitaldiaren aretokoa dela egiaztatu.
     *
     * @return array<int, callable>
     */
    public function after(): array
    {
        return [
            function (Validator $validator): void {
                if ($validator->errors()->hasAny(['id_ekitaldia', 'id_eserlekua'])) {
                    return;
                }

                $ekitaldia = Ekitaldia::find($this->integer('id_ekitaldia'));
                $eserlekua = Eserlekua::find($this->integer('id_eserlekua'));

                if ($ekitaldia->id_aretoa !== $eserlekua->id_aretoa) {
                    $validator->errors()->add('id_eserlekua', 'Eserlekua ez dago ekitaldiaren aretoan.');
                }
            },
        ];
    }

    /**
     * Balidazio mezuak euskaraz.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'id_user.required' => 'Erabiltzailea aukeratu behar da.',
            'id_user.exists' => 'Aukeratutako erabiltzailea ez da existitzen.',
            'id_ekitaldia.required' => 'Ekitaldia aukeratu behar da.',
            'id_ekitaldia.exists' => 'Aukeratutako ekitaldia ez da existitzen.',
            'id_eserlekua.required' => 'Eserlekua aukeratu behar da.',
            'id_eserlekua.exists' => 'Aukeratutako eserlekua ez da existitzen.',
            'id_eserlekua.unique' => 'Eserleku hau dagoeneko salduta dago ekitaldi honetarako.',
            'prezioa.required' => 'Prezioa derrigorrezkoa da.',
            'prezioa.numeric' => 'Prezioak zenbaki bat izan behar du.',
            'prezioa.decimal' => 'Prezioak gehienez 2 hamartar izan ditzake.',
            'prezioa.min' => 'Prezioa ezin da negatiboa izan.',
            'prezioa.max' => 'Prezioa handiegia da.',
        ];
    }
}
