@extends('admin.layouts.master')

@section('title', 'Blog Yazısını Düzenle: ' . $blog->title)

@push('css')
    <style>
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

        .form-control:focus { background-color: #32374a; color: #fff; border-color: #6366f1; }
        .invalid-feedback-custom {
            display: flex; align-items: center; color: #ff4d4d; font-size: 0.85rem;
            margin-top: 8px; padding: 5px 10px; border-radius: 6px;
            background: rgba(255, 77, 77, 0.1); border-left: 3px solid #ff4d4d;
        }
    </style>
@endpush

@section('breadcrumb-title', 'Blog Düzenle')
@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.blogs.index')}}">Bloglar</a></li>
    <li class="breadcrumb-item active">Düzenle</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-8">
                        <div class="card shadow-lg" style="background-color: #1a1e2b; border: 1px solid #2d3244; border-radius: 12px;">
                            <div class="card-header border-0" style="background-color: rgba(255,255,255,0.03); padding: 1.5rem;">
                                <h3 class="card-title text-white font-weight-bold mb-0">
                                    <i class="fas fa-edit mr-2 text-primary"></i> İçeriği Düzenle
                                </h3>
                            </div>
                            <div class="card-body p-4">
                                <div class="form-group mb-4">
                                    <label class="text-white-50 small text-uppercase mb-2">Yazı Başlığı</label>
                                    <input type="text" name="title" id="title"
                                           class="form-control border-secondary text-white @error('title') is-invalid @enderror"
                                           style="background-color: #2d3244;"
                                           required value="{{ old('title', $blog->title) }}">
                                    @error('title')
                                    <div class="invalid-feedback-custom">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label class="text-white-50 small text-uppercase mb-2">Slug (URL)</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text">/blog/</span></div>
                                        <input type="text" id="slug" disabled
                                               class="form-control border-secondary text-white"
                                               style="background-color: #2d3244;"
                                               value="{{ old('slug', $blog->slug) }}">
                                    </div>
                                </div>

                                <div class="form-group mb-0">
                                    <label class="text-white-50 small text-uppercase mb-2">Makale İçeriği</label>
                                    <textarea name="content" id="editor">{{ old('content', $blog->content) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card shadow-lg mb-4" style="background-color: #1a1e2b; border: 1px solid #2d3244; border-radius: 12px;">
                            <div class="card-body p-4">
                                <div class="form-group mb-4">
                                    <label class="text-white-50 small text-uppercase mb-2">Yayın Durumu</label>
                                    <select name="status" class="form-control border-secondary text-white" style="background-color: #2d3244;">
                                        <option value="published" {{ old('status', $blog->status) == 'published' ? 'selected' : '' }}>Yayında (Public)</option>
                                        <option value="draft" {{ old('status', $blog->status) == 'draft' ? 'selected' : '' }}>Taslak (Draft)</option>
                                    </select>
                                </div>

                                <div class="form-group mb-4">
                                    <label class="text-white-50 small text-uppercase mb-2">Kategori</label>
                                    <select name="category_id" class="form-control border-secondary text-white" style="background-color: #2d3244;">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{ old('category_id', $blog->category_id) == $category->id ? 'selected' : '' }}>
                                                {{$category->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="custom-control custom-switch mb-4">
                                    <input type="checkbox" name="isFeatured" class="custom-control-input" id="isFeatured" value="1" {{ old('isFeatured', $blog->isFeatured) ? 'checked' : '' }}>
                                    <label class="custom-control-label text-white" for="isFeatured">Öne Çıkan Yazı</label>
                                </div>

                                <button type="submit" class="btn btn-success btn-block rounded-pill font-weight-bold py-2">
                                    <i class="fas fa-check mr-2"></i> Değişiklikleri Kaydet
                                </button>
                                <a href="{{ route('admin.blogs.index') }}" class="btn btn-link btn-block text-muted mt-2 small">Vazgeç</a>
                            </div>
                        </div>

                        <div class="card shadow-lg mb-4" style="background-color: #1a1e2b; border: 1px solid #2d3244; border-radius: 12px;">
                            <div class="card-body p-4">
                                <label class="text-white-50 small text-uppercase mb-3 d-block">Kapak Görseli</label>
                                <div class="custom-file-container" style="background-color: #2d3244; border: 2px dashed #3f475e; border-radius: 12px; padding: 20px; text-align: center;">
                                    <input type="file" name="image" id="image-input" class="d-none" accept="image/*">
                                    <label for="image-input" style="cursor: pointer;" class="m-0 d-block">
                                        {{-- Eğer görsel varsa önizlemeyi göster, yoksa placeholder'ı göster --}}
                                        <div id="image-placeholder" class="{{ $blog->image ? 'd-none' : '' }}">
                                            <i class="fas fa-image fa-2x text-primary mb-2"></i>
                                            <p class="text-white small mb-0">Görseli Değiştir</p>
                                        </div>
                                        <img id="image-preview" src="{{ $blog->image ? asset(Storage::url($blog->image)) : '#' }}"
                                             alt="Önizleme" class="img-fluid rounded {{ $blog->image ? '' : 'd-none' }} mx-auto">
                                    </label>
                                </div>
                                @error('image')
                                <div class="invalid-feedback-custom">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="card shadow-lg" style="background-color: #1a1e2b; border: 1px solid #2d3244; border-radius: 12px;">
                            <div class="card-body p-4">
                                <label class="text-white-50 small text-uppercase mb-3 d-block">SEO Ayarları</label>
                                <div class="form-group mb-3">
                                    <label class="text-muted small">Meta Açıklama</label>
                                    <textarea name="meta_description" rows="3" class="form-control border-secondary text-white small"
                                              style="background-color: #2d3244;">{{ old('meta_description', $blog->meta_description) }}</textarea>
                                </div>
                                <div class="form-group mb-0">
                                    <label class="text-muted small">Anahtar Kelimeler</label>
                                    <input type="text" name="meta_keywords" class="form-control border-secondary text-white small"
                                           style="background-color: #2d3244;" value="{{ old('meta_keywords', $blog->meta_keywords) }}">
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

            // --- TinyMCE ---
            tinymce.init({
                selector: '#editor',
                language: 'tr',
                height: 600,
                skin: 'oxide-dark',
                content_css: 'dark',
                plugins: 'advlist autolink lists link image charmap preview anchor code fullscreen media table wordcount',
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
                            success: (json) => resolve(json.location),
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
