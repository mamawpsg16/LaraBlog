<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
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
            'title' => ['required','min:5','max:100'],
            'excerpt' => ['required','min:5','max:255'],
            'image' => request()->routeIs('admin.create.post') ? ['required','image'] : ['image'],
            'body' => ['required','min:5','max:255'],
            'category_id' => ['required',Rule::exists('categories','id')]
        ];
    }
}
