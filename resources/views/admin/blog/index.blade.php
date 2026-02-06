@extends('admin.layouts.master')

@section('title', 'Blog Yazıları')

@section('breadcrumb-title', 'Blog Yönetimi')
@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Bloglar</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg"
                 style="background-color: #1a1e2b; border: 1px solid #2d3244; border-radius: 12px; overflow: hidden;">
                <div class="card-header border-0" style="background-color: rgba(255,255,255,0.03); padding: 1.25rem;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title text-white font-weight-bold mb-0" style="font-size: 1.1rem;">
                            <i class="fas fa-feather mr-2 text-primary"></i> Blog Yazıları
                        </h3>

                        <div class="card-tools d-flex">
                            <form action="{{ route('admin.blogs.index') }}" method="GET" class="mr-3">
                                <div class="input-group input-group-sm" style="width: 250px;">
                                    <input type="text" name="search" class="form-control border-secondary text-white"
                                           placeholder="Başlık veya kategori ara..."
                                           value="{{ request('search') }}"
                                           style="background-color: #2d3244; border-radius: 20px 0 0 20px; padding-left: 15px;">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-secondary border-secondary"
                                                style="background-color: #3f475e; border-radius: 0 20px 20px 0;">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <a href="{{ route('admin.blogs.create') }}"
                               class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm d-flex align-items-center">
                                <i class="fas fa-plus-circle mr-1"></i> Yeni Yazı Ekle
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="color: #cbd5e0;">
                            <thead style="background-color: rgba(0,0,0,0.2); text-transform: uppercase; font-size: 0.75rem; letter-spacing: 1px;">
                            <tr>
                                <th class="border-0 px-4">ID</th>
                                <th class="border-0" style="width: 40%;">Yazı Başlığı & SEO</th>
                                <th class="border-0">Kategori</th>
                                <th class="border-0 text-center">Durum</th>
                                <th class="border-0">Tarih</th>
                                <th class="border-0 text-right px-4">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody style="background-color: #1a1e2b;">
                            @foreach($blogs as $blog)
                                <tr style="border-bottom: 1px solid #2d3244;">
                                    <td class="align-middle px-4">
                                        <span class="text-secondary small">#{{ $blog->id }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-lg d-flex align-items-center justify-content-center shadow-sm mr-3"
                                                 style="width: 45px; height: 45px; background-color: #2d3244; border: 1px solid #3f475e; flex-shrink: 0;">
                                                <i class="{{ $blog->category->icon ?? 'fas fa-file-alt' }} text-primary"></i>
                                            </div>
                                            <div style="max-width: 400px;">
                                                <div class="text-white font-weight-bold mb-0 text-truncate">
                                                    {{ $blog->title }}
                                                    @if($blog->isFeatured)
                                                        <i class="fas fa-star text-warning ml-1" style="font-size: 0.7rem;" title="Öne Çıkan Yazı"></i>
                                                    @endif
                                                </div>
                                                <div class="text-muted text-truncate" style="font-size: 0.7rem;">
                                                    <i class="fas fa-tags mr-1" style="font-size: 0.6rem;"></i>{{ Str::limit($blog->meta_description, 60) }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <span class="badge border border-secondary text-light px-2 py-1"
                                              style="background: rgba(255,255,255,0.05); font-weight: normal;">
                                            {{ $blog->category->name }}
                                        </span>
                                    </td>
                                    <td class="align-middle text-center">
                                        @if($blog->status === 'published')
                                            <span class="badge px-3 py-1"
                                                  style="background-color: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 20px; font-size: 0.7rem; letter-spacing: 0.5px;">
                                                <i class="fas fa-check-circle mr-1" style="font-size: 0.6rem;"></i> YAYINDA
                                            </span>
                                        @else
                                            <span class="badge px-3 py-1"
                                                  style="background-color: rgba(245, 158, 11, 0.1); color: #f59e0b; border: 1px solid rgba(245, 158, 11, 0.3); border-radius: 20px; font-size: 0.7rem; letter-spacing: 0.5px;">
                                                <i class="fas fa-pen-nib mr-1" style="font-size: 0.6rem;"></i> TASLAK
                                            </span>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <div class="small text-white-50">
                                            {{ \Carbon\Carbon::parse($blog->created_at)->translatedFormat('d M Y') }}
                                        </div>
                                        <div class="text-muted" style="font-size: 0.65rem;">
                                            <i class="far fa-clock mr-1"></i>{{ \Carbon\Carbon::parse($blog->created_at)->format('H:i') }}
                                        </div>
                                    </td>
                                    <td class="align-middle text-right px-4">
                                        <div class="btn-group shadow-sm" style="border-radius: 8px; overflow: hidden;">
                                            <a href="{{ route('admin.blogs.edit', $blog->id) }}"
                                               class="btn btn-sm btn-dark border-secondary px-3"
                                               style="background-color: #2d3244;" title="Düzenle">
                                                <i class="fas fa-edit text-warning"></i>
                                            </a>
                                            <button type="button"
                                                    class="btn btn-sm btn-dark border-secondary px-3 delete-btn"
                                                    style="background-color: #2d3244;" title="Sil"
                                                    data-id="{{$blog->id}}">
                                                <i class="fas fa-trash text-danger"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer border-0" style="background-color: #161a25; border-top: 1px solid #2d3244 !important;">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted small">
                            Toplam <span class="text-white font-weight-bold">{{ $blogs->count() }}</span> makale bulundu.
                        </span>
                        <div>
                            {{ $blogs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="" method="POST" class="d-none delete-form">
        @method("DELETE")
        @csrf
    </form>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('.delete-btn').click(function () {
                Swal.fire({
                    title: 'Emin misiniz?',
                    text: "Projeyi silmek istediğinize emin misiniz?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Evet, onaylıyorum',
                    cancelButtonText: 'Hayır, vazgeç'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let id = $(this).data('id');
                        let url = "{{route('admin.blogs.destroy', 'id')}}".replace('id', id);

                        let form = $(".delete-form");
                        form.attr('action', url);
                        form.submit();
                    }
                });
            })
        });
    </script>
@endpush
