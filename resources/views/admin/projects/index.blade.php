@extends('admin.layouts.master')

@section('title', 'Projeler')

@push('css')
@endpush

@section('breadcrumb-title', 'Projeler')
@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Projeler</li>
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg"
                 style="background-color: #1a1e2b; border: 1px solid #2d3244; border-radius: 12px; overflow: hidden;">
                <div class="card-header border-0" style="background-color: rgba(255,255,255,0.03); padding: 1.25rem;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title text-white font-weight-bold mb-0" style="font-size: 1.1rem;">
                            <i class="fas fa-list-ul mr-2 text-primary"></i> Proje Listesi
                        </h3>

                        <div class="card-tools d-flex">
                            <form action="{{ route('admin.projects.index') }}" method="GET" class="mr-3">
                                <div class="input-group input-group-sm" style="width: 250px;">
                                    <input type="text" name="search" class="form-control border-secondary text-white"
                                           placeholder="Proje veya slug ara..."
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

                            <a href="{{ route('admin.projects.create') }}"
                               class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm d-flex align-items-center">
                                <i class="fas fa-plus-circle mr-1"></i> Yeni Proje Ekle
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
                                <th class="border-0">Proje Bilgileri</th>
                                <th class="border-0">Kategori</th>
                                <th class="border-0 text-center">Durum</th>
                                <th class="border-0">Zamanlama</th>
                                <th class="border-0 text-right px-4">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody style="background-color: #1a1e2b;">
                            @foreach($projects as $project)
                                <tr style="border-bottom: 1px solid #2d3244;">
                                    <td class="align-middle px-4">
                                        <span class="text-secondary small">#{{ $project->id }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-lg d-flex align-items-center justify-content-center shadow-sm mr-3"
                                                 style="width: 40px; height: 40px; background-color: #2d3244; border: 1px solid #3f475e;">
                                                <i class="{{ $project->icon }} text-primary"></i>
                                            </div>
                                            <div>
                                                <div class="text-white font-weight-bold mb-0">
                                                    {{ $project->name }}
                                                    {{-- Öne Çıkan Yıldızı --}}
                                                    @if($project->isFeatured)
                                                        <i class="fas fa-star text-warning ml-1" style="font-size: 0.7rem;" title="Öne Çıkan Proje"></i>
                                                    @endif
                                                </div>
                                                <div class="text-muted" style="font-size: 0.75rem;">
                                                    <i class="fas fa-link mr-1" style="font-size: 0.6rem;"></i>{{ $project->slug }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                    <span class="badge border border-secondary text-light px-2 py-1"
                          style="background: rgba(255,255,255,0.05); font-weight: normal;">
                        {{$project->category->name}}
                    </span>
                                    </td>
                                    <td class="align-middle text-center">
                                        @if($project->status == 'completed')
                                            <span class="badge px-2 py-1"
                                                  style="background-color: rgba(46, 204, 113, 0.15); color: #2ecc71; border: 1px solid rgba(46, 204, 113, 0.3); border-radius: 6px; min-width: 100px;">
                            <i class="fas fa-check-double mr-1 small"></i> Tamamlandı
                        </span>
                                        @elseif($project->status == 'in-progress')
                                            <span class="badge px-2 py-1"
                                                  style="background-color: rgba(52, 152, 219, 0.15); color: #3498db; border: 1px solid rgba(52, 152, 219, 0.3); border-radius: 6px; min-width: 100px;">
                            <i class="fas fa-spinner fa-spin mr-1 small"></i> Devam Ediyor
                        </span>
                                        @elseif($project->status == 'upcoming')
                                            <span class="badge px-2 py-1"
                                                  style="background-color: rgba(155, 89, 182, 0.15); color: #9b59b6; border: 1px solid rgba(155, 89, 182, 0.3); border-radius: 6px; min-width: 100px;">
                            <i class="fas fa-calendar-plus mr-1 small"></i> Planlanıyor
                        </span>
                                        @else
                                            <span class="badge px-2 py-1" style="background-color: rgba(160, 174, 192, 0.15); color: #a0aec0; border-radius: 6px;">
                            Belirsiz
                        </span>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <div class="small text-white-50">
                                            <i class="far fa-calendar-alt mr-1"></i>
                                            {{ \Carbon\Carbon::parse($project->created_at)->translatedFormat('d M Y') }}
                                        </div>

                                        @if($project->updated_at && $project->updated_at->ne($project->created_at))
                                            <div class="text-muted mt-1 d-flex align-items-center" style="font-size: 0.65rem;">
                                                <i class="fas fa-history mr-1"></i>
                                                <span>Güncel: {{ $project->updated_at->translatedFormat('d M H:i') }}</span>
                                            </div>
                                        @else
                                            <div class="text-muted" style="font-size: 0.7rem; margin-left: 17px;">
                                                {{ \Carbon\Carbon::parse($project->created_at)->format('H:i') }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="align-middle text-right px-4">
                                        <div class="btn-group shadow-sm" style="border-radius: 8px; overflow: hidden;">
                                            <a href="{{ $project->link }}" target="_blank"
                                               class="btn btn-sm btn-dark border-secondary px-3"
                                               style="background-color: #2d3244;" title="Görüntüle">
                                                <i class="fas fa-external-link-alt text-info"></i>
                                            </a>
                                            <a href="{{route('admin.projects.edit', $project->id)}}"
                                               class="btn btn-sm btn-dark border-secondary px-3"
                                               style="background-color: #2d3244;" title="Düzenle">
                                                <i class="fas fa-edit text-warning"></i>
                                            </a>
                                            <button type="button"
                                                    class="btn btn-sm btn-dark border-secondary px-3 delete-btn"
                                                    style="background-color: #2d3244;" title="Sil"
                                                    data-id="{{$project->id}}">
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

                <div class="card-footer border-0"
                     style="background-color: #161a25; border-top: 1px solid #2d3244 !important;">
                    <div class="d-flex justify-content-between align-items-center">
            <span class="text-muted small">
                Toplam <span class="text-white font-weight-bold">{{ $projects->count() }}</span> proje listeleniyor.
            </span>
                        <div>
                            {{$projects->links()}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->

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
                        let url = "{{route('admin.projects.destroy', 'id')}}".replace('id', id);

                        let form = $(".delete-form");
                        form.attr('action', url);
                        form.submit();
                    }
                });
            })
        });
    </script>
@endpush
