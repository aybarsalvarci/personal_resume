@extends('admin.layouts.master')

@section('title', 'Mesaj Detayı: ' . $contact->subject)

@push('css')
    <style>
        .info-label { color: #6366f1; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; font-weight: 700; margin-bottom: 5px; }
        .info-value { color: #cbd5e0; font-size: 1rem; margin-bottom: 20px; }
        .message-content {
            background-color: rgba(255, 255, 255, 0.03);
            border: 1px solid #2d3244;
            border-radius: 12px;
            padding: 25px;
            color: #e2e8f0;
            line-height: 1.8;
            white-space: pre-wrap;
            font-size: 1.05rem;
        }
        .status-card {
            border-radius: 12px;
            padding: 15px;
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
    </style>
@endpush

@section('breadcrumb-title', 'Mesaj Detayı')
@section('breadcrumb-links')
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{route('admin.contacts.index')}}">Mesajlar</a></li>
    <li class="breadcrumb-item active">Görüntüle</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow-lg" style="background-color: #1a1e2b; border: 1px solid #2d3244; border-radius: 12px;">
                        <div class="card-header border-0 d-flex justify-content-between align-items-center" style="background-color: rgba(255,255,255,0.03); padding: 1.5rem;">
                            <h3 class="card-title text-white font-weight-bold mb-0">
                                <i class="fas fa-envelope-open mr-2 text-primary"></i> Mesaj Detayı
                            </h3>
                            <span class="text-muted small">ID: #{{ $contact->id }}</span>
                        </div>
                        <div class="card-body p-4">
                            <div class="mb-4">
                                <div class="info-label">Konu</div>
                                <h2 class="text-white font-weight-bold" style="font-size: 1.5rem;">{{ $contact->subject }}</h2>
                            </div>

                            <div class="mb-2">
                                <div class="info-label">Mesaj İçeriği</div>
                                <div class="message-content">
                                    {{ $contact->message }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="status-card {{ $contact->status == 'read' ? 'bg-success-transparent' : 'bg-primary-transparent' }}"
                         style="background: {{ $contact->status == 'read' ? 'rgba(16, 185, 129, 0.1)' : 'rgba(99, 102, 241, 0.1)' }};
                                border: 1px solid {{ $contact->status == 'read' ? '#10b981' : '#6366f1' }};">
                        <i class="fas {{ $contact->status == 'read' ? 'fa-check-double' : 'fa-envelope' }} mr-3"
                           style="font-size: 1.5rem; color: {{ $contact->status == 'read' ? '#10b981' : '#6366f1' }};"></i>
                        <div>
                            <div class="small font-weight-bold" style="color: {{ $contact->status == 'read' ? '#10b981' : '#6366f1' }};">DURUM</div>
                            <div class="text-white small">{{ $contact->status == 'read' ? 'Okundu İşaretlendi' : 'Henüz Okunmadı' }}</div>
                        </div>
                    </div>

                    <div class="card shadow-lg mb-4" style="background-color: #1a1e2b; border: 1px solid #2d3244; border-radius: 12px;">
                        <div class="card-body p-4">
                            <div class="mb-4">
                                <div class="info-label">Gönderen</div>
                                <div class="info-value font-weight-bold text-white">{{ $contact->name }}</div>
                            </div>

                            <div class="mb-4">
                                <div class="info-label">E-Posta</div>
                                <div class="info-value">
                                    <a href="mailto:{{ $contact->email }}" class="text-primary text-decoration-none">
                                        {{ $contact->email }} <i class="fas fa-external-link-alt ml-1" style="font-size: 0.7rem;"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="info-label">Tarih</div>
                                <div class="info-value">
                                    <span class="text-white">{{ $contact->created_at->translatedFormat('d F Y') }}</span>
                                    <br>
                                    <small class="text-muted"><i class="far fa-clock mr-1"></i>{{ $contact->created_at->format('H:i') }}</small>
                                </div>
                            </div>

                            <hr style="border-top: 1px solid #2d3244;">

                            <div class="d-flex flex-column gap-2">
                                <a href="mailto:{{ $contact->email }}" class="btn btn-primary btn-block rounded-pill font-weight-bold mb-2">
                                    <i class="fas fa-reply mr-2"></i> Mail İle Yanıtla
                                </a>

                                <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" id="delete-form-{{ $contact->id }}">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn btn-outline-danger btn-block rounded-pill font-weight-bold delete-btn">
                                        <i class="fas fa-trash-alt mr-2"></i> Mesajı Sil
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-lg" style="background-color: #1a1e2b; border: 1px solid #2d3244; border-radius: 12px;">
                        <div class="card-body p-4">
                            <div class="info-label mb-3">Sistem Bilgisi</div>
                            <div class="small text-muted">
                                <p class="mb-1"><i class="fas fa-network-wired mr-2"></i> IP: {{ $contact->ip_address ?? 'Bilinmiyor' }}</p>
                                <p class="mb-0"><i class="fas fa-globe mr-2"></i> Kaynak: İletişim Formu</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('.delete-btn').click(function () {
                Swal.fire({
                    title: 'Silmek istediğinize emin misiniz?',
                    text: "Bu işlem geri alınamaz!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ff4d4d',
                    confirmButtonText: 'Evet, Sil!',
                    cancelButtonText: 'Vazgeç',
                    background: '#1a1e2b',
                    color: '#fff'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).closest('form').submit();
                    }
                });
            });
        });
    </script>
@endpush
