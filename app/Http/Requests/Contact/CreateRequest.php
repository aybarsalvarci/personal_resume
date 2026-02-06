<?php

namespace App\Http\Requests\Contact;

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
            'name' => 'required|string|min:3|max:60',
            'email' => 'required|string|email:rfc,dns|min:8|max:100',
            'subject' => 'required|string|min:3|max:100',
            'message' => 'required|string|min:3|max:400',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Lütfen adınızı ve soyadınızı yazın.',
            'name.min'      => 'Adınız en az :min karakter olmalıdır.',
            'name.max'      => 'Adınız :max karakterden fazla olamaz.',

            'email.required' => 'E-posta adresi boş bırakılamaz.',
            'email.email'    => 'Lütfen geçerli bir e-posta adresi girin.',
            'email.min'      => 'E-posta adresi çok kısa.',
            'email.max'      => 'E-posta adresi çok uzun.',

            'subject.required' => 'Lütfen mesajınızın konusunu belirtin.',
            'subject.min'      => 'Konu başlığı en az :min karakter olmalıdır.',
            'subject.max'      => 'Konu başlığı çok uzun.',

            'message.required' => 'Mesaj içeriği boş bırakılamaz.',
            'message.min'      => 'Lütfen kendinizi ifade etmek için biraz daha fazla yazın (en az :min karakter).',
            'message.max'      => 'Mesajınız :max karakter sınırını aşıyor.',
        ];
    }
}
