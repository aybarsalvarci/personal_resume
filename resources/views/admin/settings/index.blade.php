@extends('admin.layouts.master')

@section('title', 'Genel Ayarlar')

@push('css')
    <style>
        .custom-file-container:hover {
            border-color: #3498db !important;
            background-color: rgba(52, 152, 219, 0.05) !important;
            transition: all 0.3s ease;
        }
        .img-preview {
            transition: transform 0.3s ease;
            max-width: 100%;
            max-height: 100px; /* Faviconlar küçük olduğu için yüksekliği kıstım */
            object-fit: contain;
            background-color: rgba(255,255,255,0.05);
            border: 1px solid #3f475e;
            padding: 5px;
            margin-top: 10px;
        }
        .input-group-text { min-width: 45px; justify-content: center; background-color: #3f475e; border-color: #3f475e; color: #a6b0cf; }
        .form-control:focus { background-color: #32374a; color: #fff; border-color: #3498db; box-shadow: none; }
        .section-title { border-bottom: 1px solid #2d3244; padding-bottom: 10px; margin-bottom: 20px; color: #3498db; font-size: 1rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; }
        .file-status-badge { font-size: 0.75rem; padding: 3px 8px; border-radius: 4px; background: rgba(16, 185, 129, 0.2); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.3); display: inline-block; margin-bottom: 5px;}
    </style>
@endpush

@section('breadcrumb-title', 'Genel Ayarlar')
@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Ayarlar</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <form action="{{ route('admin.settings.update', $settings->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card shadow-lg" style="background-color: #1a1e2b; border: 1px solid #2d3244; border-radius: 12px;">
                    <div class="card-header border-0" style="background-color: rgba(255,255,255,0.03); padding: 1.5rem;">
                        <h3 class="card-title text-white font-weight-bold">
                            <i class="fas fa-sliders-h mr-2 text-primary"></i> Site Yapılandırması
                        </h3>
                    </div>

                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-7">

                                <h5 class="section-title"><i class="fas fa-globe mr-2"></i>Genel Bilgiler</h5>
                                <div class="form-group mb-4">
                                    <label class="text-white-50 small text-uppercase mb-2">Site Başlığı (Title)</label>
                                    <input type="text" name="title" class="form-control border-secondary text-white"
                                           style="background-color: #2d3244;"
                                           required value="{{ old('title', $settings->title ?? '') }}">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="text-white-50 small text-uppercase mb-2">E-Posta</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-envelope"></i></span></div>
                                                <input type="email" name="email" class="form-control border-secondary text-white" style="background-color: #2d3244;"
                                                       value="{{ old('email', $settings->email ?? '') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="text-white-50 small text-uppercase mb-2">Çalışma Saatleri</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-clock"></i></span></div>
                                                <input type="text" name="working_hours" class="form-control border-secondary text-white" style="background-color: #2d3244;"
                                                       value="{{ old('working_hours', $settings->working_hours ?? '') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label class="text-white-50 small text-uppercase mb-2">Adres</label>
                                    <textarea name="address" rows="2" class="form-control border-secondary text-white" style="background-color: #2d3244;">{{ old('address', $settings->address ?? '') }}</textarea>
                                </div>

                                <h5 class="section-title mt-5"><i class="fas fa-share-alt mr-2"></i>Sosyal Medya</h5>
                                <div class="row">
                                    @foreach(['github' => 'fab fa-github', 'twitter' => 'fab fa-twitter', 'linkedin' => 'fab fa-linkedin', 'instagram' => 'fab fa-instagram'] as $key => $icon)
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="text-white-50 small mb-1 text-uppercase">{{ ucfirst($key) }}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i class="{{ $icon }}"></i></span></div>
                                                    <input type="url" name="{{ $key }}" class="form-control border-secondary text-white" style="background-color: #2d3244;" value="{{ old($key, $settings->$key ?? '') }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <h5 class="section-title mt-5"><i class="fas fa-shoe-prints mr-2"></i>Footer Ayarları</h5>
                                <div class="form-group mb-4">
                                    <label class="text-white-50 small text-uppercase mb-2">Footer Açıklama</label>
                                    <textarea name="footer_description" rows="3" class="form-control border-secondary text-white" style="background-color: #2d3244;">{{ old('footer_description', $settings->footer_description ?? '') }}</textarea>
                                </div>
                                <div class="form-group mb-4">
                                    <label class="text-white-50 small text-uppercase mb-2">Copyright Metni</label>
                                    <input type="text" name="footer_text" class="form-control border-secondary text-white"
                                           style="background-color: #2d3244;"
                                           value="{{ old('footer_text', $settings->footer_text ?? '') }}">
                                </div>
                            </div>

                            <div class="col-md-5">

                                <h5 class="section-title"><i class="fas fa-image mr-2"></i>Ana Logolar</h5>
                                <div class="row">
                                    @foreach(['header_logo' => 'Header Logo', 'footer_logo' => 'Footer Logo'] as $field => $label)
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="text-white-50 small mb-1">{{ $label }}</label>
                                                <div class="custom-file-container p-2" style="background-color: #2d3244; border: 1px dashed #3f475e; border-radius: 8px; text-align: center;">
                                                    <input type="file" name="{{ $field }}" id="{{ $field }}" class="d-none image-upload-input" data-preview="#{{ $field }}_preview">
                                                    <label for="{{ $field }}" style="cursor: pointer; width: 100%; margin: 0;">
                                                        <img id="{{ $field }}_preview"
                                                             src="{{ isset($settings->$field) ? asset($settings->$field) : asset('front/img/placeholder.png') }}"
                                                             alt="Önizleme"
                                                             class="img-preview rounded">
                                                        <div class="mt-2 text-primary small">Değiştir <i class="fas fa-upload ml-1"></i></div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <h5 class="section-title mt-4"><i class="fas fa-icons mr-2"></i>Favicon Seti</h5>
                                <div class="row">
                                    {{-- GÖRSEL OLANLAR --}}
                                    @foreach([
                                        'favicon' => 'Standard Favicon (.ico)',
                                        'favicon32x32' => 'Favicon 32x32 (.png)',
                                        'favicon16x16' => 'Favicon 16x16 (.png)',
                                        'apple_touch_icon' => 'Apple Touch Icon (.png)',
                                        'mask_icon' => 'Safari Mask Icon (.svg)'
                                    ] as $field => $label)
                                        <div class="col-md-4 mb-3">
                                            <label class="text-white-50 small mb-1 d-block" style="font-size: 0.7rem;">{{ $label }}</label>
                                            <div class="custom-file-container p-1" style="background-color: #2d3244; border: 1px solid #3f475e; border-radius: 6px; text-align: center;">
                                                <input type="file" name="{{ $field }}" id="{{ $field }}" class="d-none image-upload-input" data-preview="#{{ $field }}_preview">
                                                <label for="{{ $field }}" style="cursor: pointer; margin: 0; width: 100%;">
                                                    <img id="{{ $field }}_preview"
                                                         src="{{ isset($settings->$field) ? asset($settings->$field) : '' }}"
                                                         style="height: 32px; width: 32px; object-fit: contain; display: block; margin: 0 auto;">
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="form-group mt-2">
                                    <label class="text-white-50 small mb-1">Site Manifest (.webmanifest)</label>
                                    <div class="custom-file">
                                        <input type="file" name="manifest" class="custom-file-input" id="manifest">
                                        <label class="custom-file-label bg-dark text-white border-secondary" for="manifest">Dosya Seç</label>
                                    </div>
                                    @if(isset($settings->manifest))
                                        <small class="text-success"><i class="fas fa-check-circle"></i> Yüklü: {{ basename($settings->manifest) }}</small>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="text-white-50 small mb-1">Browser Config (.xml)</label>
                                    <div class="custom-file">
                                        <input type="file" name="browser_config" class="custom-file-input" id="browser_config">
                                        <label class="custom-file-label bg-dark text-white border-secondary" for="browser_config">Dosya Seç</label>
                                    </div>
                                    @if(isset($settings->browser_config))
                                        <small class="text-success"><i class="fas fa-check-circle"></i> Yüklü: {{ basename($settings->browser_config) }}</small>
                                    @endif
                                </div>

                                <h5 class="section-title mt-5"><i class="fas fa-search mr-2"></i>SEO Yapılandırması</h5>

                                <div class="form-group mb-3">
                                    <label class="text-white-50 small text-uppercase mb-2">Yazar (Meta Author)</label>
                                    <input type="text" name="meta_author" class="form-control border-secondary text-white"
                                           style="background-color: #2d3244;"
                                           value="{{ old('meta_author', $settings->meta_author ?? '') }}">
                                </div>

                                <div class="form-group mb-3">
                                    <label class="text-white-50 small text-uppercase mb-2">Meta Description</label>
                                    <textarea name="meta_description" rows="3" class="form-control border-secondary text-white"
                                              style="background-color: #2d3244; font-size: 0.9rem;">{{ old('meta_description', $settings->meta_description ?? '') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label class="text-white-50 small text-uppercase mb-2">Meta Keywords</label>
                                    <textarea name="meta_keywords" rows="3" class="form-control border-secondary text-white"
                                              style="background-color: #2d3244; font-size: 0.9rem;">{{ old('meta_keywords', $settings->meta_keywords ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer border-0 p-4" style="background-color: #161a25; border-top: 1px solid #2d3244 !important;">
                        <div class="d-flex justify-content-end align-items-center">
                            <button type="submit" class="btn btn-primary px-5 shadow-lg rounded-pill font-weight-bold">
                                <i class="fas fa-save mr-2"></i> Ayarları Güncelle
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            // Görsel önizleme
            $('.image-upload-input').on('change', function () {
                const file = this.files[0];
                const previewId = $(this).data('preview');

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        $(previewId).attr('src', e.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Custom file input label güncelleme (Manifest ve XML için)
            $('.custom-file-input').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
            });
        });
    </script>
@endpush
