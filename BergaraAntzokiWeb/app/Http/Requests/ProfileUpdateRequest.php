<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // Taula aldatu dugunez, arauak ere aldatuko dira:
            // 'name' => ['required', 'string', 'max:255'],
            'user_izena' => ['required', 'string', 'max:20', Rule::unique(User::class)->ignore($this->user()->id),],
            'izena'      => ['required', 'string', 'max:50'],
            'abizena'    => ['required', 'string', 'max:50'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'nan'        => ['nullable', 'string', 'size:9', Rule::unique(User::class)->ignore($this->user()->id),],
        ];
    }
}
