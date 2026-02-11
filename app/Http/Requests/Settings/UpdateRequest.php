<?php

namespace App\Http\Requests\Settings;

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
            "title" => "required|string|max:255",
            "email" => "required|email:rfc,dns|max:150",
            "working_hours" => "required|string|max:100",
            "address" => "required|string|max:255",

            "github" => "required|string|max:255",
            "twitter" => "required|url|max:255",
            "linkedin" => "required|url|max:255",
            "instagram" => "required|url|max:255",

            "footer_description" => "required|string|max:500",
            "footer_text" => "required|string|max:255",

            "meta_author" => "required|string|max:255",
            "meta_keywords" => "nullable|string|max:500",
            "meta_description" => "required|string|max:500",

            "logo_dark" => "nullable|image|mimes:png,svg,webp|max:4096",
            "logo_light" => "nullable|image|mimes:png,svg,webp|max:4096",

            "favicon" => "nullable|mimes:png,ico|max:1024",
            "favicon32x32" => "nullable|image|mimes:png|max:1024",
            "favicon16x16" => "nullable|image|mimes:png|max:1024",
            "apple_touch_icon" => "nullable|image|mimes:png|max:2048",

            "mask_icon" => "nullable|mimes:svg|max:1024",

        ];

    }
}
