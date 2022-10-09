<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username' => [
                'required',
                'min:4',
                'max:255',
                Rule::unique('users')->ignore(auth()->id())
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore(auth()->id())

            ],
            'name' => ['required','max:255'],
            'image' =>  ['sometimes'],
            'date_of_birth' =>  ['required'],
            'contact_number' => ['required','min:11','max:30'],
            'address' => ['sometimes','max:255']
        ];
    }
}
