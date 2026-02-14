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
            'setup_containerization' => "required|string|max:100",
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

            // Terminal Komutları ve Çıktıları
            'term_cmd.required' => 'En az bir terminal komutu eklemelisiniz.',
            'term_cmd.*.required' => 'Terminal komutu boş olamaz.',
            'term_cmd.*.max' => 'Terminal komutu en fazla 70 karakter olabilir.',
            'term_out.required' => 'En az bir terminal çıktısı eklemelisiniz.',
            'term_out.*.required' => 'Terminal çıktısı boş olamaz.',
            'term_out.*.max' => 'Terminal çıktısı en fazla 70 karakter olabilir.',

            // İstatistikler
            'stat_val.required' => 'İstatistik değerleri eksik.',
            'stat_val.*.required' => 'İstatistik değeri boş bırakılamaz.',
            'stat_val.*.max' => 'İstatistik değeri 70 karakterden uzun olamaz.',
            'stat_label.required' => 'İstatistik etiketleri eksik.',
            'stat_label.*.required' => 'İstatistik etiketi boş olamaz.',
            'stat_label.*.max' => 'İstatistik etiketi en fazla 70 karakter olabilir.',

            // Teknolojiler
            'tech_icon.*.required' => 'Teknoloji ikonu seçilmelidir.',
            'tech_title.*.required' => 'Teknoloji başlığı boş geçilemez.',
            'tech_description.*.required' => 'Teknoloji açıklaması gereklidir.',
            'tech_tags.*.required' => 'Teknoloji etiketleri girilmelidir.',
            'tech_tags.*.max' => 'Her bir etiket en fazla 70 karakter olabilir.',

            // İlkeler
            'principles.required' => 'İlkeler listesi boş olamaz.',
            'principles.*.required' => 'İlke metni doldurulmalıdır.',
            'principles.*.max' => 'Her bir ilke 70 karakteri aşmamalıdır.',

            // Hakkımda (About) Bölümü
            'about_subtitle.required' => 'Hakkımda alt başlığı zorunludur.',
            'about_subtitle.max' => 'Hakkımda alt başlığı 200 karakteri geçmemelidir.',
            'about_learning.required' => 'Öğrenilen teknolojiler alanı zorunludur.',
            'about_learning.max' => 'Öğrenilen teknolojiler en fazla 255 karakter olabilir.',
            'about_technical_desc.required' => 'Teknik açıklama alanı zorunludur.',
            'about_technical_desc.max' => 'Teknik açıklama 255 karakteri geçmemelidir.',
            'about_learning_tags.required' => 'Öğrenme etiketleri zorunludur.',
            'about_learning_tags.max' => 'Etiketler alanı en fazla 255 karakter olabilir.',
            'about_skills_list.required' => 'Yetenek listesi boş bırakılamaz.',
            'about_skills_list.*.required' => 'Yetenek maddesi boş olamaz.',
            'about_skills_list.*.max' => 'Yetenek maddesi en fazla 150 karakter olabilir.',

            // Kurulum (Setup) Bölümü
            'setup_os.required' => 'İşletim sistemi bilgisi zorunludur.',
            'setup_os.max' => 'İşletim sistemi alanı 40 karakteri geçmemelidir.',
            'setup_editor.required' => 'Editör bilgisi zorunludur.',
            'setup_editor.max' => 'Editör alanı 100 karakteri geçmemelidir.',
            'setup_terminal.required' => 'Terminal bilgisi zorunludur.',
            'setup_terminal.max' => 'Terminal alanı 100 karakteri geçmemelidir.',
            'setup_db.required' => 'Veritabanı bilgisi zorunludur.',
            'setup_db.max' => 'Veritabanı alanı 100 karakteri geçmemelidir.',
            'setup_containerization.required' => 'Konteynerleştirme bilgisi zorunludur.',
            'setup_containerization.max' => 'Bu alan 100 karakteri geçmemelidir.',
        ];
    }
}
