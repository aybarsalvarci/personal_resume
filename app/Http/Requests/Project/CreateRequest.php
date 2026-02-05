<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'slug' => 'nullable|string|max:150',
            'description' => 'required|string',
            'icon' => 'required|string|max:150',
            'link' => 'nullable|url|string|max:255',
            'category_id' => 'required|integer|exists:project_categories,id',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,jpg,png,webp|max:4096',
            'isFeatured' => 'required|boolean',
            'keys' => 'nullable|string|max:255',
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'isFeatured' => $this->input('isFeatured') ? true : false,
        ]);
    }
}
