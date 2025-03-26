<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'private_account' => ['nullable'],
            'username' => ['required', 'string', 'max:22',
            Rule::unique(User::class)->ignore($this->user()->id),],
            'bio'=>['nullable','max:255'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif'], 
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
                
            ],
        ];
    }
}