@extends('admin.layouts.master')

@section('title', 'Gelen Mesajlar')

@section('breadcrumb-title', 'İletişim Yönetimi')
@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Mesajlar</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow-lg"
                 style="background-color: #1a1e2b; border: 1px solid #2d3244; border-radius: 12px; overflow: hidden;">
                <div class="card-header border-0" style="background-color: rgba(255,255,255,0.03); padding: 1.25rem;">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title text-white font-weight-bold mb-0" style="font-size: 1.1rem;">
                            <i class="fas fa-envelope-open-text mr-2 text-primary"></i> İletişim Mesajları
                        </h3>

                        <div class="card-tools d-flex">
                            <form action="{{ route('admin.contacts.index') }}" method="GET">
                                <div class="input-group input-group-sm" style="width: 250px;">
                                    <input type="text" name="search" class="form-control border-secondary text-white"
                                           placeholder="İsim veya e-posta ara..."
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
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="color: #cbd5e0;">
                            <thead style="background-color: rgba(0,0,0,0.2); text-transform: uppercase; font-size: 0.75rem; letter-spacing: 1px;">
                            <tr>
                                <th class="border-0 px-4">Durum</th>
                                <th class="border-0">Gönderen</th>
                                <th class="border-0" style="width: 35%;">Konu & Özet</th>
                                <th class="border-0">Tarih</th>
                                <th class="border-0 text-right px-4">İşlemler</th>
                            </tr>
                            </thead>
                            <tbody style="background-color: #1a1e2b;">
                            @foreach($contacts as $contact)
                                <tr style="border-bottom: 1px solid #2d3244; {{ !$contact->is_read ? 'background-color: rgba(99, 102, 241, 0.05);' : '' }}">
                                    <td class="align-middle px-4 text-center">
                                        @if($contact->status != "read")
                                            <i class="fas fa-circle text-primary" style="font-size: 0.6rem;" title="Yeni Mesaj"></i>
                                        @else
                                            <i class="far fa-envelope-open text-muted" style="font-size: 0.8rem;"></i>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <div class="text-white font-weight-bold mb-0">{{ $contact->name }}</div>
                                        <div class="text-muted small">{{ $contact->email }}</div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="text-white-50 font-weight-bold text-truncate" style="max-width: 300px;">
                                            {{ $contact->subject }}
                                        </div>
                                        <div class="text-muted text-truncate" style="font-size: 0.75rem; max-width: 300px;">
                                            {{ Str::limit($contact->message, 70) }}
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="small text-white-50">
                                            {{ $contact->created_at->translatedFormat('d M Y') }}
                                        </div>
                                        <div class="text-muted" style="font-size: 0.65rem;">
                                            <i class="far fa-clock mr-1"></i>{{ $contact->created_at->format('H:i') }}
                                        </div>
                                    </td>
                                    <td class="align-middle text-right px-4">
                                        <div class="btn-group shadow-sm" style="border-radius: 8px; overflow: hidden;">
                                            <a type="button" href="{{route('admin.contacts.show', $contact->id)}}"
                                                    class="btn btn-sm btn-dark border-secondary px-3 view-msg"
                                                    style="background-color: #2d3244;"
                                                    title="Mesajı Oku">
                                                <i class="fas fa-eye text-info"></i>
                                            </a>
                                            <button type="button"
                                                    class="btn btn-sm btn-dark border-secondary px-3 delete-btn"
                                                    style="background-color: #2d3244;" title="Sil"
                                                    data-id="{{$contact->id}}">
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
                            Toplam <span class="text-white font-weight-bold">{{ $contacts->count() }}</span> mesaj.
                        </span>
                        <div>
                            {{ $contacts->links() }}
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
                    text: "Bu mesaj kalıcı olarak silinecektir.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'Evet, sil',
                    cancelButtonText: 'Vazgeç'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let id = $(this).data('id');
                        let url = "{{route('admin.contacts.destroy', 'id')}}".replace('id', id);
                        let form = $(".delete-form");
                        form.attr('action', url);
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
