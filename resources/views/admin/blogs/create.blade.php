@extends('admin.layouts.master')

@section('title', 'Yeni Proje Ekle')

@push('css')
    <style>
        /* Dosya Yükleme Alanı Animasyonları */
        .custom-file-container:hover {
            border-color: #3498db !important;
            background-color: rgba(52, 152, 219, 0.05) !important;
            transition: all 0.3s ease;
        }

        #image-preview {
            transition: transform 0.3s ease;
            max-width: 100%;
            border: 2px solid #3f475e;
        }

        .input-group-text {
            min-width: 45px;
            justify-content: center;
        }

        /* Dark mode form kontrolleri için ek düzeltme */
        .form-control:focus {
            background-color: #32374a;
            color: #fff;
            border-color: #3498db;
            box-shadow: none;
        }

        .tox-tinymce {
            border: 1px solid #3f475e !important;
            border-radius: 8px !important;
        }

        /* Geçersiz geri bildirim stili */
        .invalid-feedback-custom {
            color: #e74c3c;
            font-size: 0.85rem;
            margin-top: 5px;
            display: block;
        }
    </style>
@endpush

@section('breadcrumb-title', 'Yeni Proje')
@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.projects.index')}}">Projeler</a></li>
    <li class="breadcrumb-item active">Yeni Ekle</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-11 mx-auto">
            <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card shadow-lg"
                     style="background-color: #1a1e2b; border: 1px solid #2d3244; border-radius: 12px;">
                    <div class="card-header border-0"
                         style="background-color: rgba(255,255,255,0.03); padding: 1.5rem;">
                        <h3 class="card-title text-white font-weight-bold">
                            <i class="fas fa-plus-circle mr-2 text-primary"></i> Yeni Proje Detayları
                        </h3>
                    </div>

                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="text-white-50 small text-uppercase mb-2" style="letter-spacing: 1px;">Proje Adı</label>
                                            <input type="text" name="name" id="name"
                                                   class="form-control border-secondary text-white @error('name') is-invalid @enderror"
                                                   placeholder="Örn: Kurumsal Web Tasarım"
                                                   style="background-color: #2d3244; border-radius: 8px; padding: 12px;"
                                                   required value="{{old('name')}}">
                                            @error('name')
                                            <div class="invalid-feedback-custom"><i class="fas fa-exclamation-circle mr-1"></i><span>{{ $message }}</span></div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="text-white-50 small text-uppercase mb-2" style="letter-spacing: 1px;">Slug (URL)</label>
                                            <input type="text" name="slug" id="slug"
                                                   class="form-control border-secondary text-white @error('slug') is-invalid @enderror"
                                                   placeholder="kurumsal-web-tasarim"
                                                   style="background-color: #2d3244; border-radius: 8px; padding: 12px;"
                                                   value="{{old('slug')}}">
                                            @error('slug')
                                            <div class="invalid-feedback-custom"><i class="fas fa-exclamation-circle mr-1"></i><span>{{ $message }}</span></div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label class="text-white-50 small text-uppercase mb-2" style="letter-spacing: 1px;">Proje Açıklaması</label>
                                    <textarea name="description" id="editor"
                                              class="form-control border-secondary text-white shadow-sm @error('description') is-invalid @enderror"
                                              placeholder="Proje hakkında detaylı bilgi girin...">{!! old('description') !!}</textarea>
                                    @error('description')
                                    <div class="invalid-feedback-custom"><i class="fas fa-exclamation-circle mr-1"></i><span>{{ $message }}</span></div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="text-white-50 small text-uppercase mb-2" style="letter-spacing: 1px;">İkon (FontAwesome)</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text border-secondary text-primary" style="background-color: #3f475e;">
                                                        <i id="icon-preview" class="fas fa-rocket"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="icon" id="icon-input"
                                                       class="form-control border-secondary text-white @error('icon') is-invalid @enderror"
                                                       placeholder="fas fa-rocket" style="background-color: #2d3244;" value="{{old('icon')}}">
                                            </div>
                                            @error('icon')
                                            <div class="invalid-feedback-custom"><i class="fas fa-exclamation-circle mr-1"></i><span>{{ $message }}</span></div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="text-white-50 small text-uppercase mb-2" style="letter-spacing: 1px;">Proje Linki</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text border-secondary text-white-50" style="background-color: #3f475e;"><i class="fas fa-link"></i></span>
                                                </div>
                                                <input type="url" name="link"
                                                       class="form-control border-secondary text-white @error('link') is-invalid @enderror"
                                                       placeholder="https://site.com"
                                                       style="background-color: #2d3244;" value="{{old('link')}}">
                                            </div>
                                            @error('link')
                                            <div class="invalid-feedback-custom"><i class="fas fa-exclamation-circle mr-1"></i><span>{{ $message }}</span></div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label class="text-white-50 small text-uppercase mb-2" style="letter-spacing: 1px;">Anahtar Özellikler (Keys)</label>
                                    <input type="text" name="keys"
                                           class="form-control border-secondary text-white @error('keys') is-invalid @enderror"
                                           placeholder="Örn: Laravel, Vue.js, MySQL (Virgül ile ayırın)"
                                           style="background-color: #2d3244; border-radius: 8px; padding: 12px;"
                                           value="{{old('keys')}}">
                                    <small class="text-muted">Projenin öne çıkan teknolojilerini veya özelliklerini girin.</small>
                                    @error('keys')
                                    <div class="invalid-feedback-custom"><i class="fas fa-exclamation-circle mr-1"></i><span>{{ $message }}</span></div>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label class="text-white-50 small text-uppercase mb-2" style="letter-spacing: 1px;">Kapak Görseli</label>
                                    <div class="custom-file-container" style="background-color: #2d3244; border: 2px dashed #3f475e; border-radius: 12px; padding: 30px; text-align: center;">
                                        <input type="file" name="image" id="image-input" class="d-none" accept="image/*">
                                        <label for="image-input" style="cursor: pointer;" class="m-0 d-block">
                                            <div id="image-placeholder">
                                                <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                                                <p class="text-white mb-1 font-weight-bold">Tıkla veya Görseli Sürükle</p>
                                                <p class="text-muted small">PNG, JPG (Önerilen: 1200x800px)</p>
                                            </div>
                                            <img id="image-preview" src="#" alt="Önizleme" class="img-fluid rounded d-none mx-auto">
                                        </label>
                                    </div>
                                    @error('image')
                                    <div class="invalid-feedback-custom"><i class="fas fa-exclamation-circle mr-1"></i><span>{{ $message }}</span></div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="p-3 rounded mb-4" style="background-color: rgba(255,255,255,0.02); border: 1px solid #2d3244;">
                                    <label class="text-white-50 small text-uppercase mb-3 d-block" style="letter-spacing: 1px;">Durum & Kategori</label>

                                    <div class="form-group">
                                        <label class="text-white-50 small">Kategori Seçimi</label>
                                        <select name="category_id" class="form-control border-secondary text-white @error('category_id') is-invalid @enderror" style="background-color: #2d3244;">
                                            <option disabled selected>Kategori seçiniz...</option>
                                            @foreach($categories as $category)
                                                <option {{$category->id == old('category_id') ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <div class="invalid-feedback-custom"><i class="fas fa-exclamation-circle mr-1"></i><span>{{ $message }}</span></div>
                                        @enderror
                                    </div>

                                    <hr style="border-top: 1px solid #2d3244;">

                                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success my-3">
                                        <input type="checkbox" name="isFeatured" class="custom-control-input" id="isFeatured" value="1" {{ old('isFeatured') ? 'checked' : '' }}>
                                        <label class="custom-control-label text-white font-weight-normal" for="isFeatured">Öne Çıkan Proje</label>
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label class="text-white-50 small text-uppercase mb-2" style="letter-spacing: 1px;">SEO Meta Açıklama</label>
                                    <textarea name="meta_description" rows="3" class="form-control border-secondary text-white @error('meta_description') is-invalid @enderror"
                                              placeholder="Arama sonuçlarında görünecek kısa özet..."
                                              style="background-color: #2d3244;">{{ old('meta_description') }}</textarea>
                                    <small class="text-muted">Önerilen: 150-160 karakter.</small>
                                    @error('meta_description')
                                    <div class="invalid-feedback-custom"><i class="fas fa-exclamation-circle mr-1"></i><span>{{ $message }}</span></div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label class="text-white-50 small text-uppercase mb-2" style="letter-spacing: 1px;">SEO Meta Keywords</label>
                                    <textarea name="meta_keywords" rows="3" class="form-control border-secondary text-white @error('meta_keywords') is-invalid @enderror"
                                              placeholder="kelime1, kelime2, kelime3"
                                              style="background-color: #2d3244;">{{ old('meta_keywords') }}</textarea>
                                    @error('meta_keywords')
                                    <div class="invalid-feedback-custom"><i class="fas fa-exclamation-circle mr-1"></i><span>{{ $message }}</span></div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer border-0 p-4" style="background-color: #161a25; border-top: 1px solid #2d3244 !important;">
                        <div class="d-flex justify-content-end align-items-center">
                            <a href="{{ route('admin.projects.index') }}" class="btn btn-link text-muted mr-3">Vazgeç</a>
                            <button type="submit" class="btn btn-primary px-5 shadow-lg rounded-pill font-weight-bold">
                                <i class="fas fa-save mr-2"></i> Kaydet ve Yayınla
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js"></script>
    <script>
        $(document).ready(function () {
            // --- Slug Oluşturucu Fonksiyon ---
            function convertToSlug(text) {
                const trMap = {
                    'ç': 'c', 'Ç': 'C', 'ğ': 'g', 'Ğ': 'G', 'ş': 's', 'Ş': 'S',
                    'ü': 'u', 'Ü': 'U', 'ı': 'i', 'İ': 'I', 'ö': 'o', 'Ö': 'O'
                };
                for (let key in trMap) {
                    text = text.replace(new RegExp(key, 'g'), trMap[key]);
                }
                return text.toLowerCase()
                    .replace(/[^-a-zA-Z0-9\s]+/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-')
                    .trim();
            }

            // Name alanından Slug alanını doldur
            $('#name').on('keyup', function() {
                $('#slug').val(convertToSlug($(this).val()));
            });

            // --- TinyMCE 6+ Yapılandırması ---
            tinymce.init({
                selector: '#editor',
                language: 'tr',
                height: 450,
                skin: 'oxide-dark',
                content_css: 'dark',
                branding: false,
                elementpath: false,
                plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table code help wordcount',
                toolbar: 'undo redo | blocks | bold italic forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | removeformat | code',
                images_upload_handler: function (blobInfo, progress) {
                    return new Promise((resolve, reject) => {
                        const xhr = new XMLHttpRequest();
                        xhr.open('POST', '{{ route("admin.projects.file-upload") }}');
                        xhr.upload.onprogress = (e) => progress(e.loaded / e.total * 100);
                        xhr.onload = () => {
                            if (xhr.status < 200 || xhr.status >= 300) { reject({message: 'Hata: ' + xhr.status}); return; }
                            const json = JSON.parse(xhr.responseText);
                            if (!json || typeof json.location != 'string') { reject('Geçersiz yanıt'); return; }
                            resolve(json.location);
                        };
                        const formData = new FormData();
                        formData.append('file', blobInfo.blob(), blobInfo.filename());
                        formData.append('_token', '{{ csrf_token() }}');
                        xhr.send(formData);
                    });
                },
                relative_urls: false,
                remove_script_host: false,
                convert_urls: true
            });

            // --- İkon Önizleme ---
            function updateIconPreview() {
                const iconInput = $('#icon-input').val().trim();
                $('#icon-preview').attr('class', iconInput || 'fas fa-rocket');
            }
            $('#icon-input').on('keyup input', updateIconPreview);
            updateIconPreview();

            // --- Görsel Önizleme ---
            $('#image-input').on('change', function () {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        $('#image-placeholder').addClass('d-none');
                        $('#image-preview').attr('src', e.target.result).removeClass('d-none');
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endpush
