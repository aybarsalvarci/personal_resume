@extends('admin.layouts.master')

@section('title', 'Yeni Blog Yazısı Ekle')

@push('css')
    <style>
        /* Dosya Yükleme Alanı Animasyonları */
        .custom-file-container:hover {
            border-color: #6366f1 !important;
            background-color: rgba(99, 102, 241, 0.05) !important;
            transition: all 0.3s ease;
        }

        #image-preview {
            transition: transform 0.3s ease;
            max-height: 250px;
            object-fit: cover;
            border: 2px solid #3f475e;
        }

        /* Dark mode form kontrolleri */
        .form-control:focus {
            background-color: #32374a;
            color: #fff;
            border-color: #6366f1;
            box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.25);
        }

        .tox-tinymce {
            border: 1px solid #3f475e !important;
            border-radius: 12px !important;
        }

        /* Geçersiz geri bildirim stili */
        .invalid-feedback-custom {
            display: flex;
            align-items: center;
            color: #ff4d4d;
            font-size: 0.85rem;
            margin-top: 8px;
            padding: 5px 10px;
            border-radius: 6px;
            background: rgba(255, 77, 77, 0.1);
            border-left: 3px solid #ff4d4d;
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-5px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .input-group-text {
            background-color: #3f475e !important;
            border-color: #3f475e !important;
            color: #94a3b8;
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2394a3b8' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 16px 12px;
        }
    </style>
@endpush

@section('breadcrumb-title', 'Blog Yönetimi')
@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.projects.index')}}">Bloglar</a></li>
    <li class="breadcrumb-item active">Yeni Yazı</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-8">
                        <div class="card shadow-lg" style="background-color: #1a1e2b; border: 1px solid #2d3244; border-radius: 12px;">
                            <div class="card-header border-0" style="background-color: rgba(255,255,255,0.03); padding: 1.5rem;">
                                <h3 class="card-title text-white font-weight-bold mb-0">
                                    <i class="fas fa-pen-nib mr-2 text-primary"></i> Blog İçeriği
                                </h3>
                            </div>
                            <div class="card-body p-4">
                                <div class="form-group mb-4">
                                    <label class="text-white-50 small text-uppercase mb-2" style="letter-spacing: 1px;">Yazı Başlığı</label>
                                    <input type="text" name="title" id="title"
                                           class="form-control border-secondary text-white @error('title') is-invalid @enderror"
                                           placeholder="Makale başlığını girin..."
                                           style="background-color: #2d3244; border-radius: 8px; padding: 12px;"
                                           required value="{{old('title')}}">
                                    @error('title')
                                    <div class="invalid-feedback-custom"><i class="fas fa-exclamation-circle mr-1"></i><span>{{ $message }}</span></div>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label class="text-white-50 small text-uppercase mb-2" style="letter-spacing: 1px;">Slug (URL)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text small">/blog/</span>
                                        </div>
                                        <input type="text" name="slug" id="slug"
                                               class="form-control border-secondary text-white @error('slug') is-invalid @enderror"
                                               placeholder="yazi-url-adresi"
                                               style="background-color: #2d3244;"
                                               value="{{old('slug')}}">
                                    </div>
                                    @error('slug')
                                    <div class="invalid-feedback-custom"><i class="fas fa-exclamation-circle mr-1"></i><span>{{ $message }}</span></div>
                                    @enderror
                                </div>

                                <div class="form-group mb-0">
                                    <label class="text-white-50 small text-uppercase mb-2" style="letter-spacing: 1px;">Makale İçeriği</label>
                                    <textarea name="content" id="editor" class="@error('content') is-invalid @enderror">{!! old('content') !!}</textarea>
                                    @error('content')
                                    <div class="invalid-feedback-custom"><i class="fas fa-exclamation-circle mr-1"></i><span>{{ $message }}</span></div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card shadow-lg mb-4" style="background-color: #1a1e2b; border: 1px solid #2d3244; border-radius: 12px;">
                            <div class="card-body p-4">
                                <div class="form-group mb-4">
                                    <label class="text-white-50 small text-uppercase mb-2" style="letter-spacing: 1px;">Yayın Durumu</label>
                                    <select name="status" class="form-control border-secondary text-white" style="background-color: #2d3244; border-radius: 8px;">
                                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Yayında (Public)</option>
                                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }} selected>Taslak (Draft)</option>
                                    </select>
                                </div>

                                <div class="form-group mb-4">
                                    <label class="text-white-50 small text-uppercase mb-2" style="letter-spacing: 1px;">Kategori</label>
                                    <select name="category_id" class="form-control border-secondary text-white @error('category_id') is-invalid @enderror" style="background-color: #2d3244; border-radius: 8px;">
                                        <option disabled selected>Kategori seçiniz...</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{old('category_id') == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <div class="invalid-feedback-custom"><i class="fas fa-exclamation-circle mr-1"></i><span>{{ $message }}</span></div>
                                    @enderror
                                </div>

                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success mb-4">
                                    <input type="checkbox" name="isFeatured" class="custom-control-input" id="isFeatured" value="1" {{ old('isFeatured') ? 'checked' : '' }}>
                                    <label class="custom-control-label text-white font-weight-normal" for="isFeatured">Öne Çıkan Yazı</label>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block shadow-lg rounded-pill font-weight-bold py-2">
                                    <i class="fas fa-save mr-2"></i> Kaydet ve Yayınla
                                </button>
                                <a href="{{ route('admin.projects.index') }}" class="btn btn-link btn-block text-muted mt-2 small">Vazgeç</a>
                            </div>
                        </div>

                        <div class="card shadow-lg mb-4" style="background-color: #1a1e2b; border: 1px solid #2d3244; border-radius: 12px;">
                            <div class="card-body p-4">
                                <label class="text-white-50 small text-uppercase mb-3 d-block" style="letter-spacing: 1px;">Kapak Görseli</label>
                                <div class="custom-file-container" style="background-color: #2d3244; border: 2px dashed #3f475e; border-radius: 12px; padding: 20px; text-align: center;">
                                    <input type="file" name="image" id="image-input" class="d-none" accept="image/*">
                                    <label for="image-input" style="cursor: pointer;" class="m-0 d-block">
                                        <div id="image-placeholder">
                                            <i class="fas fa-image fa-2x text-primary mb-2"></i>
                                            <p class="text-white small mb-0 font-weight-bold">Görsel Seç</p>
                                        </div>
                                        <img id="image-preview" src="#" alt="Önizleme" class="img-fluid rounded d-none mx-auto">
                                    </label>
                                </div>
                                @error('image')
                                <div class="invalid-feedback-custom"><i class="fas fa-exclamation-circle mr-1"></i><span>{{ $message }}</span></div>
                                @enderror
                            </div>
                        </div>

                        <div class="card shadow-lg" style="background-color: #1a1e2b; border: 1px solid #2d3244; border-radius: 12px;">
                            <div class="card-body p-4">
                                <label class="text-white-50 small text-uppercase mb-3 d-block" style="letter-spacing: 1px;">SEO Ayarları</label>

                                <div class="form-group mb-3">
                                    <label class="text-muted small">Meta Açıklama</label>
                                    <textarea name="meta_description" rows="3" class="form-control border-secondary text-white small"
                                              placeholder="SEO özeti..." style="background-color: #2d3244;">{{ old('meta_description') }}</textarea>
                                </div>

                                <div class="form-group mb-0">
                                    <label class="text-muted small">Anahtar Kelimeler</label>
                                    <input type="text" name="meta_keywords" class="form-control border-secondary text-white small"
                                           placeholder="virgül, ile, ayırın" style="background-color: #2d3244;" value="{{ old('meta_keywords') }}">
                                </div>
                            </div>
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
            // --- Slug Oluşturucu ---
            function convertToSlug(text) {
                const trMap = {'ç':'c','Ç':'C','ğ':'g','Ğ':'G','ş':'s','Ş':'S','ü':'u','Ü':'U','ı':'i','İ':'I','ö':'o','Ö':'O'};
                for (let key in trMap) { text = text.replace(new RegExp(key, 'g'), trMap[key]); }
                return text.toLowerCase().replace(/[^-a-zA-Z0-9\s]+/g, '').replace(/\s+/g, '-').replace(/-+/g, '-').trim();
            }

            $('#title').on('keyup', function() {
                $('#slug').val(convertToSlug($(this).val()));
            });

            // --- TinyMCE Dark Mode ---
            tinymce.init({
                selector: '#editor',
                language: 'tr',
                height: 600,
                skin: 'oxide-dark',
                content_css: 'dark',
                plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table wordcount',
                toolbar: 'undo redo | blocks | bold italic forecolor | alignleft aligncenter alignright | bullist numlist | link image | removeformat',
                branding: false,
                promotion: false,
                relative_urls: false,
                images_upload_handler: function (blobInfo, progress) {
                    return new Promise((resolve, reject) => {
                        const formData = new FormData();
                        formData.append('file', blobInfo.blob(), blobInfo.filename());
                        formData.append('_token', '{{ csrf_token() }}');
                        $.ajax({
                            url: '{{ route("admin.blogs.file-upload") }}',
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: (json) => {
                                resolve(json.location);
                                console.log(json);
                            },
                            error: (err) => reject('Yükleme hatası')
                        });
                    });
                }
            });

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
