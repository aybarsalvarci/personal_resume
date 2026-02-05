@extends('admin.layouts.master')

@section('title', 'Projeyi Düzenle: ' . $project->name)

@push('css')
    <style>
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
        .input-group-text { min-width: 45px; justify-content: center; }
        .form-control:focus { background-color: #32374a; color: #fff; border-color: #3498db; box-shadow: none; }
        .tox-tinymce { border: 1px solid #3f475e !important; border-radius: 8px !important; }
        .invalid-feedback-custom { color: #e74c3c; font-size: 0.85rem; margin-top: 5px; display: block; }
    </style>
@endpush

@section('breadcrumb-title', 'Projeyi Düzenle')
@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.projects.index')}}">Projeler</a></li>
    <li class="breadcrumb-item active">Düzenle</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-11 mx-auto">
            <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- Önemli: Update için PUT metodu --}}

                <div class="card shadow-lg" style="background-color: #1a1e2b; border: 1px solid #2d3244; border-radius: 12px;">
                    <div class="card-header border-0" style="background-color: rgba(255,255,255,0.03); padding: 1.5rem;">
                        <h3 class="card-title text-white font-weight-bold">
                            <i class="fas fa-edit mr-2 text-primary"></i> Proje Düzenle: {{ $project->name }}
                        </h3>
                    </div>

                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="text-white-50 small text-uppercase mb-2">Proje Adı</label>
                                            <input type="text" name="name" id="name"
                                                   class="form-control border-secondary text-white @error('name') is-invalid @enderror"
                                                   style="background-color: #2d3244; border-radius: 8px; padding: 12px;"
                                                   required value="{{ old('name', $project->name) }}">
                                            @error('name') <div class="invalid-feedback-custom"><span>{{ $message }}</span></div> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="text-white-50 small text-uppercase mb-2">Slug (URL)</label>
                                            <input type="text" id="slug" disabled
                                                   class="form-control border-secondary text-white"
                                                   style="background-color: #2d3244; border-radius: 8px; padding: 12px;"
                                                   value="{{$project->slug}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label class="text-white-50 small text-uppercase mb-2">Proje Açıklaması</label>
                                    <textarea name="description" id="editor" class="form-control @error('description') is-invalid @enderror">
                                        {!! old('description', $project->description) !!}
                                    </textarea>
                                    @error('description') <div class="invalid-feedback-custom"><span>{{ $message }}</span></div> @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="text-white-50 small text-uppercase mb-2">İkon (FontAwesome)</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text border-secondary text-primary" style="background-color: #3f475e;">
                                                        <i id="icon-preview" class="{{ $project->icon ?? 'fas fa-rocket' }}"></i>
                                                    </span>
                                                </div>
                                                <input type="text" name="icon" id="icon-input"
                                                       class="form-control border-secondary text-white @error('icon') is-invalid @enderror"
                                                       style="background-color: #2d3244;" value="{{ old('icon', $project->icon) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label class="text-white-50 small text-uppercase mb-2">Proje Linki</label>
                                            <input type="url" name="link" class="form-control border-secondary text-white @error('link') is-invalid @enderror"
                                                   style="background-color: #2d3244;" value="{{ old('link', $project->link) }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label class="text-white-50 small text-uppercase mb-2">Anahtar Özellikler (Keys)</label>
                                    <input type="text" name="keys" class="form-control border-secondary text-white @error('keys') is-invalid @enderror"
                                           style="background-color: #2d3244; border-radius: 8px; padding: 12px;"
                                           value="{{ old('keys', $project->keys) }}">
                                </div>

                                <div class="form-group mb-4">
                                    <label class="text-white-50 small text-uppercase mb-2">Kapak Görseli</label>
                                    <div class="custom-file-container" style="background-color: #2d3244; border: 2px dashed #3f475e; border-radius: 12px; padding: 30px; text-align: center;">
                                        <input type="file" name="image" id="image-input" class="d-none" accept="image/*">
                                        <label for="image-input" style="cursor: pointer;" class="m-0 d-block">
                                            <div id="image-placeholder" class="{{ $project->image ? 'd-none' : '' }}">
                                                <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                                                <p class="text-white mb-1 font-weight-bold">Değiştirmek için tıkla</p>
                                            </div>
                                            <img id="image-preview"
                                                 src="{{ \Illuminate\Support\Facades\Storage::url($project->image) ? asset('storage/'.$project->image) : '#' }}"
                                                 alt="Önizleme"
                                                 class="img-fluid rounded {{ $project->image ? '' : 'd-none' }} mx-auto">
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="p-3 rounded mb-4" style="background-color: rgba(255,255,255,0.02); border: 1px solid #2d3244;">
                                    <div class="form-group">
                                        <label class="text-white-50 small">Kategori Seçimi</label>
                                        <select name="category_id" class="form-control border-secondary text-white select2" style="background-color: #2d3244;">
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ (old('category_id', $project->category_id) == $category->id) ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <hr style="border-top: 1px solid #2d3244;">

                                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success my-3">
                                        <input type="checkbox" name="isFeatured" class="custom-control-input" id="isFeatured" value="1"
                                            {{ old('isFeatured', $project->isFeatured) ? 'checked' : '' }}>
                                        <label class="custom-control-label text-white font-weight-normal" for="isFeatured">Öne Çıkan Proje</label>
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label class="text-white-50 small text-uppercase mb-2">SEO Meta Açıklama</label>
                                    <textarea name="meta_description" rows="3" class="form-control border-secondary text-white"
                                              style="background-color: #2d3244;">{{ old('meta_description', $project->meta_description) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label class="text-white-50 small text-uppercase mb-2">SEO Meta Keywords</label>
                                    <textarea name="meta_keywords" rows="3" class="form-control border-secondary text-white"
                                              style="background-color: #2d3244;">{{ old('meta_keywords', $project->meta_keywords) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer border-0 p-4" style="background-color: #161a25; border-top: 1px solid #2d3244 !important;">
                        <div class="d-flex justify-content-end align-items-center">
                            <a href="{{ route('admin.projects.index') }}" class="btn btn-link text-muted mr-3">Vazgeç</a>
                            <button type="submit" class="btn btn-primary px-5 shadow-lg rounded-pill font-weight-bold">
                                <i class="fas fa-sync-alt mr-2"></i> Güncelle ve Yayınla
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
            tinymce.init({
                selector: '#editor',
                language: 'tr',
                height: 450,
                skin: 'oxide-dark',
                content_css: 'dark',
                branding: false,
                plugins: 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table code help wordcount',
                toolbar: 'undo redo | blocks | bold italic forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | removeformat | code',
                images_upload_handler: (blobInfo, progress) => {
                    return new Promise((resolve, reject) => {
                        const xhr = new XMLHttpRequest();
                        xhr.open('POST', '{{ route("admin.projects.file-upload") }}');
                        xhr.onload = () => {
                            if (xhr.status !== 200) { reject('Hata: ' + xhr.status); return; }
                            const json = JSON.parse(xhr.responseText);
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

            function updateIconPreview() {
                const iconInput = $('#icon-input').val().trim();
                $('#icon-preview').attr('class', iconInput || 'fas fa-rocket');
            }
            $('#icon-input').on('keyup input', updateIconPreview);

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
