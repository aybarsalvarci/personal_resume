<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title' => 'required|max:150',
            'content' => 'required|string',
            'category_id' => 'required|exists:blog_categories,id',
            'status' => 'required|string|in:published,draft',
            'isFeatured' => 'required|boolean',
            'meta_description' => 'nullable|string|max:180',
            'meta_keywords' => 'nullable|string|max:180',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'isFeatured' => $this->input('isFeatured') ?? false,
        ]);
    }
}
