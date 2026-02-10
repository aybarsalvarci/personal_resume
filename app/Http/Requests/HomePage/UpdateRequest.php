<?php

namespace App\Http\Requests\HomePage;

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
            "hero_badge" => "required|string|max:255",
            "hero_title" => "required|string|max:70",
            "hero_subtitle" => "required|string|max:70",
            "hero_description" => "required|string|max:255",

            "term_cmd" => "required|array",
            "term_cmd.*" => "required|string|max:70",
            "term_out" => "required|array",
            "term_out.*" => "required|string|max:70",

            "stat_val" => "required|array",
            "stat_val.*" => "required|string|max:70",
            "stat_label" => "required|array",
            "stat_label.*" => "required|string|max:70",

            "tech_icon" => "required|array",
            "tech_icon.*" => "required|string|max:70",
            "tech_title" => "required|array",
            "tech_title.*" => "required|string|max:70",
            "tech_description" => "required|array",
            "tech_description.*" => "required|string|max:70",
            "tech_tags" => "required|array",
            "tech_tags.*" => "required|string|max:70",

            "principles" => "required|array",
            "principles.*" => "required|string|max:70",

            "about_subtitle" => "required|string|max:200",
            "about_learning" => "required|string|max:255",
            "about_technical_desc" => "required|string|max:255",
            "about_learning_tags" => "required|string|max:255",
            "about_skills_list" => "required|array",
            "about_skills_list.*" => "required|string|max:150",

            'setup_os' => "required|string|max:40",
            'setup_editor' => "required|string|max:100",
            'setup_terminal' => "required|string|max:100",
            'setup_db' => "required|string|max:100",
        ];
    }

    public function messages(): array
    {
        return [
            // Hero Bölümü
            'hero_badge.required' => 'Hero rozeti alanı boş bırakılamaz.',
            'hero_badge.max' => 'Hero rozeti en fazla 255 karakter olabilir.',
            'hero_title.required' => 'Hero başlığı zorunludur.',
            'hero_title.max' => 'Hero başlığı 70 karakteri geçmemelidir.',
            'hero_subtitle.required' => 'Hero alt başlığı gereklidir.',
            'hero_subtitle.max' => 'Hero alt başlığı 70 karakterden uzun olamaz.',
            'hero_description.required' => 'Açıklama alanı doldurulmalıdır.',
            'hero_description.max' => 'Açıklama en fazla 255 karakter olabilir.',

            // Terminal Komutları (Array)
            'term_cmd.required' => 'En az bir terminal komutu eklemelisiniz.',
            'term_cmd.*.required' => 'Terminal komutu boş olamaz.',
            'term_cmd.*.max' => 'Terminal komutu en fazla 70 karakter olabilir.',

            // Terminal çıktıları (array)
            'term_out.required' => 'En az bir terminal çıktı eklemelisiniz.',
            'term_out.*.required' => 'Terminal çıktısı boş olamaz.',
            'term_out.*.max' => 'Terminal çıktısı en fazla 70 karakter olabilir.',

            // İstatistikler (Array)
            'stat_val.required' => 'İstatistik değerleri eksik.',
            'stat_val.*.required' => 'İstatistik değeri boş bırakılamaz.',
            'stat_val.*.max' => 'İstatistik değeri 70 karakterden uzun olamaz.',

            'stat_label.required' => 'İstatistik etiketleri eksik.',
            'stat_label.*.required' => 'İstatistik etiketi boş olamaz.',
            'stat_label.*.max' => 'İstatistik etiketi en fazla 70 karakter olabilir.',

            // Teknoloji Bölümü (Array)
            'tech_icon.*.required' => 'Teknoloji ikonu seçilmelidir.',
            'tech_title.*.required' => 'Teknoloji başlığı boş geçilemez.',
            'tech_description.*.required' => 'Teknoloji açıklaması gereklidir.',
            'tech_tags.*.required' => 'Teknoloji etiketleri girilmelidir.',
            'tech_tags.*.max' => 'Her bir etiket en fazla 70 karakter olabilir.',

            // İlkeler (Array)
            'principles.required' => 'İlkeler listesi boş olamaz.',
            'principles.*.required' => 'İlke metni doldurulmalıdır.',
            'principles.*.max' => 'Her bir ilke 70 karakteri aşmamalıdır.',
        ];
    }
}
